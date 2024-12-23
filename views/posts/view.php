<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\User;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */
/** @var User $user */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="posts-view">

    <h1 class="post-title"><?= Html::encode($this->title) ?></h1>

    <div class="post-meta">
        <p><strong>Category:</strong> <?= $model->category->name ?? '(No Category)' ?></p>
    </div>

    <div class="post-content">
        <p><?= nl2br(Html::encode($model->content)) ?></p>
        <p >
            <span class="author-info"><strong>Author:</strong> <?= $model->user->username ?? '(System)' ?></span>
            <span class="publish-date"><strong>Published on:</strong> <?= Yii::$app->formatter->asDatetime($model->created_at) ?></span>
        </p>
    </div>

    <?php if (Yii::$app->user->isGuest == false && $model->user_id == Yii::$app->user->id): ?>
        <div class="post-actions">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    <?php endif; ?>

</div>

<?php
// Add custom CSS styles
$this->registerCss(<<<CSS
.posts-view {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.post-title {
    font-size: 2em;
    margin-bottom: 20px;
    color: #333;
    font-weight: bold;
}

.post-meta {
    margin-bottom: 15px;
    font-size: 1.1em;
    color: #555;
}

.post-meta p {
    margin: 5px 0;
}

.post-content {
    font-size: 1.2em;
    line-height: 1.6;
    color: #333;
    margin-bottom: 20px;
}

.post-content p {
    margin: 15px 0;
}

.post-content span {
    display: inline-block;
    margin-right: 30px;
    font-size: 1.1em;
}

.post-content .author-info,
.post-content .publish-date {
    font-weight: normal;
    color: #555;
}

.post-actions {
    margin-top: 20px;
}

.post-actions .btn {
    margin-right: 10px;
    padding: 10px 20px;
}

.post-actions .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.post-actions .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}
CSS
);
?>
