<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Catalog */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="catalog-view">

    <h1 class="text-truncate w-100"><?= Html::encode($this->title) ?></h1>
    <div class="row mb-3">
        <div class="col-4 d-flex flex-column align-items-center">
            <img src="<?= $model->image ?>" alt="Catalog Photo" class="img-thumbnail text-center float-left catalog-photo"
                style="max-width: 300px; max-height: 300px">
        </div>
        <div class="col-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'description',
                    'created_at:date',
                ],
            ]) ?>
            <p class="d-flex justify-content-end">
                <?= Html::a('Delete Photo', ['catalog/delete-photo', 'id' => $model->id], ['class' => 'btn btn-danger mr-auto',
                    'data' => [
                        'method' => 'post',
                        'confirm' => 'Are you sure you want to delete catalog photo?'
                    ]
                ]) ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary mr-2']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>

    <div class="catalog-authors">
        <h3>Authors</h3>
        <?php foreach ($model->authors as $author): ?>
            <?= $this->render('_author', ['model' => $author]) ?>
        <?php endforeach; ?>
    </div>

</div>
