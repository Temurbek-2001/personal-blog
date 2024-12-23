<?php

/** @var yii\web\View $this */
/** @var app\models\Posts[] $model */

$this->title = 'Personal Blog';
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
                    <!-- Wrap the card with a link to the post page -->
                    <a href="<?= \yii\helpers\Url::to(['posts/view', 'id' => $post->id]) ?>" class="card-link">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($post->title) ?></h5>
                                <p class="card-text post-content">
                                    <?= htmlspecialchars(substr($post->content, 0, 150)) ?>...
                                </p>
                            </div>
                            <div class="card-footer text-muted">
                                <small>Posted on <?= date('F j, Y', strtotime($post->created_at)) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<!-- Add this CSS in your page or in a separate CSS file -->
<style>
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .post-content {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
        height: 50px; /* Limit content height */
    }

    .card {
        display: flex;
        flex-direction: column;
    }

    .card-footer {
        margin-top: auto;
    }

    /* Optional: Style the link to remove default underlines and ensure card looks intact */
    .card-link {
        text-decoration: none;
        color: inherit;
    }
</style>
