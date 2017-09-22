<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\base\Model;

/* @var $this yii\web\View */
/* @var $model app\models\Formula */

$this->title = $model->title . '(' . $model->id_mark . ')';
$this->params['breadcrumbs'][] = ['label' => 'Формулы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formula-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id_formula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_formula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '\'Вы уверены, что хотите удалить эту формулу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_formula',
            'id_mark',
            'title',
            'update_date',
            'create_date',
        ],
    ]) ?>

    <?= $this->render('_formula', [
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
