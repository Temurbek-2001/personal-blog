<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $categoryList */

?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Dropdown for Category -->
    <?= $form->field($model, 'category_id')
        ->label('Category')
        ->dropDownList(
            $categoryList,
            ['prompt' => ' -- Select Category --']
        ) ?>

    <!-- Text input for Title -->
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!-- Textarea for Content -->
    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <!-- Submit Button -->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
