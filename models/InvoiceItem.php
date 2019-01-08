<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%invoice_item}}".
 *
 * @property int $invoice_id
 * @property int $item_id
 * @property int $qty
 *
 * @property Invoice $invoice
 * @property Item $item
 */
class InvoiceItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%invoice_item}}';
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'invoice_id' => 'Invoice ID',
            'item_id' => 'Item ID',
            'qty' => 'Qty',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    public function getFinalPrice()
    {
        return number_format($this->qty * $this->item->brutto, 2, '.', '');
    }
}
