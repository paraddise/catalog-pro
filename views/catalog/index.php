<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">



    <?php Pjax::begin(); ?>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?php /*GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'columns' => [
            [
                    'attribute' => 'title',
                    'value' => fn($data) => Html::a(Html::encode($data->title), Url::to(['catalog/view', 'id' => $data->id])),
                    'format' => 'raw'

            ],
            'description',
            'created_at:datetime',
            [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Action',
                    'controller' => 'catalog',
                'buttons' => [
                        'update' => fn($url, $model, $key) => Html::a('Update', $url, ['class' => 'btn btn-primary']),
                        'delete' => fn($url, $model, $key) => Html::a('Delete', $url, ['data-method' => 'post', 'class' => 'btn btn-danger']),
                ]
            ],
        ],
        'options' => ['class' => 'text-dark text-decoration-none']

    ]); */ ?>

    <?php $widget  = ListView::begin([
        'dataProvider' => $dataProvider,
        'layout' => '{summary}{items}{pager}',
        'itemView' => '_catalog',
        'sorter' => [
            'attributes' => ['title', 'created_at'],
            'linkOptions' => ['class' => 'btn btn-primary mr-2 p-2'],
            'options' => ['class' => 'm-0 list-unstyled d-flex']
        ],
    ]) ?>

    <div class="d-flex mb-2">

    <?= $widget->renderSorter() ?>
    <?= Html::a('Create Catalog', ['create'], ['class' => 'btn btn-success ml-auto']) ?>
    </div>
    <?php $widget->end() ?>

    <?php Pjax::end(); ?>

</div>
