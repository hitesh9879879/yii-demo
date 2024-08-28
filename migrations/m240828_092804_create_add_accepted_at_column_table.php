<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%add_accepted_at_column}}`.
 */
class m240828_092804_create_add_accepted_at_column_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'accepted_at', $this->timestamp()->null());
        $this->addColumn('users', 'accepted_token', $this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'accepted_at');
        $this->dropColumn('users', 'accepted_token');
    }
}
