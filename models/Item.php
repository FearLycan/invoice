<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property int $id
 * @property string $name
 * @property int $vat
 * @property string $netto
 * @property string $brutto
 * @property string $created_at
 * @property string $updated_at
 *
 * @property InvoiceItem[] $invoiceItems
 * @property Invoice[] $invoices
 */
class Item extends \yii\db\ActiveRecord
{
    const VAT_23 = 23;
    const VAT_8 = 8;
    const VAT_5 = 5;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'vat', 'netto', 'brutto'], 'required'],
            [['vat'], 'integer'],
            [['netto', 'brutto'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'vat' => 'Vat',
            'netto' => 'Netto Price',
            'brutto' => 'Brutto Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItems()
    {
        return $this->hasMany(InvoiceItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['id' => 'invoice_id'])->viaTable('{{%invoice_item}}', ['item_id' => 'id']);
    }

    /**
     * @return string[]
     */
    public static function getVatsNames()
    {
        return [
            self::VAT_5 => '5%',
            self::VAT_8 => '8%',
            self::VAT_23 => '23%'
        ];
    }

    /**
     * @return string
     */
    public function getVatName()
    {
        return self::getVatsNames()[$this->vat];
    }

    public static function getVats()
    {
        return [
            self::VAT_5,
            self::VAT_8,
            self::VAT_23
        ];
    }

    public function calculateNetto()
    {
        return $this->brutto - (($this->brutto * $this->vat) / (100 + $this->vat));
    }

    public function beforeSave($insert)
    {

        $this->netto = $this->calculateNetto();

        return parent::beforeSave($insert);

    }
}
