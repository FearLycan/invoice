<?php

namespace app\models\forms;


use app\models\Item;

class ItemForm extends Item
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'vat', 'brutto'], 'required'],
            [['vat'], 'integer'],
            [['brutto'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}