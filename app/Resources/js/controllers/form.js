(function() {
    'use strict';

    angular
        .module('app')
        .controller('FormCtrl', function ($scope, $http, role_selected, campagne, $window) {
            // VALEURS POUR DEBUG et REMPLISSAGE AUTO
            $scope.etapeSelected = role_selected;

            // Détecte si le formulaire a été envoyé ou non (formulaire de sélection du role)
            $scope.formRempli = false;

            $scope.switchEtape = function(etape) {
                $scope.etape = etape;
            };

            $scope.selectEtape = function(etapeSelected) {
                $scope.roleSelected = true;
                $scope.etapeSelected = etapeSelected;
            };

            // Envoie l'inscription d'un rôle à un user existant OU un nouvel user
            $scope.submitInscription = function() {
                // Selon le role choisi on transmet le bon formulaire à transmettre
                if($scope.etapeSelected === "testeur") {
                    // On force la conversion en string de la date pour la récupérer en PHP
                    $scope.testeur.birthdayString = $scope.testeur.birthday.toISOString();
                    var infosForm = $scope.testeur;
                } else if($scope.etapeSelected === "coach") {
                    $scope.coach.birthdayString = $scope.coach.birthday.toISOString();
                    var infosForm = $scope.coach;
                } else if($scope.etapeSelected === "tuteur") {
                    var infosForm = $scope.tuteur;
                }

                infosForm.campagne = campagne;

                // Submit HTTP POST
                $http({
                    url: 'validation',
                    method: 'POST',
                    data: $.param({'roleSelected': $scope.etapeSelected, 'infosForm': infosForm}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (response) {
                    if(!response.success) {
                        jQuery('.message-error').html(response.message).removeClass('hide');
                    } else {
                        // On redirige sur la page de fin
                        $window.location.href = 'fin' + '?type=' + $scope.etapeSelected + '&id=' + response.id;
                    }
                }).error(function (response) {
                    console.log('Erreur dans la requête AJAX, contactez un administrateur');
                });
            };

            // vérifie les formulaires d'étape et affiche ou non celui d'infos perso
            $scope.verifForm = function(form) {
                if (form.$name === "formInfosPerso") {
                    $scope.formInfosPersoRempli = true;
                }

                $scope.formRempli = true;

                console.log(form);

                if(jQuery("form[name='"+form.$name+"'] .form-element-errored").length > 0) {
                    form.$valid = false;
                }

                if(form.$valid) {
                    $scope.submitInscription();
                }
            };
    }).controller('FormPersoCtrl', function ($scope, $http, $window) {
        $scope.formInfosPersoRempli = false;

        $scope.verifForm = function(form) {
            if(jQuery("form[name='"+form.$name+"'] .form-element-errored").length > 0) {
                form.$valid = false;
            }

            $scope.formInfosPersoRempli = true;

            if(form.$valid) {
                $scope.submitCreationCompte();
            }
        };

        $scope.submitCreationCompte = function() {
            // Submit HTTP POST
            $http({
                url: '../inscription-'+$scope.perso.type,
                method: 'POST',
                data: $.param($scope.perso),
                headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'}
            }).success(function (response) {
                if(!response.success) {
                    jQuery('.message-error').html(response.message).removeClass('hide');
                } else {
                    // On redirige sur la page de redirection
                    $window.location.href = response.urlToRedirect;
                }
            }).error(function (response) {
                console.log('Erreur dans la requête AJAX, contactez un administrateur');
            });
        };
    });

})();

