<?php

use yii\db\Migration;

/**
 * Class m191006_153624_add_column_user_id_to_tabl_application
 */
class m191006_153624_add_column_user_id_to_tabl_application extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = $this->db->getTableSchema('application')->columns;
        if(!isset($columns['user_id'])){
            $this->addColumn('application' , 'user_id' ,  $this->integer());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191006_153624_add_column_user_id_to_tabl_application cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191006_153624_add_column_user_id_to_tabl_application cannot be reverted.\n";

        return false;
    }
    */
}
