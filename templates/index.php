<?php include_once 'templates/header.php'; ?>

  <main>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Album example</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator,
            etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Main call to action</a>
            <a href="#" class="btn btn-secondary my-2">Secondary action</a>
          </p>
        </div>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php while($row = $results->fetch_assoc()): ?>
          <div class="col">
            <div class="card shadow-sm">
              <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
                role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                  dy=".3em">Thumbnail</text>
              </svg> -->
              <img class="card-img-top" src="/images/<?=$row['img']?>" alt="Card image cap">

              <div class="card-body">
                <h3 class="cart-title"><?=htmlspecialchars($row['title'])?></h3>
                <p class="card-text"><?=htmlspecialchars($row['content'])?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="/?act=view&id=<?=$row['id']?>"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                    <?php if($user && $row['userId'] == $user['id']): ?>
                    <a href="/?act=edit&id=<?=$row['id']?>"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                    <?php endif ?>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
          <?php endwhile ?>
        </div>
      </div>
    </div>

  </main>

<?php include_once 'templates/footer.php'; ?>