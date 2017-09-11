<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListConditionsMFI */

$this->title = 'Изменение условия определения ПТР: ' . $model->conditions_MFI;
$this->params['breadcrumbs'][] = ['label' => 'Список условий определения ПТР', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->conditions_MFI, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="list-conditions-mfi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
