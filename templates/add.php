<?php include_once 'templates/header.php'; ?>

  <main>
    <div class="album py-5 bg-light">
      <div class="container">
        <h2>Добавить статью</h2>
        <?php require_once 'templates/menu.php'; ?>
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="act" value="add">
              <span class="text-danger"><?=$error?></span>
              <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Название</label>
                <input type="text" value="<?=$user['name']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
              </div>
              <div class="mb-3 input-group">
                <span class="input-group-text" for="exampleInputEmail2">Текст статьи</span>
                <textarea name="content" id="exampleInputEmail2" class="form-control" aria-label="With textarea"><?=$user['about']?></textarea>
              </div>
              <div class="mb-3 text-start">
                <label for="exampleInputEmail3" class="form-label">Изображение</label>
                <input type="file" class="form-control" id="exampleInputEmail3" aria-describedby="file" name="file">
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Добавить статью</button>
              </div>
        </form>
      </div>
    </div>
  </main>

<?php include_once 'templates/footer.php'; ?>