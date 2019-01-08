<?php

use yii\db\Migration;

/**
 * Handles the creation of table `client`.
 */
class m190108_080914_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'company_name' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
            'street' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'house_number' => $this->string()->notNull(),
            'zip_code' => $this->string()->notNull(),
            'nip' => $this->integer(10)->notNull()->unique(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%client_company_name_index}}', '{{%client}}', 'company_name');

        $this->createIndex('{{%client_created_at_index}}', '{{%client}}', 'created_at');
        $this->createIndex('{{%client_updated_at_index}}', '{{%client}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client}}');
    }
}
