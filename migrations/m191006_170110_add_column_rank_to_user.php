<?php

use yii\db\Migration;

/**
 * Class m191006_170110_add_column_rank_to_user
 */
class m191006_170110_add_column_rank_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('user')->columns;
        if(!isset($columns['rank'])){
            $this->addColumn('user' , 'rank' , $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191006_170110_add_column_rank_to_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191006_170110_add_column_rank_to_user cannot be reverted.\n";

        return false;
    }
    */
}
