<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\helpers\ArrayHelper;
use app\models\Position;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Сотрудники');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить сотрудника'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'surname',
            'name',
            [
                'attribute'=>'position',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=> function($data){
                    return $data->positions->title ?? '';
                },
                'filter' => Position::getListPosition()
            ],
            // 'phone',
            // 'email:email',
            // 'skype',
            // 'birth_day',
            // 'head',
            [
                'attribute'=>'active',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=> function($data){
                    return $data->getActive();
                },
                'filter' => ArrayHelper::map([['id' => 1, 'val' => 'Да'],['id' => 0, 'val' => 'Нет']], 'id', 'val')
            ],
            // 'update_date',
            // 'create_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
