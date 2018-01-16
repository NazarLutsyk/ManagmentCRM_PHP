<?php

namespace app\modules\admin\controllers;

use app\models\CallSearch;
use app\models\ContactPersonSearch;
use app\models\StatusSearch;
use app\models\TaskSearch;
use Yii;
use app\models\Company;
use app\models\CompanySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $queryParams = Yii::$app->request->queryParams;
        $callSearch = new CallSearch();
        if (empty($queryParams['CallSearch']))
            $calls = $callSearch->search(['CallSearch' => ['company_id' => $id]]);
        else {
            ArrayHelper::setValue($queryParams, 'CallSearch.company_id', $id);
            $calls = $callSearch->search($queryParams);
        }

        $taskSearch = new TaskSearch();
        if (empty($queryParams['TaskSearch']))
            $tasks = $taskSearch->search(['TaskSearch' => ['company_id' => $id]]);
        else {
            ArrayHelper::setValue($queryParams, 'TaskSearch.company_id', $id);
            $tasks = $taskSearch->search($queryParams);
        }

        $statusSearch = new StatusSearch();
        if (empty($queryParams['StatusSearch']))
            $statuses = $statusSearch->search(['StatusSearch' => ['company_id' => $id]]);
        else {
            ArrayHelper::setValue($queryParams, 'StatusSearch.company_id', $id);
            $statuses = $statusSearch->search($queryParams);
        }

        $contactPersonSearch = new ContactPersonSearch();
        if (empty($queryParams['ContactPersonSearch']))
            $contactPersons = $contactPersonSearch->search(['ContactPersonSearch' => ['company_id' => $id]]);
        else{
            ArrayHelper::setValue($queryParams, 'ContactPersonSearch.company_id', $id);
            $contactPersons = $contactPersonSearch->search($queryParams);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'calls' => $calls,
            'callSearch' => $callSearch,
            'tasks' => $tasks,
            'statuses' => $statuses,
            'contactPersons' => $contactPersons,
            'callSearch' => $callSearch,
            'taskSearch' => $taskSearch,
            'statusSearch' => $statusSearch,
            'contactPersonSearch' => $contactPersonSearch
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Company model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Company model.
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

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
