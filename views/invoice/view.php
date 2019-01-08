<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="invoice-view">
    <div class="row">

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Add item', ['invoice/add-item', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        </p>

        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12">
            <h3 class="text-center">
                INVOICE NUMBER <strong><?= Html::encode($model->number) ?></strong>
            </h3>
        </div>
        <div class="col-md-12">
            <p class="text-right">
                Sale date <strong><?= Html::encode($model->sale_date) ?></strong>
            </p>
        </div>
        <div class="col-md-12"></div>
        <div class="col-md-6">
            <h4>
                SELLER
            </h4>
            <p>
                <?= $model->seller->company_name ?><br>
                <?= $model->seller->name . ' ' . $model->seller->lastname ?><br>
                <?= $model->seller->street . ' ' . $model->seller->house_number ?><br>
                <?= $model->seller->zip_code . ' ' . $model->seller->city ?>
            </p>
        </div>
        <div class="col-md-6">
            <h4>BUYER</h4>

            <p>
                <?= $model->buyer->company_name ?><br>
                <?= $model->buyer->name . ' ' . $model->buyer->lastname ?><br>
                <?= $model->buyer->street . ' ' . $model->buyer->house_number ?><br>
                <?= $model->buyer->zip_code . ' ' . $model->buyer->city ?>
            </p>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Item name</th>
                    <th>Item Netto</th>
                    <th>Item Brutto</th>
                    <th>VAT</th>
                    <th>QTY</th>
                    <th class="text-center">Final price</th>
                    <th style="width: 50px"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model->invoiceItems as $key => $data): ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= Html::encode($data->item->name) ?></td>
                        <td><?= Html::encode($data->item->netto) ?></td>
                        <td><?= Html::encode($data->item->brutto) ?></td>
                        <td><?= Html::encode($data->item->getVatName()) ?></td>
                        <td><?= Html::encode($data->qty) ?></td>
                        <td class="text-center"><?= $data->getFinalPrice() ?></td>
                        <td>
                            <?= Html::a('Remove', ['invoice/remove-item', 'invoice_id' => $data->invoice_id, 'item_id' => $data->item_id],
                                [
                                    'class' => 'btn btn-danger btn-xs',
                                    'data-confirm' => 'Are you sure you want to delete this item?',
                                    'data-method' => 'post',
                                    'title' => 'Remove',
                                ]) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

                <tr>
                    <th scope="row"></th>
                    <th>Final Price</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= Html::encode($model->getFullQty()) ?></td>
                    <td class="text-center"><?= Html::encode($model->getFinalPrice()) ?></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>