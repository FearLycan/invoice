<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%invoice}}".
 *
 * @property int $id
 * @property string $number
 * @property int $seller_id
 * @property int $buyer_id
 * @property string $sale_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Client $buyer
 * @property Client $seller
 * @property InvoiceItem[] $invoiceItems
 * @property Item[] $items
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%invoice}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'seller_id', 'buyer_id', 'sale_date'], 'required'],
            [['seller_id', 'buyer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['number', 'sale_date'], 'string', 'max' => 255],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['buyer_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'seller_id' => 'Seller',
            'buyer_id' => 'Buyer',
            'sale_date' => 'Sale Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyer()
    {
        return $this->hasOne(Client::className(), ['id' => 'buyer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Client::className(), ['id' => 'seller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItems()
    {
        return $this->hasMany(InvoiceItem::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->viaTable('{{%invoice_item}}', ['invoice_id' => 'id']);
    }

    public function beforeSave($insert)
    {

        $this->number = strtoupper(Yii::$app->security->generateRandomString(10));

        return parent::beforeSave($insert);

    }

    public function getFullQty()
    {
        return InvoiceItem::find()
            ->where(['invoice_id' => $this->id])
            ->sum('qty');
    }

    public function getFinalPrice()
    {
        $price = 0;

        foreach ($this->invoiceItems as $data) {
            $price += $data->item->brutto * $data->qty;
        }

        return number_format($price, 2, '.', '');
    }
}
