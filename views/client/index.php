<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'company_name',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var \app\models\Client $data */
                    return Html::a($data->company_name, ['view', 'id' => $data->id]);
                },
            ],
            'name',
            'lastname',
            'nip',

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
