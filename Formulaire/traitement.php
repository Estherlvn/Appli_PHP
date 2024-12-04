<?php
    session_start();


    
    // switch pour faire cohabiter les fonctionnalités dans recap.php
    if(isset($_GET['action'])){
        
        switch($_GET['action']){
            case "add":
                // condition pour limiter l'accès au fichier traitement.php
                // permet de vérifier l'existence de la clé "submit" dans le tableau $_POST
                    if(isset($_POST['submit'])){
                
                /*Mesures de sécurité: pour éviter les injections de code XSS ou les SQL Injections:
                - permet de vérifier l'intégrité des valeurs transmises vs. celles attendues
                - les filtres permettent d'effectuer une validation ou un nettoyage de chaque donnée transmise par le formulaire */
                
                        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                
                // Cette condition vérifie que les filtres ont bien fonctionné, renverra false ou null
                        if($name && $price && $qtt){
                
                            /* création tableau associatif $product pour organiser et conserver
                            les données des produits enregistrés (en session) */
                            $product = [
                                "name" => $name,
                                "price" => $price,
                                "qtt" => $qtt,
                                // ajout de la valeur "total"
                                "total" => $price*$qtt
                            ];
                
                            // enregistrer le produit nouvellement créé en session (dans un)
                            $_SESSION['products'][] = $product;
                
                        }
                    }
                    break;
                case "delete":
                    var_dump("ok");
                    $indexASupprimer = $_GET['id'];
    
                    // Vérifier si l'index existe dans le tableau des produits
                    if (isset($_SESSION['products'][$indexASupprimer])) {
                        // Supprimer l'élément
                        unset($_SESSION['products'][$indexASupprimer]);
                        // Mettre à jour une information dans la session pour l'affichage
                        $_SESSION['infos'] = "L'élément $indexASupprimer a été supprimé.";
                    } else {
                        $_SESSION['infos'] = "Impossible de supprimer l'élément $indexASupprimer.";
                    }

                    header("Location: recap.php");exit;
                    break;
                case "clear":

                    break;
                case "up-qtt":
                case "down-qtt":
            }
        }

// si un utilisateur tente d'accéder à la page traitement.php, le serveur le redirige vers index.php
// effectue une redirection grâce à la fonction header()
    header("Location:index.php");