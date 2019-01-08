<?php

use yii\db\Migration;

/**
 * Handles adding qty to table `invoice_item`.
 */
class m190108_115436_add_qty_column_to_invoice_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%invoice_item}}', 'qty', $this->integer()->defaultValue(0));

        $this->createIndex('{{%invoice_item_qty_index}}', '{{%invoice_item}}', 'qty');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%invoice_item}}', 'qty');
    }
}
