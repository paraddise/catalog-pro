<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="author-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
//        'options' => [
//            'data-pjax' => 1,
//
//        ],
    ]); ?>
    <div class="d-flex mb-3">
        <?= $form->field($model, 'keyword', ['options' => ['class' => 'w-100']]) ?>

        <div class="form-group d-flex h-50 mt-auto mb-0">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary ml-3 ']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
