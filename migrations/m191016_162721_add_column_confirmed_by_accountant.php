<?php

use yii\db\Migration;

/**
 * Class m191016_162721_add_column_confirmed_by_accountant
 */
class m191016_162721_add_column_confirmed_by_accountant extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = $this->db->getTableSchema('application' )->columns;
        if(isset($columns['confirmed_by_accountant'])){
            $this->addColumn('application' , 'confirmed_by_accountant' , $this->integer());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191016_162721_add_column_confirmed_by_accountant cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191016_162721_add_column_confirmed_by_accountant cannot be reverted.\n";

        return false;
    }
    */
}
