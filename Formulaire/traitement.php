<?php
session_start();

// switch pour faire cohabiter les fonctionnalités dans recap.php
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            if (isset($_POST['submit'])) {
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                if ($name && $price && $qtt) {
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt
                    ];

                    $_SESSION['products'][] = $product;
                }
            }
            break;

        case "delete":
            $indexASupprimer = $_GET['id'];

            if (isset($_SESSION['products'][$indexASupprimer])) {
                unset($_SESSION['products'][$indexASupprimer]);
                $_SESSION['infos'] = "L'élément $indexASupprimer a été supprimé.";
            } else {
                $_SESSION['infos'] = "Impossible de supprimer l'élément $indexASupprimer.";
            }

            header("Location: recap.php");
            exit;
            break;

        case "clear":
            unset($_SESSION['products']);
            $_SESSION['infos'] = "Tous les produits ont été supprimés du panier.";

            header("Location: recap.php");
            exit;
            break;

        case "up-qtt":
            $index = $_GET['id'];
            if (isset($_SESSION['products'][$index])) {
                $_SESSION['products'][$index]['qtt'] += 1;
                $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
            }
            header("Location: recap.php");
            exit;
            break;

        case "down-qtt":
            $index = $_GET['id'];
            if (isset($_SESSION['products'][$index])) {
                if ($_SESSION['products'][$index]['qtt'] > 1) {
                    $_SESSION['products'][$index]['qtt'] -= 1;
                    $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
                } else {
                    unset($_SESSION['products'][$index]);
                }
            }
            header("Location: recap.php");
            exit;
            break;
    }
}

header("Location:index.php");
?>
