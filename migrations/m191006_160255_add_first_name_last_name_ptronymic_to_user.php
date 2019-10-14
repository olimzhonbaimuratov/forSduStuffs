<?php

use yii\db\Migration;

/**
 * Class m191006_160255_add_first_name_last_name_ptronymic_to_user
 */
class m191006_160255_add_first_name_last_name_ptronymic_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = $this->db->getTableSchema('user')->columns;
        if(!isset($columns['last_name'])){
            $this->addColumn('user' , 'last_name' , $this->string());
        }
        if(!isset($columns['first_name'])){
            $this->addColumn('user' , 'first_name' , $this->string());
        }
        if(!isset($columns['patronymic']) && !isset($columns['last_name'])){
            $this->addColumn('user' , 'patronymic' ,  $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191006_160255_add_first_name_last_name_ptronymic_to_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191006_160255_add_first_name_last_name_ptronymic_to_user cannot be reverted.\n";

        return false;
    }
    */
}
