<?php

use yii\helpers\Html;

?>
<div class="posts-view">
    <article>
        <header>
            <h1 class="post-title"><?= Html::encode($model->title) ?></h1>
            <div class="post-meta">
                <p><strong>Category:</strong> <?= Html::encode($model->category->name ?? '(No Category)') ?></p>
                <p><strong>Views:</strong> <?= $model->view_count ?></p>
            </div>
        </header>

        <div class="post-content">
            <p><?= Yii::$app->formatter->asHtml($model->content) ?></p>
        </div>

        <footer>
            <div class="post-meta">
                <p><strong>Author:</strong> <?= Html::encode($model->user->username ?? '(System)') ?></p>
                <p><strong>Published on:</strong> <?= Yii::$app->formatter->asDatetime($model->created_at) ?></p>
            </div>

            <?php if (!Yii::$app->user->isGuest && $model->user_id == Yii::$app->user->id): ?>
                <div class="post-actions">
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            <?php endif; ?>
        </footer>
    </article>
</div>

<?php
$this->registerCss(<<<CSS
.posts-view {
    max-width: 800px;
    margin: 20px auto;
    padding: 25px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

.post-title {
    font-size: 2.4em;
    margin-bottom: 15px;
    color: #2c3e50;
    text-align: center;
    font-weight: bold;
}

.post-meta {
    font-size: 1em;
    color: #7f8c8d;
    text-align: center;
    margin-bottom: 20px;
}

.post-meta p {
    margin: 5px 0;
}

.post-content {
    font-size: 1.2em;
    line-height: 1.8;
    color: #34495e;
    margin-bottom: 20px;
}

.post-actions {
    text-align: center;
    margin-top: 20px;
}

.post-actions .btn {
    margin: 0 5px;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1em;
    transition: background-color 0.3s ease;
}

.post-actions .btn-primary:hover {
    background-color: #0056b3;
}

.post-actions .btn-danger:hover {
    background-color: #c82333;
}
CSS
);
?>
