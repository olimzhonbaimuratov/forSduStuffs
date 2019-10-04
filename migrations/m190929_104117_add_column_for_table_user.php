<?php

use yii\db\Migration;

/**
 * Class m190929_104117_add_column_for_table_user
 */
class m190929_104117_add_column_for_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('user' , true)->columns;
        if(!isset($columns['name']) || !isset($columns['second_name']) || !isset($columns['patronymic'])){
            $this->addColumn('user', 'name' , $this->string());
            $this->addColumn('user', 'second_name' , $this->string());
            $this->addColumn('user', 'patronymic' , $this->string());
            $this->addColumn('user', 'responsibility' , $this->string());
        } ;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190929_104117_add_column_for_table_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190929_104117_add_column_for_table_user cannot be reverted.\n";

        return false;
    }
    */
}
