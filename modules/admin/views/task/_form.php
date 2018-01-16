<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateExec')->input("datetime")->widget(
        "kartik\datetime\DateTimePicker",
        [
            'name' => 'appReciveDate',
            'options' => ['placeholder' => 'Select recive date ...'],
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd HH:mm',
                'todayHighlight' => true,
                'autoclose' => true,
            ]
        ]
    ) ?>
    <? if (empty($company_id)): ?>
        <?= $form->field($model, 'company_id')->dropDownList(
            $companies,
            [
                'prompt' => 'Select company...',
                'class' => 'select2-single',
//                'name' => 'company_id',
//                'id' => 'company_id'
            ]
        )->label('Company') ?>
    <? else: ?>
        <div style="display: none">
            <?= $form->field($model, 'company_id')->hiddenInput(['value' => $company_id]) ?>
        </div>
    <? endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
