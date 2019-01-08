<?php

namespace app\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Invoice;

/**
 * InvoiceSearch represents the model behind the search form of `app\models\Invoice`.
 */
class InvoiceSearch extends Invoice
{
    public $seller;
    public $buyer;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'sale_date', 'created_at', 'seller', 'buyer'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Invoice::find()
            ->joinWith('seller seller')
            ->joinWith('buyer buyer');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['seller'] = [
            'asc' => ['seller.company_name' => SORT_ASC],
            'desc' => ['seller.company_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['buyer'] = [
            'asc' => ['buyer.company_name' => SORT_ASC],
            'desc' => ['buyer.company_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'invoice.number', $this->number])
            ->andFilterWhere(['like', 'seller.company_name', $this->seller])
            ->andFilterWhere(['like', 'buyer.company_name', $this->buyer])
            ->andFilterWhere(['like', 'invoice.sale_date', $this->sale_date]);

        return $dataProvider;
    }
}
