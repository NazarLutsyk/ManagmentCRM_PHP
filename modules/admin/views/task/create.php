<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <? if (empty($company_id)): ?>
        <?= $this->render('_form', [
            'model' => $model,
            'companies' => $companies,
        ]); ?>
    <? else: ?>
        <?= $this->render('_form', [
            'model' => $model,
            'company_id' => $company_id,
        ]); ?>
    <? endif; ?>

</div>
