<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ListColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список цветов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-color-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить цвет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id_color . '. ' . $model->color . ' (' . $model->color_en . ')'), ['view', 'id' => $model->id_color]);
        },
    ]) ?>
<?php Pjax::end(); ?></div>
