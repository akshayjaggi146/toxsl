<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m231224_081149_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1), 
            'assigned_to' => $this->integer(), 
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Add indexes on the new columns for faster queries
        $this->createIndex('idx-project-title', 'project', 'title');
        $this->createIndex('idx-project-status', 'project', 'status');
        $this->createIndex('idx-project-assigned_to', 'project', 'assigned_to');

        // Define foreign key relationship
        $this->addForeignKey(
            'fk-project-assigned_to-user-id',
            'project',
            'assigned_to',
            'user',
            'id',
            'CASCADE', // or 'SET NULL' depending on your needs
            'SET NULL'
        );
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }
}
