<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Call */

$this->title = 'Update call: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company->name, 'url' => ['/admin/company/view','id'=>$model->company_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
