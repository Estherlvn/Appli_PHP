<?php
    session_start(); // réccupère la session correspondante à l'utilisateur en cours


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
        // vérifie que la clé 'products' existe - si elle existe, vérifie si elle est vide
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {
                echo "<p>Aucun produit en session...</p>"; // message à l'intention de l'utilisateur
            }
            else{
                echo "<table>",
                        "<theah>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                            "</tr>",
                        "</thead>",

                "<tbody>";

                    $totalGeneral = 0; // variable $totalGeneral initialisé à zéro

            foreach($_SESSION['products'] as $index => $product){

                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>".$product['qtt']."</td>",
                        "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
    // number_format() affiche plusieurs paramètres souhaités : décimales, séparateur de milliers (&nbsp;)...
                    "</tr>";
                    $totalGeneral+= $product['total'];  //   +=  -> addition puis affectation
                }

                echo "<tr>",
                        "<td colspan=4>Total général : </td>",
                        "<td><strong>".number_format($totalGeneral, 2, ", ", "&nbsp;")."&nbsp;€</strong></td>",
                        "</tr>",

                "</tbody>",
                    "</table>";


            }
        ?>

</body>

</html>