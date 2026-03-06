<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/header.php'; ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Статьи</strong> блога</h1>
					<div class="row">
							<form action="" method="post">
								<table class="table">
									<thead class="table-light">
									<tr>
										<th scope="col">#</th>
										<th scope="col">Image</th>
										<th scope="col">Title</th>
										<th scope="col">Created at</th>
										<th></th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($results as $row): ?>
									<tr>
										<th scope="row"><?=$row['id']?></th>
										<td><img width="150" src="/images/<?=$row['img']?>"/></td>
										<td><?=$row['title']?></td>
										<td><?=$row['createdAt']?></td>
										<td>
										<a href="/admin/?act=edit&id=<?=$row['id']?>"><button type="button" class="btn btn-danger">Редактировать</button></a>
										<a href="/admin/?act=delete&id=<?=$row['id']?>"><button type="button" class="btn btn-warning">Удалить</button></a>
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
								<!-- Кнопка "Назад" (Prev) -->
								<?php if($current_page > 1): ?>
									<li class="page-item">
										<a class="page-link" href="/admin/?page=<?=$current_page - 1?>">
											&laquo; Назад
										</a>
									</li>
								<?php else: ?>
									<li class="page-item disabled">
										<span class="page-link">&laquo; Назад</span>
									</li>
								<?php endif; ?>
								<?php for($i = 1; $i <= $pages; $i++): ?>
									<li class="page-item"><a class="page-link" href="/admin/?page=<?=$i?>"><?=$i?></a></li>
								<?php endfor; ?>
								<!-- Кнопка "Вперед" (Next) -->
								<?php if($current_page < $pages): ?>
									<li class="page-item">
										<a class="page-link" href="/admin/?page=<?=$current_page + 1?>">
											Вперед &raquo;
										</a>
									</li>
								<?php else: ?>
									<li class="page-item disabled">
										<span class="page-link">Вперед &raquo;</span>
									</li>
								<?php endif; ?>
							</ul>
					</div>
				</div>
			</main>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/footer.php'; ?>