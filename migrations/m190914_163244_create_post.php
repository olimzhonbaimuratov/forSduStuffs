<?php

use yii\db\Migration;

/**
 * Class m190914_163244_create_post
 */
class m190914_163244_create_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190914_163244_create_post cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

//        $this->createTable('post' , [
//            'id' => $this->primaryKey(),
//            'title' => $this->string(),
//            'description' => $this->text(),
//            'user_id' => $this->integer()
//        ]);

    }

    public function down()
    {
        echo "m190914_163244_create_post cannot be reverted.\n";

        return false;
    }
}
