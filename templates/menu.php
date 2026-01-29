<?php if(isset($user) && $user): ?>
<div class="menu">
    <a href="/?act=articles" class="btn btn btn-danger">Статьи</a>
    <a href="/?act=add" class="btn btn-primary">Добавить статью</a>
    <a href="/?act=profile" class="btn btn-secondary">Профиль</a>
    <a href="/?act=logout" class="btn btn-success">Выход</a>
</div>
<?php endif ?>