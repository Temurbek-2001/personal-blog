<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $categoryList */

?>

<?php
$this->registerJsFile('https://cdn.tiny.cloud/1/vphyobduvctle9g4o9s8bdticrli2dmppr05zu4cdq34y37l/tinymce/5/tinymce.min.js', [
    'position' => yii\web\View::POS_END
]);
?>

<?php
$this->registerJs("
    tinymce.init({
        selector: '#content',
        plugins: 'link lists table code fullscreen searchreplace wordcount preview textcolor image media insertdatetime advlist lists link autolink charmap', // Added more plugins
        toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright | bullist numlist | table | fontselect fontsizeselect | forecolor backcolor  | insertdatetime charmap | fullscreen | code preview', // Added more buttons to toolbar
        menubar: false,
        content_css: 'https://www.tiny.cloud/css/codepen.min.css',
        font_formats: 'Arial=arial,helvetica,sans-serif;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier,monospace;Georgia=georgia,serif;Verdana=verdana,arial,helvetica,sans-serif;Times New Roman=times new roman,times,serif;Dancing Script=dancing script,cursive;Pacifico=pacifico,cursive;Sacramento=sacramento,cursive;Caveat=caveat,cursive;Pinyon Script=pinyon script,cursive;', // Added minimalist handwriting-style fonts
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 48pt 72pt', // Custom font size options
        toolbar_mode: 'floating', // Floating toolbar for better usability
        branding: false, // Disable branding
        statusbar: false, // Disable status bar
        height: 400,
        min_height: 400,
    });
", yii\web\View::POS_READY);
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
    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'id' => 'content']) ?>

    <!-- Submit Button -->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
