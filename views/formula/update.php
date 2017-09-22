<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Formula */

$this->title = 'Изменение формулы: ' . $modelFormula->title . '(' . $modelFormula->id_mark .  ')';
if($modelBatch !== null) {
    $this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $modelBatch->batch, 'url' => ['/batch/view', 'id' => $modelBatch->batch]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Формулы', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $modelFormula->title, 'url' => ['view', 'id' => $modelFormula->id_formula]];
}
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="formula-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelFormula' => $modelFormula,
        'modelFormulaElements' => $modelFormulaElements
    ]) ?>

</div>
