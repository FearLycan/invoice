<?php

use yii\db\Migration;

/**
 * Handles the creation of table `invoice`.
 */
class m190108_082113_create_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoice}}', [
            'id' => $this->primaryKey(),
            'number' => $this->string()->notNull(),
            'seller_id' => $this->integer()->notNull(),
            'buyer_id' => $this->integer()->notNull(),
            'sale_date' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%invoice_sale_date_index}}', '{{%invoice}}', 'sale_date');
        $this->createIndex('{{%invoice_number_index}}', '{{%invoice}}', 'number');

        $this->createIndex('{{%invoice_created_at_index}}', '{{%invoice}}', 'created_at');
        $this->createIndex('{{%invoice_updated_at_index}}', '{{%invoice}}', 'updated_at');

        $this->addForeignKey('{{%invoice_seller_id_fk}}', '{{%invoice}}', 'seller_id', '{{%client}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%invoice_buyer_id_fk}}', '{{%invoice}}', 'buyer_id', '{{%client}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%invoice}}');
    }
}
