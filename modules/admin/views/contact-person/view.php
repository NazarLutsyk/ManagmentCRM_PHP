<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ContactPerson */

$this->title = 'Contact Person: '.$model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company->name, 'url' => ['/admin/company/view','id'=>$model->company_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'surname',
            'position',
            'phone',
            'email:email',
            [
                'attribute' => 'company_id',
                'label' => 'Company',
                'value' => function ($model) {
                    return Html::a($model->company->name,
                        Url::to(['/admin/company/view', 'id' => $model->company_id]),
                        ['class' => 'btn btn-success btn-xs']);
                },
                'format' => 'html'
            ],
        ],
    ]) ?>

</div>
