<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Author */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="author-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'd-flex flex-column justify-content-center align-items-center']]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255, 'class' => 'd-flex flex-column']) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255, 'class' => 'd-flex flex-column']) ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => 255, 'class' => 'd-flex flex-column']) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success ml-auto mr-auto d-block', 'style' => 'min-width: 200px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
