<?php

use yii\db\Migration;

/**
 * Class m191019_165811_add_reason_of_reject
 */
class m191019_165811_add_reason_of_reject extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = $this->db->getTableSchema('application')->columns;
        if(!isset($columns['reason_of_rejected'])){
            $this->addColumn('application' , 'reason_of_rejected' , $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191019_165811_add_reason_of_reject cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191019_165811_add_reason_of_reject cannot be reverted.\n";

        return false;
    }
    */
}
