<?php

use app\controllers\MyHelper;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Add contact person', ['/admin/contact-person/create', 'company_id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Add task', ['/admin/task/create', 'company_id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Add status', ['/admin/status/create', 'company_id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Add call', ['/admin/call/create', 'company_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'phone',
            'email:email',
            'adress',
            'url:url',
        ],
    ]) ?>

    <? if ($contactPersons->count > 0): ?>
    <h2>Contact Persons</h2>
        <?= GridView::widget([
            'dataProvider' => $contactPersons,
//        'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'surname',
                'position',
                'phone',
                //'email:email',
                //'company_id',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/admin/contact-person/view', 'id' => $model->id]);
                            return Html::a('SHOW', $url,
                                [
                                    'title' => Yii::t('yii', 'View'),
                                    'class' => 'btn btn-primary btn-xs'
                                ]);
                        },
                    ]
                ],
            ],
        ]); ?>
    <? endif; ?>

    <? if ($statuses->count > 0): ?>
    <h2>Statuses</h2>
    <?= GridView::widget([
        'dataProvider' => $statuses,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'value',
            [
                'attribute' => offers,
                'value' => function($model){
                    $offers = ArrayHelper::map($model->getOffers()->asArray()->all(), 'id', 'name');
                    return MyHelper::builUl($offers);
                },
                'format' => 'html'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = \yii\helpers\Url::toRoute(['/admin/status/view', 'id' => $model->id]);
                        return Html::a('SHOW', $url,
                            [
                                'title' => Yii::t('yii', 'View'),
                                'class' => 'btn btn-primary btn-xs'
                            ]);
                    },
                ]
            ],
        ],
    ]); ?>
    <? endif; ?>

    <? if ($tasks->count > 0): ?>
    <h2>Tasks</h2>
    <?= GridView::widget([
        'dataProvider' => $tasks,
//        'filterModel' => $searchModel,
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
            'checked',
//            'company_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = \yii\helpers\Url::toRoute(['/admin/task/view', 'id' => $model->id]);
                        return Html::a('SHOW', $url,
                            [
                                'title' => Yii::t('yii', 'View'),
                                'class' => 'btn btn-primary btn-xs'
                            ]);
                    },
                ]
            ],
        ],
    ]); ?>
    <? endif; ?>

    <? if ($calls->count > 0): ?>
    <h2>Calls</h2>
        <?= GridView::widget([
            'dataProvider' => $calls,
//        'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'date',
                'description',
//            'company_id',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/admin/call/view', 'id' => $model->id]);
                            return Html::a('SHOW', $url,
                                [
                                    'title' => Yii::t('yii', 'View'),
                                    'class' => 'btn btn-primary btn-xs'
                                ]);
                        },
                    ]
                ],
            ],
        ]); ?>
    <? endif; ?>
</div>
