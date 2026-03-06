<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/header.php'; ?>

  <main>
    <div class="album py-5 bg-light">
      <div class="container">
        <h2>Статья</h2>
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="act" value="edit">
              <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Название</label>
                <input type="text" value="<?=$article['title']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
              </div>
              <div class="mb-3 text-start">
                <label for="exampleInputSelect" class="form-label">Категория</label>
                <select name="categoryId" class="form-control" id="exampleInputSelect" >
                    <option value="0">-- category --</option>
                    <?php while ($row = $stmtCategory->fetch()): ?>
                        <option value="<?= $row['id'] ?>" <?php if ($article['categoryId'] == $row['id']): ?>selected<?php endif; ?>><?= $row['name'] ?></option>
                    <?php endwhile ?>
                </select>
              </div>
              <div class="mb-3 input-group">
                <span class="input-group-text" for="exampleInputEmail2">Текст статьи</span>
                <textarea name="content" id="exampleInputEmail2" class="form-control" aria-label="With textarea"><?=$article['content']?></textarea>
              </div>
              <div class="mb-3 text-start">
                <label for="exampleInputEmail3" class="form-label">Изображение</label>
                <input type="file" class="form-control" id="exampleInputEmail3" aria-describedby="file" name="file">
              </div>
              <div class="mb-3 text-start">
                <label for="exampleInputCheckbox" class="form-label">Опубликовать</label>
                <input type="checkbox" name="isPublished" value="1" id="exampleInputCheckbox" <?php if($article['isPublished']): ?>checked<?php endif ?> />
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Редактировать</button>
              </div>
        </form>
      </div>
    </div>
  </main>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/footer.php'; ?>