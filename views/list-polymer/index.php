<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ListPolymerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список полимеров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-polymer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить полимер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id . '. ' . $model->base_polymer . (!empty($model->melting_temperature) ? ' (' . $model->melting_temperature . ')' : '')), ['view', 'id' => $model->id]);
        },
    ]) ?>
<?php Pjax::end(); ?></div>
