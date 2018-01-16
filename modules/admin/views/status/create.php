<?php

use app\models\Company;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Status */

$this->title = 'Create Status';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Company::findOne($company_id)->name, 'url' => ['/admin/company/view','id'=>$company_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'offers' => $offers,
        'company_id' => $company_id,
    ]) ?>

</div>
