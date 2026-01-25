<?php include_once 'templates/header.php'; ?>

  <main>
    <div class="album py-5 bg-light">
      <div class="container">
        <h2>Статья</h2>
        <form class="form-horizontal" action="" method="post">
              <input type="hidden" name="act" value="edit">
              <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Название</label>
                <input type="text" value="<?=$article['title']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
              </div>
              <div class="mb-3 input-group">
                <span class="input-group-text" for="exampleInputEmail2">Текст статьи</span>
                <textarea name="content" id="exampleInputEmail2" class="form-control" aria-label="With textarea"><?=$article['content']?></textarea>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Редактировать</button>
              </div>
        </form>
      </div>
    </div>
  </main>

<?php include_once 'templates/footer.php'; ?>