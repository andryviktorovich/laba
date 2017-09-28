<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\formula\Formula;

/* @var $this yii\web\View */
/* @var $model app\models\Batch */
/* @var $modelFormula app\models\Formula */

$this->title = $model->batch;
$this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="batch-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->batch], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->batch], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'batch',
            'id_mark',
            'amount',
            'cost',
            [
                'attribute' => 'id_machine',
                'value' => $model->machine->title,
            ],
            [
                'attribute' => 'date_start',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            [
                'attribute' => 'release_date',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            [
                'attribute' => 'update_date',
                'format' =>  ['date', 'HH:mm:ss dd.MM.Y'],
            ],
            [
                'attribute' => 'create_date',
                'format' =>  ['date', 'HH:mm:ss dd.MM.Y'],
            ],
        ],
    ]) ?>

    <?php if($model->id_formula == null){ ?>
        <h3>Формула не задана!</h3>
        <p>
            <?= Html::a('Выбрать формулу', ['/formula', 'batch' => $model->batch], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php } elseif($modelFormula == null) { ?>
        <div class="alert alert-danger">Выбранная формула не существует или была удалена!</div>
        <p>
            <?= Html::a('Выбрать формулу', ['/formula', 'batch' => $model->batch], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php  } else { ?>
        <h3><?= 'Формула: ' . $modelFormula->title . '(' . $modelFormula->id_mark . ')' ?></h3>
        <p>
            <?= Html::a('Выбрать другую формулу', ['/formula', 'batch' => $model->batch], ['class' => 'btn btn-info']) ?>
            <?php if($modelFormula->getStatus() > Formula::STATUS_ONE_USE): ?>
                <?= Html::a('Редактировать формулу', ['/formula/update', 'id' => $model->id_formula, 'batch' => $model->batch, 'asNew' => true],
                    [   'class' => 'btn btn-warning',
                        'data' => [
                            'confirm' => 'Данную формулу нельзя редактировать, так как она используется в других партиях. Создать новую формулу на основе выбранной, с возможностью редактирования?'
                        ]
                    ]) ?>
            <?php else: ?>
                <?= Html::a('Редактировать формулу', ['/formula/update', 'id' => $model->id_formula, 'batch' => $model->batch],['class' => 'btn btn-primary']); ?>
            <?php endif; ?>
            <?= Html::a('Убрать формулу', ['delete-formula', 'id' => $model->batch], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите отключить фомулу от этой партии?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?= $this->render('/formula/_formula', [
            'dataProvider' => $modelFormula->searchElements(),
        ]) ?>
    <?php } ?>
</div>
