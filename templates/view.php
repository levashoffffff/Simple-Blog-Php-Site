<?php include_once 'templates/header.php'; ?>

  <main>
    <div class="album py-5 bg-light">
      <div class="container">
        <h2>Статья</h2>
        <?php require_once 'templates/menu.php'; ?>
        <h3><?=$article['title']?></h3>
        <p>
            <?=$article['content']?>
        </p>
      </div>
    </div>
  </main>

<?php include_once 'templates/footer.php'; ?>