<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\base\Model;

/* @var $this yii\web\View */
/* @var $model app\models\Formula */
/* @var $modelBatch app\models\Batch */

$this->title = 'Формула: ' . $model->title . '(' . $model->id_mark . ')';
if($modelBatch !== null) {
    $this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['/batch/']];
    $this->params['breadcrumbs'][] = ['label' => $modelBatch->batch, 'url' => ['/batch/view', 'id' => $modelBatch->batch]];
    $this->params['breadcrumbs'][] = ['label' => 'Выбор формулы', 'url' => ['/formula/', 'batch' => $modelBatch->batch]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Формулы', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formula-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id_formula, 'batch' => $modelBatch->batch], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_formula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту формулу?',
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
        'dataProvider' => $model->searchElements(),
    ]) ?>

</div>
