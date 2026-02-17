<?php include_once 'templates/header.php'; ?>

  <main>
    <div class="album py-5 bg-light">
      <div class="container">
        <h2>Статья</h2>
        <?php require_once 'templates/menu.php'; ?>
        <h3><?=$article['title']?></h3>
        <img src="/images/<?=$article['img']?>" alt="<?=$article['title']?>" align="left" vspace="5" hspace="5" />
        <p>
            <?=$article['content']?>
        </p>
        <form action="" method="POST">
          <input type="hidden" name="act" value="view"/>
          <div class="form-group">
            <label for="exampleInputEmail1">Comment text</label>
            <textarea name="comment" class="form-control" id="exampleInputEmail1" rows="5" placeholder="Comment"></textarea>
            <button type="submit" class="btn btn-primary">Add comment</button>
          </div>
        </form>
        <!--Блок комментариев-->
        <?php while($comment = $stmtComment->fetch()): ?>
        <p>
          <?php if($comment['userId']): ?>
            <b><?=$comment['email']?></b>
          <?php endif ?>
          <?=$comment['content']?>
        </p>
        <?php endwhile ?>
      </div>
    </div>
  </main>

<?php include_once 'templates/footer.php'; ?>