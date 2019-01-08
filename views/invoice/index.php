<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Invoice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'number',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var \app\models\Invoice $data */
                    return Html::a($data->number, ['view', 'id' => $data->id]);
                },
            ],
            [
                'attribute' => 'seller',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var \app\models\Invoice $data */
                    return Html::a($data->seller->company_name, ['client/view', 'id' => $data->seller_id]);
                },
            ],
            [
                'attribute' => 'buyer',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var \app\models\Invoice $data */
                    return Html::a($data->buyer->company_name, ['client/view', 'id' => $data->buyer_id]);
                },
            ],
            'sale_date',
            'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 110px'],
                'template' => '{new_action1} {new_action2}',
                'buttons' => [
                    'new_action1' => function ($url, $model, $key) {
                        return Html::a(
                            'Edit',
                            ['update', 'id' => $model->id],
                            ['title' => 'Edytuj', 'class' => 'btn btn-primary btn-xs']
                        );
                    },
                    'new_action2' => function ($url, $model, $key) {
                        return Html::a(
                            'Delete',
                            ['delete', 'id' => $model->id],
                            [
                                'title' => 'Delete', 'class' => 'btn btn-danger btn-xs',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
