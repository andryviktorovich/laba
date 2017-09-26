<?php

namespace app\controllers;


use Yii;
use app\base\Model;
use app\models\Formula;
use app\models\FormulaSearch;
use app\models\FormulaElements;
use app\models\Batch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * FormulaController implements the CRUD actions for Formula model.
 */
class FormulaController extends Controller
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
     * Lists all Formula models.
     * @return mixed
     */
    public function actionIndex($batch = null)
    {
        $modelBatch = Batch::findOne($batch);
        $searchModel = new FormulaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'batch' => $modelBatch,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Formula model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $batch = null)
    {
        $model = $this->findModel($id);
        $modelBatch = Batch::findOne($batch);
//        $model->getStatus();
        return $this->render('view', [
            'model' => $model,
            'modelBatch' => $modelBatch,
        ]);
    }

    /**
     * Creates a new Formula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($batch = null)
    {
        $modelFormula = new Formula();
        $modelFormulaElements = [new FormulaElements];

//        if (($modelBatch = Batch::findOne($batch)) !== null) {
//            $modelFormula->id_mark = $modelBatch->id_mark;
//        }
        $modelBatch = Batch::findOne($batch);

        if ($modelFormula->load(Yii::$app->request->post())) {

            $modelFormulaElements = Model::createMultiple(FormulaElements::classname());
            Model::loadMultiple($modelFormulaElements, Yii::$app->request->post());

            // validate all models
            $valid = $modelFormula->validate();
            $valid = Model::validateMultiple($modelFormulaElements) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $modelFormula->save(false)) {
                        foreach ($modelFormulaElements as $item) {
                            $item->id_formula = $modelFormula->id_formula;
                            if (! ($flag = $item->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        if($modelBatch !== null) {
                            $modelBatch->id_formula = $modelFormula->id_formula;
                            $modelBatch->save();
                            return $this->redirect(['/batch/view', 'id' => $modelBatch->batch]);
                        }
                        return $this->redirect(['view', 'id' => $modelFormula->id_formula, 'batch' => $modelBatch->batch]);
//                        }

//                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelBatch' => $modelBatch,
            'modelFormula' => $modelFormula,
            'modelFormulaElements' => (empty($modelFormulaElements)) ? [new FormulaElements] : $modelFormulaElements
        ]);

    }

    /**
     * Updates an existing Formula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $batch = null, $asNew = false)
    {
        $modelFormula = $this->findModel($id);
        $modelFormulaElements = $modelFormula->elements;

        $modelBatch = Batch::findOne($batch);

        if($modelFormula->getStatus() > Formula::STATUS_ONE_USE && !$asNew) {
            return $this->render('error', [
                'modelFormula' => $modelFormula,
                'title' => 'Изменение формулы: ' . $modelFormula->title . '(' . $modelFormula->id_mark .  ')',
                'message' => 'Не возможно изменить данную формулу! Она уже используется в нескольких партиях.',
            ]);
        }

        if ($modelFormula->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelFormulaElements, 'id', 'id');
            $modelFormulaElements = Model::createMultiple(FormulaElements::classname(), $modelFormulaElements);
            Model::loadMultiple($modelFormulaElements, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelFormulaElements, 'id', 'id')));

            // validate all models
            $valid = $modelFormula->validate();
            $valid = $modelFormula->validateElements($modelFormulaElements) && $valid;//Model::validateMultiple($modelFormulaElements) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelFormula->save(false)) {
                        if (!empty($deletedIDs)) {
                            FormulaElements::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelFormulaElements as $item) {
                            $item->id_formula = $modelFormula->id_formula;
                            if (! ($flag = $item->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        if($modelBatch !== null && $modelFormula->id_formula == $modelBatch->id_formula) {
                            return $this->redirect(['/batch/view', 'id' => $modelBatch->batch]);
                        } else {
                            return $this->redirect(['view', 'id' => $modelFormula->id_formula]);
                        }
//                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('update', [
            'modelBatch' => $modelBatch,
            'modelFormula' => $modelFormula,
            'modelFormulaElements' => (empty($modelFormulaElements)) ? [new FormulaElements] : $modelFormulaElements,
            'asNew' => $asNew,
        ]);
    }

    /**
     * Deletes an existing Formula model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->getStatus() > Formula::STATUS_ONE_USE) {
            return $this->render('error', [
                'modelFormula' => $model,
                'title' => 'Удаление формулы: ' . $model->title . '(' . $model->id_mark .  ')',
                'message' => 'Не возможно удалить данную формулу! Она уже используется в нескольких партиях.',
            ]);
        } else {
            $model->delete();
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Formula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Formula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Formula::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
