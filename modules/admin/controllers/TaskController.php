<?php

namespace app\modules\admin\controllers;

use app\models\Company;
use Yii;
use app\models\Task;
use app\models\TaskSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($company_id = '')
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->company_id))
                $model->company_id = Yii::$app->request->post('company_id');
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }
        if (empty($company_id)) {
            $companies = ArrayHelper::map(Company::find()->asArray()->all(), 'id', 'name');
            return $this->render('create', [
                'model' => $model,
                'companies' => $companies,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'company_id' => $company_id,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $companies = ArrayHelper::map(Company::find()->asArray()->all(), 'id', 'name');
        return $this->render('update', [
            'model' => $model,
            'companies' => $companies,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCheck($id)
    {
        $task = $this->findModel($id);
        if ($task->checked) {
            $task->checked = 0;
        } else {
            $task->checked = 1;
        }
        $task->save();
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
