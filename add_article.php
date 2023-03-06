<?php

include('functions.php');
$pdo = pdo_connect_mysql();

//recupération des valeurs
if (!empty($_POST)) {
    //id
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    //categorie
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    //nom
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    // image here
    $image = $_FILES["image"]["name"];
    $tmpname = $_FILES["image"]["tmp_name"];
    $place = "images/";
    move_uploaded_file($tmpname, $place.$image);
    //description
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    //prix
    $prix = isset($_POST['prix']) ? $_POST['prix'] : '';
    //categorie_id
    $categorie_id = isset($_POST['categorie_id']) && !empty($_POST['categorie_id']) && $_POST['categorie_id'] != 'auto' ? $_POST['categorie_id'] : NULL;

    //insert into database
    $query = $pdo->prepare('INSERT INTO article VALUES (?,?,?,?,?,?,?)');
    $query->execute([$id,$categorie,$nom,$image,$description,$prix,$categorie_id]);
    header('location:articles.php');    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'article</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    

<?= template_header('Add New Article') ?>

<div class="container">
<h1>Ajouter un article</h1>
<form action="add_article.php" method="post">
    <!-- Input Categorie !-->
	<p class="design_form">
		<label class="label_modif" for="categorie">
    		Catégorie du produit :
        </label>
	    <input id="categorie" type="text" name="categorie" class="form_modif"/>
	</p>
			
	<!-- Input Nom !-->
	<p class="design_form">
		<label class="label_modif" for="nom">
        	Nom du produit :
        </label>
        <input id="nom" type="text" name="nom" class="form_modif" placeholder="Nom" size="30" maxlength="10" />
		</p>
	<!-- Input Image !--> 
	<p class="design_form">
	<label class="label_modif" for="image">
        	Photo du produit :
        </label>
	    
		<input name="image" id="image" type="file" class="inputs_img">
        </p>
	<!-- Input Description !-->
         <label class="label_modif" for="message">
                Description :
        </label>
         <br />
        <textarea id="description" name="message" class="form_modif" rows="10" cols="50">
                
        </textarea>
	<!-- Input Prix !-->
        <p>
		<label class="label_modif" for="prix">
                Prix du produit :
        </label>
		<input name="prix" id="input_prix" type="number" class="form_modif">
        </p>
        <p>
            <input type="submit" value="create">
		</p>
    </form>
</div>


</body>

</html>
