<?php

namespace app\controllers;

use Yii;
use app\models\Taskstatus;
use app\models\TaskstatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskstatusController implements the CRUD actions for Taskstatus model.
 */
class TaskstatusController extends Controller {

    public function beforeAction($action) {

        $currentaction = $action->id;

        $novalidactions = ['commit'];

        if (in_array($currentaction, $novalidactions)) {

            $action->controller->enableCsrfValidation = false;
        }
        parent::beforeAction($action);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Taskstatus models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaskstatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Taskstatus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Taskstatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Taskstatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Taskstatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCommit() {
        $rtn = array(
            'errno' => -1,
            'message' => '错误的参数',
            'retcode' => '',
        );
        $model = new Taskstatus();
        $data = Yii::$app->request->post();
        if (isset($data) & $data) {
            $retcode = (isset($data['retcode']) && $data['retcode'] )? $data['retcode'] : '';
            if (isset($data['cmd']) && $data['cmd'] == 'echo') {
                $rtn['errno'] = 0;
                $rtn['message'] = '正常返回';
                $rtn['data'] = $data;
                $rtn['retcode'] = $retcode;
            } else {
                try {
                    if ($model->load($data) && $model->save()) {
                        $rtn['errno'] = 0;
                        $rtn['message'] = '正常返回';
                        $rtn['retcode'] = $retcode;
                    } else {
                        $rtn['errno'] = -3;
                        $rtn['message'] = $model->getErrors();
                        $rtn['retcode'] = $retcode;
                    }
                } catch (Exception $e) {
                    $rtn['errno'] = -2;
                    $rtn['message'] = $e->message;
                    $rtn['retcode'] = $retcode;
                }
            }
        }
        echo json_encode($rtn);
        exit(0);
    }

    /**
     * Updates an existing Taskstatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Taskstatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Taskstatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Taskstatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Taskstatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
