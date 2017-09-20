<?php

namespace app\controllers;

use app\models\FormulaElementsSearch;
use Yii;
use app\base\Model;
use app\models\Formula;
use app\models\FormulaSearch;
use app\models\FormulaElements;
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
    public function actionIndex()
    {
        $searchModel = new FormulaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Formula model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModel = new FormulaElementsSearch();
        $dataProvider = $searchModel->search($id);
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Formula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelFormula = new Formula();
        $modelFormulaElements = [new FormulaElements];

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
                        return $this->redirect(['view', 'id' => $modelFormula->id_formula]);
//                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
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
    public function actionUpdate($id)
    {
        $modelFormula = $this->findModel($id);
        $modelFormulaElements = $modelFormula->elements;

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
                        return $this->redirect(['view', 'id' => $modelFormula->id_formula]);
//                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('update', [
            'modelFormula' => $modelFormula,
            'modelFormulaElements' => (empty($modelFormulaElements)) ? [new FormulaElements] : $modelFormulaElements
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
        $this->findModel($id)->delete();
        if (FormulaElements::deleteAll(['id_formula' => $id])) {
            Yii::$app->session->setFlash('success', 'Record formula  <strong>"' . $id . '"</strong> deleted successfully.');
        }
        return $this->redirect(['index']);
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
