<?php

namespace app\controllers;

use app\models\Product;
use app\models\Timetable;
use app\base\Model;
use Exception;
use Yii;
use app\models\Work;
use app\models\WorkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * WorkController implements the CRUD actions for Work model.
 */
class WorkController extends Controller
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
     * Lists all Work models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Work model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Work model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new Work();
        $modelsTimetable = [new Timetable];
        $modelsProduct = [new Product];

        if ($model->load(Yii::$app->request->post())) {
            $modelsTimetable = Model::createMultiple(Timetable::classname());
            $modelsProduct = Model::createMultiple(Product::classname());
            Model::loadMultiple($modelsTimetable, Yii::$app->request->post());
            Model::loadMultiple($modelsProduct, Yii::$app->request->post());

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsTimetable) && $valid;
            $valid = Model::validateMultiple($modelsProduct) && $valid;
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsTimetable as $index => $timetable) {
                            $timetable->id_work = $model->id;
                            if (!($flag = $timetable->save(false))) {
                                break;
                            }
                        }
                        if($flag) {
                            foreach ($modelsProduct as $index => $product) {
                                $product->id_work = $model->id;
                                if (!($flag = $product->save(false))) {
                                    break;
                                }
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['update', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelsTimetable' => (empty($modelsTimetable)) ? [new Timetable] : $modelsTimetable,
            'modelsProduct' => (empty($modelsProduct)) ? [new Product] : $modelsProduct,
        ]);
    }

    /**
     * Updates an existing Work model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws \yii\db\Exception
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsTimetable = $model->timetables;
        $modelsProduct = $model->products;

        if ($model->load(Yii::$app->request->post())) {
            $oldTimetableIDs = ArrayHelper::map($modelsTimetable, 'id', 'id');
            $modelsTimetable = Model::createMultiple(Timetable::classname(), $modelsTimetable);
            Model::loadMultiple($modelsTimetable, Yii::$app->request->post());
            $deletedTimetableIDs = array_diff($oldTimetableIDs, array_filter(ArrayHelper::map($modelsTimetable, 'id', 'id')));

            $oldProductIDs = ArrayHelper::map($modelsProduct, 'id', 'id');
            $modelsProduct = Model::createMultiple(Product::classname(), $modelsProduct);
            Model::loadMultiple($modelsProduct, Yii::$app->request->post());
            $deletedProductIDs = array_diff($oldProductIDs, array_filter(ArrayHelper::map($modelsProduct, 'id', 'id')));

            // validate person and houses models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsTimetable) && $valid;
            $valid = Model::validateMultiple($modelsProduct) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedTimetableIDs)) {
                            Timetable::deleteAll(['id' => $deletedTimetableIDs]);
                        }
                        foreach ($modelsTimetable as $index => $timetable) {
                            $timetable->id_work = $model->id;
                            if (!($flag = $timetable->save(false))) {
                                break;
                            }
                        }
                        if($flag){
                            if (! empty($deletedProductIDs)) {
                                Product::deleteAll(['id' => $deletedProductIDs]);
                            }
                            foreach ($modelsProduct as $index => $product) {
                                $product->id_work = $model->id;
                                if (!($flag = $product->save(false))) {
                                    break;
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['update', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
                'model' => $model,
                'modelsTimetable' => (empty($modelsTimetable)) ? [new Timetable] : $modelsTimetable,
                'modelsProduct' => (empty($modelsProduct)) ? [new Product] : $modelsProduct,
            ]);
    }

    /**
     * Deletes an existing Work model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Work model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Work the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Work::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
