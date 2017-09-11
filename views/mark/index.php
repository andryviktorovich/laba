<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\ListColor;
use app\models\ListAdditive;
use app\models\ListPolymer;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MarkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Марки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить марку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_mark',
            [
                'attribute'=>'id_color',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    $color = $data->color;
                    return $color ? $color->color : '';
                },
                'filter' => ListColor::getListColor()
            ],
            [
                'attribute'=>'id_additive',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    $additive = $data->additive;
                    return $additive ? $additive->additive : '';
                },
                'filter' => ListAdditive::getListAdditive()
            ],
//            'heat_resistance',
//            'light_fastness',
            // 'pigment_migration',
            // 'contact_with_food',
            // 'norma_MFI',
            // 'conditions_MFI',
            // 'bulk_density',
            // 'polymer_content',
            [
                'attribute'=>'base_polymer',
                'filter' => ListPolymer::getListPolymer()
            ],
            // 'humidity',
            // 'description:ntext',
            // 'update_date',
            // 'create_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
