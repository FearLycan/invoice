<?php

namespace app\models\forms;

use app\models\Client;

class ClientForm extends Client
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'name', 'lastname', 'street', 'city', 'house_number', 'zip_code', 'nip'], 'required'],
            [['company_name', 'name', 'lastname', 'street', 'city'], 'string', 'max' => 255],
            [['zip_code'], 'string', 'max' => 6],
            [['house_number'], 'string', 'max' => 5],
            [['nip'], 'unique'],
        ];
    }
}