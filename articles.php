<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$query = $pdo->prepare('SELECT a.* , c.name , u.username FROM categorie c  join article a on c.id = a.categorie_id join users u on a.user_id = u.id ORDER BY id DESC  ');
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<?= template_header('articles'); ?>

<div class="container">
  <br>
  <h2 class="text text-center">Articles</h2><br>
  <a href="add_article.php" class="btn btn-primary">Ajouter un article</a><br><br>
  <div class="row">
    <?php foreach ($articles as $item) : ?>
      <div class="col-4 mb-5">
        <div class="card" style="width: 18rem;">
          <img src="./images/<?= $item['image'] ?>" width="150px" height="200px" class="card-img-top" alt="...">
          <div class="card-body">
            
              <h5 class="card-title"><?= $item['categorie'] ?></h5>
              <p class="text"><?= $item['nom'] ?></p>
              <p class="card-text"><?= $item['description'] ?></p>
              <p class="card-text"><?= $item['prix'] ?></p>
          
              <a href="view.php?id=<?= $item['id'] ?>" class="btn btn-success">view</a> 
            
            
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>


</body>

</html>
