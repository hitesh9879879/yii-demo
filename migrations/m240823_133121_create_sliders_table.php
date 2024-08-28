<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sliders}}`.
 */
class m240823_133121_create_sliders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sliders}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sliders}}');
    }
}
