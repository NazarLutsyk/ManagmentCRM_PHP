<?php

use app\models\Company;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Call */

$this->title = 'Create call';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Company::findOne($company_id)->name, 'url' => ['/admin/company/view','id'=>$company_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'company_id' => $company_id,
    ]) ?>

</div>
