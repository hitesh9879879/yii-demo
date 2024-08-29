<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%add_status_column}}`.
 */
class m240829_133141_create_add_status_column_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'status', $this->string()->defaultValue('1')->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'status');
    }
}
