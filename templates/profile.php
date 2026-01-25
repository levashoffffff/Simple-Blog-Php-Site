<?php include_once 'templates/header.php'; ?>

  <main>
    <div class="album py-5 bg-light">
      <div class="container">
        <h2>Profile</h2>
        <form class="form-horizontal" action="" method="post">
              <input type="hidden" name="act" value="profile">
              <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Имя</label>
                <input type="text" value="<?=$user['name']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
              </div>
              <div class="mb-3 text-start">
                <label for="exampleInputEmail2" class="form-label">Фамилия</label>
                <input type="text" value="<?=$user['surname']?>" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" name="surname">
              </div>
              <div class="mb-3 text-start">
                <label for="exampleInputEmail3" class="form-label">Номер телефона</label>
                <input type="text" value="<?=$user['phone']?>" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" name="phone">
              </div>
              <div class="mb-3 input-group">
                <span class="input-group-text" for="exampleInputEmail4">О себе</span>
                <textarea name="about" id="exampleInputEmail4" class="form-control" aria-label="With textarea"><?=$user['about']?></textarea>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Сохранить</button>
              </div>
        </form>
      </div>
    </div>
  </main>

<?php include_once 'templates/footer.php'; ?>