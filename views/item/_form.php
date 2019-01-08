<?php

use app\models\Item;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">
    <div class="row">

        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'vat')
                ->dropDownList(Item::getVatsNames()); ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'brutto')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
