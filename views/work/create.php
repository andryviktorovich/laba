<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Work */

$this->title = Yii::t('app', 'Добавление работ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Работы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsTimetable' => $modelsTimetable,
        'modelsProduct' => $modelsProduct,
    ]) ?>

</div>
