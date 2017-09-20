<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Marks;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FormulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Формулы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formula-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить формулу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_formula',
            [
                'attribute'=>'id_mark',
                'format'=>'text', // Возможные варианты: raw, html
                'filter' => Marks::getListMarks()
            ],
            'title',
//            'update_date',
//            'create_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
