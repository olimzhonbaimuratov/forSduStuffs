<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%application}}`
 */
class m190921_182312_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->null(),
            'application_id' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()
        ]);

        // creates index for column `application_id`
        $this->createIndex(
            '{{%idx-author-application_id}}',
            '{{%author}}',
            'application_id'
        );

        // add foreign key for table `{{%application}}`
        $this->addForeignKey(
            '{{%fk-author-application_id}}',
            '{{%author}}',
            'application_id',
            '{{%application}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%application}}`
        $this->dropForeignKey(
            '{{%fk-author-application_id}}',
            '{{%author}}'
        );

        // drops index for column `application_id`
        $this->dropIndex(
            '{{%idx-author-application_id}}',
            '{{%author}}'
        );

        $this->dropTable('{{%author}}');
    }
}
