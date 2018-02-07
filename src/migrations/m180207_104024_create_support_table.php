<?php

use yii\db\Migration;

/**
 * Handles the creation of table `support`.
 */
class m180207_104024_create_support_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%support_request}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull(),
            'answered' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'sending_at' => $this->integer()->defaultValue(0),
            'filename' => $this->string(),
            'title' => $this->string(),
            'message' => $this->text(),
            'user_id' => $this->integer(),
            'email' => $this->string(255),
            'fio' => $this->string(255),
        ], $tableOptions);

        $this->createTable('{{%support_category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'icon' => $this->string(255),
            'status' => $this->smallInteger()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-support_request-category_id}}', '{{%support_request}}', ['answered', 'category_id']);

        $this->createIndex('{{%idx-support_request-parent_id}}', '{{%support_request}}', ['created_at', 'parent_id']);

        $this->addForeignKey('{{%fk-support_request-support_category}}', '{{%support_request}}', 'category_id', '{{%support_category}}', 'id', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%support_request}}');
        $this->dropTable('{{%support_category}}');
    }
}
