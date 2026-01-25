<?php include_once 'templates/header.php'; ?>

 <main>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h3 class="card-title text-center mb-4">Форма входа</h3>
            <span class="text-danger align-middle">
              <i class="fa fa-close"></i> <?=$error?>
            </span>
            <form action="" method="post">
              <input type="hidden" name="act" value="login">
              <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Почта</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
              </div>
              <div class="mb-3 text-start">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Войти</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include_once 'templates/footer.php'; ?>