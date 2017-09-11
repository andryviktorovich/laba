<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ListConditionsMFI */

$this->title = 'Создание условия определения ПТР';
$this->params['breadcrumbs'][] = ['label' => 'Список условий определения ПТР', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-conditions-mfi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
