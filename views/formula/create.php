<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Formula */

$this->title = 'Добавление формулы';
$this->params['breadcrumbs'][] = ['label' => 'Формулы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelFormula' => $modelFormula,
        'modelFormulaElements' => $modelFormulaElements
    ]) ?>

</div>
