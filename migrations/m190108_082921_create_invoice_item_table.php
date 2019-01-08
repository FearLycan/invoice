<?php

use yii\db\Migration;

/**
 * Handles the creation of table `invoice_item`.
 */
class m190108_082921_create_invoice_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoice_item}}', [
            'invoice_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%invoice_item_pk}}', '{{%invoice_item}}', ['invoice_id', 'item_id']);

        $this->addForeignKey('{{%invoice_id_fk}}', '{{%invoice_item}}', 'invoice_id', '{{%invoice}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%item_id_fk}}', '{{%invoice_item}}', 'item_id', '{{%item}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('invoice_item');
    }
}
