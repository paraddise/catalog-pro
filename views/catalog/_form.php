<?php

use app\models\Author;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

\app\assets\CreateCatalogAsset::register($this);


/* @var $this yii\web\View */
/* @var $model app\models\CreateCatalogForm */
/* @var $form yii\widgets\ActiveForm */
$authorsSelect = array_map(fn($a) => (is_null($author = Author::findOne($a)) ?: $author), $model->authors);
?>

<div class="catalog-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-row">
        <div class="col mr-2">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description', ['options' => ['class' => 'mb-3']])->textInput(['maxlength' => true]) ?>
            <div class="row d-flex">

                <div class="col p-0">
                    <?= $form->field($model, 'published', [
                            'labelOptions' => ['class' => 'ml-3'],
                            'options' => ['class' => 'w-100']
                    ])->widget(DatePicker::class, [
                        'model' => $model,
                        'attribute' => 'published',
                        'dateFormat' => 'long',
                        'options' => ['class' => 'p-0 ml-3'],

                    ]) ?>
                </div>
                <div class="col-9">

                    <?= $form->field($model, 'imageFile', [
                            'options' => [
                                    'class' => 'custom-file input-lg',
                                    'style' => 'margin-top: 30px'
                            ]
                        ])->fileInput(['class' => 'custom-file-input', 'max' => 2])
                        ->label('Choose image for the catalog', ['class' => 'custom-file-label'])
                    ?>
                </div>
            </div>
        </div>

    </div>

    <div class="form-row mt-3 flex-nowrap">

        <div class="col">
            <?= $field = $form->field($model, 'authors', [
                'template' => '{label}{input}<ul id="authorsList" class="list-group border" style="min-height: 300px"></ul>{hint}{error}'
            ])
                ->dropDownList(ArrayHelper::map($authorsSelect, 'id', 'fullName'), [
                    'multiple' => true,
                    'class' => 'custom-select',
                    'size' => 5,
                    'id' => 'authorsListSelect',
                    'hidden' => true
                ]) ?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success mt-3']) ?>

        </div>
        <div class="col mt-4">

            <input id="searchCatalogAuthors" type="text" class="w-100" placeholder="Enter author name"/>
            <ul id="dropDownSelectList" class="list-group" style="display: none">

            </ul>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

