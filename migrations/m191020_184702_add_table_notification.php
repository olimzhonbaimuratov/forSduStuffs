<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191020_184702_add_table_notification
 */
class m191020_184702_add_table_notification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('notification', [
                'id' => Schema::TYPE_PK,
                'notify_body' => Schema::TYPE_TEXT,
                'application_by_role' => Schema::TYPE_STRING,
                'application_id' => Schema::TYPE_INTEGER,
            ]);

        $this->createIndex(
            'idx-notification-application_id',
            'notification',
            'application_id'
        );

        $this->addForeignKey(
            'fk-notification-application_id',
            'notification',
            'application_id',
            'application',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191020_184702_add_table_notification cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191020_184702_add_table_notification cannot be reverted.\n";

        return false;
    }
    */
}
