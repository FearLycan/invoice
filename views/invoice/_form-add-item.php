<?php

?>

<div class="invoice-add-item-form">
    <div class="row">
        <?php use kartik\select2\Select2;
        use yii\helpers\Html;
        use yii\widgets\ActiveForm;
        use yii\widgets\Pjax;

        Pjax::begin() ?>
        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-8">
            <?= $form->field($model, 'item_id')->widget(Select2::classname(), [
                'data' => $model->items,
                'options' => ['placeholder' => 'Item'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-5"></div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end() ?>
    </div>
</div>
