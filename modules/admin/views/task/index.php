<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            $now = new DateTime();
            $dateExec = new DateTime($model->dateExec);

            if ($now->format('Y-m-d') == $dateExec->format('Y-m-d') && $model->checked == false) {
                return ['style' => 'background-color:#f0ad4e;'];
            }
            if ($now > $dateExec && $model->checked == false) {
                return ['style' => 'background-color:#d9534f;'];
            }
            if ($model->checked == 1) {
                return ['style' => 'background-color:#5cb85c;'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',
            'dateExec',
            [
                'attribute' => 'companyname',
                'label' => 'Company',
                'value' => function ($model) {
                    return Html::a($model->company->name,
                        Url::to(['/admin/company/view', 'id' => $model->company_id]),
                        ['class' => 'btn btn-success btn-xs']);
                },
                'format' => 'html'
            ],
            'checked',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
