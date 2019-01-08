<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-form">
    <div class="row">
        <?php Pjax::begin() ?>
        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-5">
            <?= $form->field($model, 'seller_id')->widget(Select2::classname(), [
                'data' => $model->clients,
                'options' => ['placeholder' => 'Seller'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'buyer_id')->widget(Select2::classname(), [
                'data' => $model->clients,
                'options' => ['placeholder' => 'Buyer'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'sale_date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Sale date'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]); ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end() ?>
    </div>
</div>
