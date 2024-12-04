<?php
session_start(); // Récupère la session correspondante à l'utilisateur en cours

//     // Si un produit doit être ajouté, le gérer ici
// if (isset($_GET['ajouter'])) {
//     $indexAAjouter = $_GET['ajouter'];
    
//     // Vérifier si l'index existe dans le tableau des produits
//     if (isset($_SESSION['products'][$indexAAjouter])) {
//         // Supprimer l'élément
//         unset($_SESSION['products'][$indexAAjouter]);
//         // Mettre à jour une information dans la session pour l'affichage
//         $_SESSION['infos'] = "L'élément $indexAAjouter a été ajouté.";
//     } else {
//         $_SESSION['infos'] = "Impossible d'ajouter l'élément $indexAAjouter.";
//     }
// }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <?php
    // Vérifie que la clé 'products' existe - si elle existe, vérifie si elle est vide
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        echo "<p>Aucun produit en session...</p>"; // Message à l'intention de l'utilisateur
    } else {
        echo "<table border='1'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                        "<th>Action</th>", // Ajout d'une colonne pour les actions (suppression)
                    "</tr>",
                "</thead>",
                "<tbody>";

        $totalGeneral = 0; // Variable $totalGeneral initialisé à zéro

        // Affichage des produits dans la session
        foreach ($_SESSION['products'] as $index => $product) {
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td>".$product['qtt']."</td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",

                    "<td>
                    <a href='traitement.php?action=delete&id=$index'>Supprimer</a>
                    </td>", // Lien pour supprimer l'élément
                   
                "</tr>";
            $totalGeneral += $product['total'];  // Additionner le total général
        }

        echo "<tr>",
                "<td colspan='4'>Total général :</td>",
                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "</tr>",
            "</tbody>",
        "</table>";

        // Affichage d'un message si un élément a été supprimé
        if (isset($_SESSION['infos'])) {
            echo "<p>".$_SESSION['infos']."</p>";
            unset($_SESSION['infos']); // Réinitialiser l'information après affichage
        }
    }
    ?>

        


</body>
</html>
