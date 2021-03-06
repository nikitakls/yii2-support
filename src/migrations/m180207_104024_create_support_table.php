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

        $this->createTable('{{%support_ticket}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull(),
            'level' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'filename' => $this->string(),
            'title' => $this->string(),
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

        $this->createTable('{{%support_content}}', [
            'id' => $this->primaryKey(),
            'ticket_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'filename' => $this->string(255),
            'type' => $this->smallInteger()->notNull(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'sending_at' => $this->integer()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('{{%idx-support_ticket-category_id}}', '{{%support_ticket}}', ['level', 'category_id']);

        $this->createIndex('{{%idx-support_ticket-parent_id}}', '{{%support_ticket}}', ['created_at', 'parent_id']);

        $this->addForeignKey('{{%fk-support_ticket-support_content}}', '{{%support_content}}', 'ticket_id', '{{%support_ticket}}', 'id', 'CASCADE');

        $this->addForeignKey('{{%fk-support_ticket-support_category}}', '{{%support_ticket}}', 'category_id', '{{%support_category}}', 'id', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%support_content}}');
        $this->dropTable('{{%support_ticket}}');
        $this->dropTable('{{%support_category}}');
    }
}
