<?php

/** @var yii\web\View $this */
/** @var app\models\Posts[] $model */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Welcome!</h1>
        <p class="lead">Here are the latest posts:</p>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach ($model as $post): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($post->title) ?></h5>
                            <p class="card-text">
                                <?= htmlspecialchars($post->content) ?>
                            </p>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Posted on <?= date('F j, Y', strtotime($post->created_at)) ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
