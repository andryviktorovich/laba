<?php

namespace app\controllers;

use app\models\MaterialInStock;
use Yii;
use app\models\MaterialConsumption;
use app\models\MaterialConsumptionSearch;
use app\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
//use yii\base\Model;

/**
 * MaterialConsumptionController implements the CRUD actions for MaterialConsumption model.
 */
class MaterialConsumptionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MaterialConsumption models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialConsumptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInStock()
    {
        $items = [new MaterialConsumption];
        $searchModel = new MaterialInStock();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('instock', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items' => $items,
        ]);
    }

    /**
     * Displays a single MaterialConsumption model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new MaterialConsumption model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $items = [new MaterialConsumption];

        if (Yii::$app->request->isPost) {

            $items = Model::createMultiple(MaterialConsumption::classname());
            Model::loadMultiple($items, Yii::$app->request->post());


            if (Model::validateMultiple($items)) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    $flag = true;
                    foreach ($items as $item) {
                        if (! ($flag = $item->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'items' => (empty($items)) ? [new MaterialConsumption] : $items
        ]);
    }

    /**
     * Updates an existing MaterialConsumption model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $items = MaterialConsumption::findAll(['batch' => $id]);

        if (Yii::$app->request->isPost) {

            $oldIDs = ArrayHelper::map($items, 'id', 'id');
            $items = Model::createMultiple(MaterialConsumption::classname(), $items);
            Model::loadMultiple($items, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($items, 'id', 'id')));

            if (Model::validateMultiple($items)) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $flag = true;
                    if (!empty($deletedIDs)) {
                        MaterialConsumption::deleteAll(['id' => $deletedIDs]);
                    }
                    foreach ($items as $item) {

                        if (! ($flag = $item->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }
        }

        return $this->render('update', [
                'items' => $items,
                'batch' => $id
        ]);
    }

    /**
     * Deletes an existing MaterialConsumption model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (MaterialConsumption::deleteAll(['batch' => $id])) {
            Yii::$app->session->setFlash('success', 'Record batch  <strong>"' . $id . '"</strong> deleted successfully.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the MaterialConsumption model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MaterialConsumption the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaterialConsumption::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
