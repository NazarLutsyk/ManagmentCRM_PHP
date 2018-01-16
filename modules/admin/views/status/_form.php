<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::label('Offers') ?>
        <?= Html::dropDownList(
            'offers',
            ArrayHelper::getColumn($model->getOffers()->asArray()->all(),'id'),
            $offers,
            [
                'prompt' => 'Select offers...',
                'class' => 'select2-multiple',
                'multiple' => true,
                'required' => true
//                'name' => 'offers[]',
//                'id' => 'offers',
            ]
        ); ?>
    </div>

    <div style="display: none">
        <?= $form->field($model, 'company_id')->hiddenInput(['value' => $company_id]); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
