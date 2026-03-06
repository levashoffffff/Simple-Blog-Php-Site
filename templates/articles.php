<?php include_once 'templates/header.php'; ?>

  <main>
    <div class="album py-5 bg-light">
      <div class="container">
        <h2>Статья</h2>
        <?php require_once 'templates/menu.php'; ?>
        <form action="" method="post">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Created at</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($results as $row): ?>
              <tr>
                <th scope="row"><?=$row['id']?></th>
                <td><img src="/images/<?=$row['img']?>"/></td>
                <td><?=$row['title']?></td>
                <td><?=$row['createdAt']?></td>
                <td>
                  <a href="/?act=edit&id=<?=$row['id']?>"><button type="button" class="btn btn-danger">Редактировать</button></a>
                  <a href="/?act=delete&id=<?=$row['id']?>"><button type="button" class="btn btn-warning">Удалить</button></a>
                </td>
              </tr>
              <?php endforeach ?>
              <?php if(empty($results)): ?>
                <tr>
                  <td colspan="4">
                    Not found
                  </td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </form>
        <ul class="pagination">
					<li class="page-item"><a class="page-link" href="#">Previous</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
      </div>
    </div>
  </main>

<?php include_once 'templates/footer.php'; ?>
