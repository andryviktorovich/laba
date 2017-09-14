<?php

namespace app\controllers;

use Yii;
use app\models\MaterialConsumption;
use app\models\MaterialConsumptionSearch;
use app\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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

    /**
     * Displays a single MaterialConsumption model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MaterialConsumption model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        $modelCustomer = new Customer;
        $items = [new MaterialConsumption];

//        if (Model::loadMultiple($items, Yii::$app->request->post()) &&
//            Model::validateMultiple($items)) {

        if (Yii::$app->request->isPost) {

            $items = Model::createMultiple(MaterialConsumption::classname());
            Model::loadMultiple($items, Yii::$app->request->post());

            // validate all models
//            $valid = $modelCustomer->validate();
//            $valid = ) && $valid;

            if (Model::validateMultiple($items)) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    $flag = true;
//                    if ($flag = $modelCustomer->save(false)) {
                        foreach ($items as $item) {
//                            $item->customer_id = $modelCustomer->id;
                            if (! ($flag = $item->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
//                    }

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


//        $model = new materialconsumption();
//        $model->adddefaultparam();
//        if ($model->load(yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->renderajax('create', [
//                'model' => $model,
//                'number' => $number
//            ]);
//        }
    }

    /**
     * Updates an existing MaterialConsumption model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }

        $items = MaterialConsumption::findAll(['batch' => $id]);//MaterialConsumption::getItemsToUpdate($id);
//        var_dump($items);
//        exit();
//        print_r(Yii::$app->request->post());
        if (Model::loadMultiple($items, Yii::$app->request->post()) &&
            Model::validateMultiple($items)) {
            $count = 0;
            foreach ($items as $item) {
                // populate and save records for each model
                if ($item->save()) {
                    // do something here after saving
                    $count++;
                }
            }
            Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");
            return $this->redirect(['index']); // redirect to your next desired page
        } else {
//            var_dump($items);
            return $this->render('update', [
                'items' => $items,
                'batch' => $id
            ]);
        }
    }

    /**
     * Deletes an existing MaterialConsumption model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
