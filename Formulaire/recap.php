<?php
session_start(); // Récupère la session correspondante à l'utilisateur en cours
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

        foreach ($_SESSION['products'] as $index => $product) {
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td>",
                        "<form action='traitement.php?action=up-qtt&id=$index' method='post' style='display:inline;'>",
                            "<button type='submit'>+</button>",
                        "</form>",
                        "&nbsp;".$product['qtt']."&nbsp;",
                        "<form action='traitement.php?action=down-qtt&id=$index' method='post' style='display:inline;'>",
                            "<button type='submit'>-</button>",
                        "</form>",
                    "</td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?action=delete&id=$index'>Supprimer</a></td>", // Lien pour supprimer l'élément
                "</tr>";
            $totalGeneral += $product['total'];  // Additionner le total général
        }

        echo "<tr>",
                "<td colspan='4'>Total général :</td>",
                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "<td></td>", // Colonne d'action vide pour le total
                "</tr>",
            "</tbody>",
        "</table>";

        if (isset($_SESSION['infos'])) {
            echo "<p>".$_SESSION['infos']."</p>";
            unset($_SESSION['infos']); // Réinitialiser l'information après affichage
        }

        echo "<form action='traitement.php?action=clear' method='post'>
                <button type='submit' onclick='return confirm(\"Êtes-vous sûr de vouloir vider le panier ?\");'>Vider le panier</button>
              </form>";
    }
    ?>
</body>
</html>
