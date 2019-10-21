<?php

use yii\db\Migration;

/**
 * Class m191020_180714_add_column_status_by_accountant
 */
class m191020_180714_add_column_status_by_accountant extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = $this->db->getTableSchema('application')->columns;
        if(!isset($columns['status_by_accountant'])){
            $this->addColumn('application' , 'status_by_accountant' , $this->integer());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191020_180714_add_column_status_by_accountant cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191020_180714_add_column_status_by_accountant cannot be reverted.\n";

        return false;
    }
    */
}
