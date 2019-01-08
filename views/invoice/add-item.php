<?php
use yii\helpers\Html;

$this->title = 'Add item to ' . $invoice->number;

$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $invoice->number, 'url' => ['view', 'id' => $invoice->id]];
$this->params['breadcrumbs'][] = 'Add item';
?>

<div class="invoice-add-item">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-add-item', [
        'model' => $model,
    ]) ?>

</div>
