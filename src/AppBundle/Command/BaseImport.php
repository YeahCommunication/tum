<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchEvent;

abstract class BaseImport extends ContainerAwareCommand
{
    const PATH_SQL = '%s/../src/AppBundle/Command/Sql/%s.sql';
    const PATH_SHELL = '%s/../src/AppBundle/Command/Shell/%s.sh';

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var SymfonyStyle
     */
    protected $io;

    /**
     * @var Filesystem
     */
    protected $fs;

    /**
     * @var Stopwatch
     */
    protected $stopwatch;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->logger = $this->getContainer()->get('logger');
        $this->fs = $this->getContainer()->get('filesystem');
        $this->stopwatch = $this->getContainer()->get('debug.stopwatch');
        $this->io = new SymfonyStyle($input, $output);
    }

    /**
     * @return string
     */
    protected function getFullPathSql(string $name)
    {
        $rootDir = $this->getContainer()->getParameter('kernel.root_dir');

        return sprintf(self::PATH_SQL, $rootDir, $name);
    }

    /**
     * @return string
     */
    public function getFullPathShell(string $name)
    {
        $rootDir = $this->getContainer()->getParameter('kernel.root_dir');

        return sprintf(self::PATH_SHELL, $rootDir, $name);
    }

    /**
     * @throws \Symfony\Component\Console\Exception\ExceptionInterface
     */
    protected function schemaUpdate()
    {
        $command = $this->getApplication()->find('doctrine:schema:update');
        $argsInput = new ArrayInput(['--force' => true, '--quiet' => true]);

        if ($command->run($argsInput, $this->output) !== 0) {
            throw new \LogicException('Doctrine Schema Update failed');
        }
    }

    /**
     * Exécute un script SQL.
     *
     * @param string $filePath
     *
     * @return bool
     *
     * @throws \LogicException
     */
    protected function execScript($filePath)
    {
        if (!file_exists($filePath)) {
            throw new \LogicException(sprintf('SQL file "%s" not found.', $filePath));
        }

        $fileContents = file_get_contents($filePath);

        if (empty($fileContents)) {
            throw new \LogicException(sprintf('SQL file "%s" is empty.', $filePath));
        }

        $this->em->getConnection()->exec($fileContents);
    }

    /**
     * @param $sql
     *
     * @return \Doctrine\DBAL\Driver\Statement
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function execSql($sql)
    {
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    /**
     * @param $sql
     * @param $base
     *
     * @return \Doctrine\DBAL\Driver\Statement
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function execSqlExtern($sql, $base)
    {
        $connExtern = $this->getContainer()->get('doctrine')->getManager($base);
        $stmt = $connExtern->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    /**
     * Retourne un temps d'éxécution en H:i:s.
     *
     * @param $ms
     * @param string $format
     *
     * @return bool|string
     */
    protected function timeMsToDate($ms, $format = 'H:i:s')
    {
        $s = (int) $ms / 1000;

        return date($format, $s);
    }

    /**
     * Converti la taille de la mémoire en octet vers une unité de mesure.
     *
     * @param $size
     * @param int $precision
     * @param int $base
     *
     * @return string
     */
    protected function convertUnit($size, $precision = 2, $base = 1024)
    {
        $units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $unit = (int) floor(log($size, $base));

        return sprintf('%.'.$precision.'f', $size / pow($base, $unit)).' '.$units[$unit];
    }

    /**
     * @param StopwatchEvent $event
     */
    protected function stopAndStats(StopwatchEvent $event)
    {
        $event->stop();
        $this->io->comment('Duration: '.$this->timeMsToDate($event->getDuration()).' | '.$event->getDuration().' ms');
        $this->io->comment('Memory: '.$this->convertUnit($event->getMemory()));
    }
}
