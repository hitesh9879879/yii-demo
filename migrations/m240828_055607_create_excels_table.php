<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%excels}}`.
 */
class m240828_055607_create_excels_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%excels}}', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%excels}}');
    }
}
