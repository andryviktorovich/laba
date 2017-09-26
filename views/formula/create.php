<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Formula */
/* @var $modelBatch app\models\Batch */

$this->title = 'Добавление формулы';
if($modelBatch !== null) {
    $this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['/batch/']];
    $this->params['breadcrumbs'][] = ['label' => $modelBatch->batch, 'url' => ['/batch/view', 'id' => $modelBatch->batch]];
    $this->params['breadcrumbs'][] = ['label' => 'Выбор формулы', 'url' => ['/formula/', 'batch' => $modelBatch->batch]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Формулы', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelFormula' => $modelFormula,
        'modelFormulaElements' => $modelFormulaElements,
        'action' => ''
    ]) ?>

</div>
