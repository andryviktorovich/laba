<?php

use yii\helpers\Html;
use app\models\formula\Formula;

/* @var $model app\models\Batch */
/* @var $modelFormula app\models\Formula */

?>

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