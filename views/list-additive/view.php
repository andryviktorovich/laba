<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ListAdditive */

$this->title = $model->additive;
$this->params['breadcrumbs'][] = ['label' => 'Список добавок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-additive-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'additive',
            'description:ntext',
            'toxicologists:ntext',
        ],
    ]) ?>

</div>
