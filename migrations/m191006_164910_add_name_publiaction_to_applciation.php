<?php

use yii\db\Migration;

/**
 * Class m191006_164910_add_name_publiaction_to_applciation
 */
class m191006_164910_add_name_publiaction_to_applciation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('application')->columns;
        if(!isset($columns['publication_name'])){
            $this->addColumn('application' , 'publication_name' , $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191006_164910_add_name_publiaction_to_applciation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191006_164910_add_name_publiaction_to_applciation cannot be reverted.\n";

        return false;
    }
    */
}
