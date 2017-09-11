<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ListPolymer */

$this->title = 'Добавление полимера';
$this->params['breadcrumbs'][] = ['label' => 'Список полимеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-polymer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
