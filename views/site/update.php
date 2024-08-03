<?php

/** @var yii\web\View $this */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'CRUD using Yii';
?>
<div class="container">
    <h1 class="text-success mt-3">Update Product</h1>
    
    <?php $form = ActiveForm::begin() ?>
    <div class="row mt-5">
        <div class="form-group">
            <div class="col-md-6">
                <?= $form->field($product, 'title') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($product, 'description')->textarea(['rows' => '6']) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($product, 'price') ?>
            </div>

            <div class="col-md-3 mt-5">
                <?= Html::submitButton('Update Product', ['class' => 'btn btn-success']) ?>
                <a href="<?= yii::$app->homeUrl ?>" class="btn btn-dark" style="margin-left: 40px">Go back</a>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>

<style>
    .help-block {
        color: red;
    }
</style>

<!-- Include SweetAlert CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<?php
$success = Yii::$app->session->getFlash('success');
$error = Yii::$app->session->getFlash('error');

if ($success) {
    $this->registerJs("
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '$success',
        });
    ");
}

if ($error) {
    $this->registerJs("
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '$error',
        });
    ");
}
?>
