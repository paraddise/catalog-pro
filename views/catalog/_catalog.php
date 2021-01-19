<?php
/* @var \app\models\Catalog $model */

use yii\bootstrap4\Html;
use yii\helpers\Url;

?>
<div class="catalog d-flex mt-3 border rounded p-2">
        <img src="<?= $model->image ?>"  class="border rounded catalog-photo text-center" alt="Catalog Photo" width="150px" height="150px"/>
    <div class="catalog-desc ml-3 w-100">
        <?= Html::a(Html::encode($model->title), ['catalog/view', 'id' => $model->id], ['class' => 'text-decoration-none']) ?>
        <p><?= Html::encode($model->description) ?></p>
        <small><?= \Yii::$app->formatter->asDate($model->created_at) ?></small>
    </div>
    <div class="catalog-actions d-flex flex-column justify-content-between p-2">
        <?= Html::a('Update', Url::to(['catalog/update', 'id' => $model->id]), ['class' => '']) ?>
        <?= Html::a('Delete', Url::to(['catalog/delete', 'id' => $model->id]), ['class' => 'text-danger', 'data' => [
            'confirm' => 'Are you sure you want to delete this catalog?',
            'method' => 'post',
        ],]) ?>
    </div>
</div>
