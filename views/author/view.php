<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = $model->id;
$last_name = Html::encode($model->last_name);
$first_name = Html::encode($model->first_name);
$patronymic = Html::encode($model->patronymic);
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $first_name . ' ' . $last_name;
\yii\web\YiiAsset::register($this);
?>
<div class="author-view">
    <div>
        <h3><small class="text-muted">First name: </small> <?= $first_name?></h3>
        <h3><small class="text-muted">Last name:  </small> <?= $last_name?></h3>
        <h3><small class="text-muted">Patronymic: </small> <?= $patronymic ?></h3>

        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary mr-2']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="catalogs mt-5">
        <h3>Catalogs</h3>
        <?php foreach ($model->catalogs as $catalog): ?>
            <?= $this->render('../catalog/_catalog', ['model' => $catalog]) ?>
        <?php endforeach; ?>

    </div>

</div>
