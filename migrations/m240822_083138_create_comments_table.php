<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m240822_083138_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'description' => $this->string()->notNull(),
            'like' => $this->boolean(),
        ]);

        $this->addForeignKey(
            'fk-comments-post_id', '{{%comments}}', 'post_id', '{{%posts}}', 'id', 'CASCADE'
        );
        $this->addForeignKey(
            'fk-comments-user_id', '{{%comments}}', 'user_id', '{{%users}}', 'id', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}
