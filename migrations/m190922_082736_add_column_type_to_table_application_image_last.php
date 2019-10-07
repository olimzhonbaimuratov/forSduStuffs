<?php

use yii\db\Migration;

/**
 * Class m190922_082736_add_column_type_to_table_application_image_last
 */
class m190922_082736_add_column_type_to_table_application_image_last extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('application_image' , true)->columns;
        if(!isset($columns['image_type'])){
            $this->addColumn('application_image' , 'image_type' , $this->string());
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190922_082736_add_column_type_to_table_application_image_last cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190922_082736_add_column_type_to_table_application_image_last cannot be reverted.\n";

        return false;
    }
    */
}
