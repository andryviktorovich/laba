<?php

namespace app\controllers;



use Yii;
use app\base\Model;
use app\models\Batch;
use app\models\BatchSearch;
use app\models\BatchDetail;
use app\models\BatchDetailElement;
use app\models\formula\Formula;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * BatchController implements the CRUD actions for Batch model.
 */
class BatchController extends Controller
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
     * Lists all Batch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Batch model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelFormula = Formula::findOne($model->id_formula);
        return $this->render('view', [
            'model' => $model,
            'modelFormula' => $modelFormula,
        ]);
    }

    /**
     * Creates a new Batch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Batch();
        $modelsDetail = [new BatchDetail];
        $modelsDetailElement = [];

        if ($model->load(Yii::$app->request->post())) {
            $modelsDetail = Model::createMultiple(BatchDetail::classname());
            Model::loadMultiple($modelsDetail, Yii::$app->request->post());

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDetail) && $valid;

            $totalPercent = 0;
            if (isset($_POST['BatchDetailElement'])) {
                foreach ($_POST['BatchDetailElement'] as $indexDetail => $details) {
                    foreach ($details as $indexElem => $elem) {
                        $data['BatchDetailElement'] = $elem;
                        $modelElem = new BatchDetailElement;
                        $modelElem->load($data);
                        $totalPercent += $modelElem->percent;
                        $modelsDetailElement[$indexDetail][$indexElem] = $modelElem;
//                        print_r($modelsDetailElement);
                        $valid = $modelElem->validate() && $valid;
                    }
                }
            }
            if($totalPercent > 100 || $totalPercent < 0){
                $model->addError('elements', 'Сумма процентного отношения сырья в формуле не должна быть больше 100%.');
                $valid = false;
            }


            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $indexDetail => $detail) {

                            if ($flag === false) {
                                break;
                            }

                            $detail->batch = $model->batch;

                            if (!($flag = $detail->save(false))) {
                                break;
                            }

                            if (isset($modelsDetailElement[$indexDetail]) && is_array($modelsDetailElement[$indexDetail])) {
                                foreach ($modelsDetailElement[$indexDetail] as $indexElem => $elem) {
                                    $elem->id_detail = $detail->id;
                                    if (!($flag = $elem->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $modelPerson->id]);
                        return $this->redirect(['index',]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->batch]);
//        }
        return $this->render('create', [
            'model' => $model,
            'modelsDetail' => (empty($modelsDetail)) ? [new BatchDetail] : $modelsDetail,
            'modelsDetailElement' => (empty($modelsDetailElement)) ? [[new BatchDetailElement]] : $modelsDetailElement,
        ]);
    }

    /**
     * Updates an existing Batch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsDetail = $model->details;
        $modelsDetailElement = [];
        $oldElem = [];

        if (!empty($modelsDetail)) {
            foreach ($modelsDetail as $indexDetail => $detail) {
                $elements = $detail->elements;
                $modelsDetailElement[$indexDetail] = (empty($elements)) ? [new BatchDetailElement] : $elements;
                $oldElem = ArrayHelper::merge(ArrayHelper::index($elements, 'id'), $oldElem);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            // reset
            $modelsDetailElement = [];

            $oldDetailIDs = ArrayHelper::map($modelsDetail, 'id', 'id');
            $modelsDetail = Model::createMultiple(BatchDetail::classname(), $modelsDetail);
            Model::loadMultiple($modelsDetail, Yii::$app->request->post());
            $deletedDetailIDs = array_diff($oldDetailIDs, array_filter(ArrayHelper::map($modelsDetail, 'id', 'id')));

            // validate person and houses models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDetail) && $valid;

            $totalPercent = 0;
            $elemIDs = [];
            if (isset($_POST['BatchDetailElement'])) {
                foreach ($_POST['BatchDetailElement'] as $indexDetail => $deteils) {
                    $elemIDs = ArrayHelper::merge($elemIDs, array_filter(ArrayHelper::getColumn($deteils, 'id')));
                    foreach ($deteils as $indexElem => $elem) {
                        $data['BatchDetailElement'] = $elem;
                        $modelElem = (isset($elem['id']) && isset($oldElem[$elem['id']])) ? $oldElem[$elem['id']] : new BatchDetailElement();
                        $modelElem->load($data);
                        $totalPercent += $modelElem->percent;
                        $modelsDetailElement[$indexDetail][$indexElem] = $modelElem;
                        $valid = $modelElem->validate() && $valid;
                    }
                }
            }
            if($totalPercent > 100 || $totalPercent < 0){
                $model->addError('elements', 'Сумма процентного отношения сырья в формуле не должна быть больше 100%.');
                $valid = false;
            }

            $oldElemIDs = ArrayHelper::getColumn($oldElem, 'id');
            $deletedElemIDs = array_diff($oldElemIDs, $elemIDs);

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if($model->oldAttributes['id_mark'] !== $model->id_mark){
                        $model->id_formula = null;
                    }
                    if ($flag = $model->save(false)) {

                        if (! empty($deletedElemIDs)) {
                            BatchDetailElement::deleteAll(['id' => $deletedElemIDs]);
                        }

                        if (! empty($deletedDetailIDs)) {
                            BatchDetail::deleteAll(['id' => $deletedDetailIDs]);
                        }

                        foreach ($modelsDetail as $indexDetail => $detail) {

                            if ($flag === false) {
                                break;
                            }

                            $detail->batch = $model->batch;

                            if (!($flag = $detail->save(false))) {
                                break;
                            }

                            if (isset($modelsDetailElement[$indexDetail]) && is_array($modelsDetailElement[$indexDetail])) {
                                foreach ($modelsDetailElement[$indexDetail] as $indexElem => $elem) {
                                    $elem->id_detail = $detail->id;
                                    if (!($flag = $elem->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['update', 'id' => $model->batch]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
//exit();
//        if ($model->load(Yii::$app->request->post())) {
////            print_r($model->oldAttributes);
////            print_r($model->oldAttributes->id_mark);
////            echo 111;
////            print_r($model->id_mark);
//
//            if($model->save()) {
//                return $this->redirect(['view', 'id' => $model->batch]);
//            }
//        }

//        print_r($modelsDetailElement);exit();
        return $this->render('update', [
            'model' => $model,
            'modelsDetail' => (empty($modelsDetail)) ? [new BatchDetail] : $modelsDetail,
            'modelsDetailElement' => (empty($modelsDetailElement)) ? [[new BatchDetailElement]] : $modelsDetailElement,
        ]);
    }

    public function actionChooseFormula($id){

        $model = $this->findModel($id);
//        if (Yii::$app->request->isPost) {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->batch]);
        } else {
            return $this->redirect(['view', 'id' => $model->batch]);
        }
    }

    /**
     * Deletes an existing Batch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionDeleteFormula($id)
    {
        $model = $this->findModel($id);
        $model->id_formula = null;
        $model->save();
        return $this->redirect(['view', 'id' => $model->batch]);
    }

    /**
     * Finds the Batch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Batch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Batch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
