<?php

namespace app\models\forms;

use app\models\Client;
use app\models\Invoice;
use yii\helpers\ArrayHelper;

class InvoiceForm extends Invoice
{
    public $clients;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->clients = ArrayHelper::map(Client::find()->all(), 'id', 'company_name');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_id', 'buyer_id', 'sale_date'], 'required'],
            [['seller_id', 'buyer_id'], 'integer'],
            [['number', 'sale_date'], 'string', 'max' => 255],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['buyer_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['seller_id' => 'id']],
            [['seller_id'], 'checkClients'],
        ];
    }

    public function checkClients($attribute)
    {
        if ($this->seller_id == $this->buyer_id) {
            $this->addError($attribute, 'Seller and Buyer can\'t be the same client');
        }
    }
}