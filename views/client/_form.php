<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">
    <div class="row">

        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-6">
            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12"></div>

        <div class="col-md-4">
            <?= $form->field($model, 'nip')->textInput() ?>
        </div>

        <div class="col-md-12"></div>


        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12"></div>

        <div class="col-md-3">
            <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'house_number')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
