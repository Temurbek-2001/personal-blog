<?php

use app\models\Posts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PostsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return mb_strlen($model->title, 'UTF-8') > 50
                        ? mb_substr($model->title, 0, 50, 'UTF-8') . '...'
                        : $model->title;
                },
            ],
            [
                'attribute' => 'content',
                'format' => 'raw',
                'value' => function ($model) {
                    $cleanContent = strip_tags($model->content);
                    return mb_strlen($cleanContent, 'UTF-8') > 180
                        ? mb_substr($cleanContent, 0, 180, 'UTF-8') . '...'
                        : $cleanContent;  // Return the cleaned content
                },
            ],


            [
                'attribute' => 'categoryName',
                'value' => function ($model) {
                    return $model->category->name ?? '(No Category)';
                },
                'filter' => Html::activeInput('text', $searchModel, 'categoryName', ['class' => 'form-control']),
                'label' => 'Category',
            ],


            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Posts $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('View', $url, ['class' => 'btn btn-primary']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Edit', $url, ['class' => 'btn btn-warning']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Delete', $url, [
                            'class' => 'btn btn-danger',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                            'data-method' => 'post',
                        ]);
                    },
                ],
                'template' => '{view} {update} {delete}', // Specify which buttons to show and in what order
            ],

        ],
    ]); ?>



</div>
