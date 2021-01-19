<?php
/* @var \app\models\Author $model  */
use yii\helpers\Html;
?>
<div class="author mt-3">
    <p><a href="<?= \yii\helpers\Url::toRoute(['author/view', 'id' => $model->id])?>"><?= Html::encode($model->getFullName()) ?></a></p>
</div>
