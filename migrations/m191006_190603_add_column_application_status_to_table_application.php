<?php

use yii\db\Migration;

/**
 * Class m191006_190603_add_column_application_status_to_table_application
 */
class m191006_190603_add_column_application_status_to_table_application extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = $this->db->getTableSchema('application' )->columns;
        if(!isset($columns['application_id'])){
            $this->addColumn('application' , 'application_id' , $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191006_190603_add_column_application_status_to_table_application cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191006_190603_add_column_application_status_to_table_application cannot be reverted.\n";

        return false;
    }
    */
}
