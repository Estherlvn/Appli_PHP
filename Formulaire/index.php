<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulaire PHP</title>
</head>

<body>

    <h1>Ajouter un produit</h1>
    <form action="traitement.php?action=add" method="post">
<!-- l'attribut action indique le fichier à atteindre lors de la soumission du fomulaire.
        method précise la méthode HTTP utilisée pour transmettre les données au serveur -->


    <label>Nom du produit:</label>
        <input type="text" name="name"> <br><br>

    <label>Prix du produit:</label>
        <input type="number" name="price"> <br><br>

    <label>Quantité désirée:</label>
     <input type="number" name="qtt" value="1"> <br><br>

    <input type="submit" name="submit" value = "Ajouter au panier">
    
    </form>

</body>
</html>