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
              <?php while($row = $results->fetch_assoc()): ?>
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
              <?php endwhile ?>
              <?php if($results->num_rows === 0): ?>
                <tr>
                  <td colspan="4">
                    Not found
                  </td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </main>

<?php include_once 'templates/footer.php'; ?>
