<?php

/* @var $this \core\controllers\CommentsController */
/* @var $comments array */
/* @var $sort string */

$sorts = [
    ['title' => 'Дате', 'link' => '?sort=date', 'active' => ($sort == 'date')],
    ['title' => 'Автору', 'link' => '?sort=author', 'active' => ($sort == 'author')],
    ['title' => 'E-mail', 'link' => '?sort=email', 'active' => ($sort == 'email')],
]

?>
<div class="comments">
    <h1 class="page-header">Отзывы</h1>

    <div class="tools" style="margin-bottom:20px;">
        <div class="tools__item">
            <span class="text-muted">Сортировать по&nbsp;</span>
            <div class="btn-group btn-group-sm">
                <?php foreach ($sorts as $item): ?>
                    <a href="<?= $item['link'] ?>" class="btn btn-default <?= $item['active'] ? 'active' : '' ?>">
                        <?= $item['title'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if ($comments): ?>
        <div class="list-group">
            <?php foreach ($comments as $comment): ?>
                <div class="list-group-item">
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object" src="http://placehold.it/128x128" alt="" width="128" height="128">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading text-muted">
                               <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <?= $comment['author'] ?>
                            </h4>
                            <p><?= $comment['content'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

