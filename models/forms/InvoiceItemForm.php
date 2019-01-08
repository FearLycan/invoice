<?php

namespace app\models\forms;


use app\models\Invoice;
use app\models\InvoiceItem;
use app\models\Item;
use yii\helpers\ArrayHelper;

class InvoiceItemForm extends InvoiceItem
{
    public $items;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->items = ArrayHelper::map(Item::find()->all(), 'id', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice_id', 'item_id'], 'required'],
            [['invoice_id', 'item_id', 'qty'], 'integer'],
            [['invoice_id', 'item_id'], 'unique', 'targetAttribute' => ['invoice_id', 'item_id']],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }
}