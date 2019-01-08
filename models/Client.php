<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%client}}".
 *
 * @property int $id
 * @property string $company_name
 * @property string $name
 * @property string $lastname
 * @property string $street
 * @property string $city
 * @property string $house_number
 * @property string $zip_code
 * @property int $nip
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Invoice[] $invoices
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%client}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'name', 'lastname', 'street', 'city', 'house_number', 'zip_code', 'nip'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['company_name', 'name', 'lastname', 'street', 'city', 'house_number', 'zip_code'], 'string', 'max' => 255],
            [['nip'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'street' => 'Street',
            'city' => 'City',
            'house_number' => 'House Number',
            'zip_code' => 'Zip Code',
            'nip' => 'NIP',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['buyer_id' => 'id']);
    }

}
