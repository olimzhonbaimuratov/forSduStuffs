<?php

use yii\db\Migration;

/**
 * Class m191011_171311_remove_column_email
 */
class m191011_171311_remove_column_email extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('user')->columns;
        if(isset($columns['email'])){
            $this->dropColumn('user' , 'email');
      }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191011_171311_remove_column_email cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191011_171311_remove_column_email cannot be reverted.\n";

        return false;
    }
    */
}
