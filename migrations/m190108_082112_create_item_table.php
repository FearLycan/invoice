<?php

use yii\db\Migration;

/**
 * Handles the creation of table `item`.
 */
class m190108_082112_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'vat' => $this->smallInteger()->notNull(),
            'netto' => $this->decimal(4, 2)->notNull(),
            'brutto' => $this->decimal(4, 2)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%item_name_index}}', '{{%item}}', 'name');

        $this->createIndex('{{%item_created_at_index}}', '{{%item}}', 'created_at');
        $this->createIndex('{{%item_updated_at_index}}', '{{%item}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}
