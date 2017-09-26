<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelFormula app\models\Formula */
/* @var $modelBatch app\models\Batch */
/* @var $asNew boolean */

$this->title = 'Изменение формулы: ' . $modelFormula->title . '(' . $modelFormula->id_mark .  ')';
$action = ($asNew) ? 'create' : 'update';
if($modelBatch !== null) {
    $this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['/batch/']];
    $this->params['breadcrumbs'][] = ['label' => $modelBatch->batch, 'url' => ['/batch/view', 'id' => $modelBatch->batch]];
    if($modelBatch->id_formula != $modelFormula->id_formula) {
        $this->params['breadcrumbs'][] = ['label' => 'Выбор формулы', 'url' => ['/formula/', 'batch' => $modelBatch->batch]];
    }
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Формулы', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $modelFormula->title, 'url' => ['view', 'id' => $modelFormula->id_formula]];
}
$this->params['breadcrumbs'][] = 'Изменение формулы';
?>
<div class="formula-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelFormula' => $modelFormula,
        'modelFormulaElements' => $modelFormulaElements,
        'action' => ['/formula/'.$action, 'id' => $modelFormula->id_formula, 'batch' => $modelBatch->batch],
    ]) ?>
</div>
