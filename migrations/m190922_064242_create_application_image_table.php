<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%application_image}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%application}}`
 */
class m190922_064242_create_application_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%application_image}}', [
            'id' => $this->primaryKey(),
            'application_id' => $this->integer(),
            'image_url' => $this->string()->Null(),
        ]);

        // creates index for column `application_id`
        $this->createIndex(
            '{{%idx-application_image-application_id}}',
            '{{%application_image}}',
            'application_id'
        );

        // add foreign key for table `{{%application}}`
        $this->addForeignKey(
            '{{%fk-application_image-application_id}}',
            '{{%application_image}}',
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
            '{{%fk-application_image-application_id}}',
            '{{%application_image}}'
        );

        // drops index for column `application_id`
        $this->dropIndex(
            '{{%idx-application_image-application_id}}',
            '{{%application_image}}'
        );

        $this->dropTable('{{%application_image}}');
    }
}
