<?php

namespace AppBundle\Command;


use AppBundle\Entity\User;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Cette commande permet de migrer les données de prod vers la base de données.
 *
 * Class MigrateUsersCommand
 */
class MigrateUsersCommand extends BaseImport
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('tum:migrate:users')
            ->setDescription('Importation des users');

        ini_set('memory_limit', '2024M');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $manager = $this->em;
        $repoUser = $manager->getRepository('AppBundle:User');

        $event = $this->stopwatch->start('import');
        $oldUsers = $this->execSqlExtern('SELECT * FROM users', 'box');

        foreach ($oldUsers as $user) {

            $email = strtolower($user['email']);

            $campagne = null;

            if ($user['campagne_id'] == 1){
                $campagne = 1;
            } else if ($user['campagne_id'] == 2){
                $campagne = 6;
            } else if ($user['campagne_id'] == 3){
                $campagne = 2;
            } else if ($user['campagne_id'] == 4){
                $campagne = 5;
            }

            //$news['pseudo'] = iconv("windows-1256", "UTF-8", $news['pseudo']);
            //$utf8_2 = mb_convert_encoding($iso88591, 'UTF-8', 'ISO-8859-1');

            //$news['pseudo'] = strtr($news['pseudo'],'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜ¯àâãäåçèéêëìíîï©£òóôõöùúûü~ÿ\/','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaceeeeiiiioooooouuuuyyy--');

            /*
            $repoUser = $this->em->getRepository(User::class);
            $user = $repoUser->findOneByEmail($news['mail']);
            */


            $fosUserManager = $this->getContainer()->get('fos_user.user_manager');

            $gender = $user['sex_id'] == 2 ? 'f' : 'm';


            $newUser = $repoUser->findOneBy(array('email' => $email));

            if (!$newUser){
                /** @var User $newUser */
                $newUser = $fosUserManager->createUser();
            }

                $newUser->setEmail($email)
                    ->setPlainPassword($user['password'])
                    ->setGender($gender)
                    ->setPostalCode($user['postal_code'])
                    ->setFirstname($user['firstname'])
                    ->setLastname($user['lastname'])
                    ->setTelephone($user['phone_mobile'])
                    ->setVille($user['city'])
                    ->setCreatedAt(new \DateTime($user['date_creation']))
                    ->setEnabled(true)
                    ->setOldId($user['id']);

                $fosUserManager->updateUser($newUser);
        }

        //$this->em->flush();
        //$this->em->clear();
        $this->io->success('Import News OK');

        $this->stopAndStats($event);
    }

}
