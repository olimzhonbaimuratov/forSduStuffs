<?php

use yii\db\Migration;

/**
 * Class m191007_174438_add_column_status_to_table_application
 */
class m191007_174438_add_column_status_to_table_application extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = $this->db->getTableSchema('application' , false)->columns;
        if(!isset($columns['status'])){
            $this->addColumn('application' , 'status' , $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191007_174438_add_column_status_to_table_application cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191007_174438_add_column_status_to_table_application cannot be reverted.\n";

        return false;
    }
    */
}
