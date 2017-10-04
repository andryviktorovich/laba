<?php
//
//namespace app\controllers;
//
//use Yii;
//use app\models\BatchDetail;
//use app\models\BatchDetailSearch;
//use yii\web\Controller;
//use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;
//
///**
// * BatchDetailController implements the CRUD actions for BatchDetail model.
// */
//class BatchDetailController extends Controller
//{
//    /**
//     * @inheritdoc
//     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }
//
//    /**
//     * Lists all BatchDetail models.
//     * @return mixed
//     */
//    public function actionIndex()
//    {
//        $searchModel = new BatchDetailSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }
//
//    /**
//     * Displays a single BatchDetail model.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }
//
//    /**
//     * Creates a new BatchDetail model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new BatchDetail();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }
//
//    /**
//     * Updates an existing BatchDetail model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }
//
//    /**
//     * Deletes an existing BatchDetail model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }
//
//    /**
//     * Finds the BatchDetail model based on its primary key value.
//     * If the model is not found, a 404 HTTP exception will be thrown.
//     * @param integer $id
//     * @return BatchDetail the loaded model
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    protected function findModel($id)
//    {
//        if (($model = BatchDetail::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }
//}
