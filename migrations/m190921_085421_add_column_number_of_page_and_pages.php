<?php

use yii\db\Migration;

/**
 * Class m190921_085421_add_column_number_of_page_and_pages
 */
class m190921_085421_add_column_number_of_page_and_pages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('application' , 'true')->columns;
        if(!isset($columns['number_of_page'])){
            $this->addColumn('application' , 'number_of_page',$this->string());
            $this->addColumn('application' , 'pages', $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190921_085421_add_column_number_of_page_and_pages cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190921_085421_add_column_number_of_page_and_pages cannot be reverted.\n";

        return false;
    }
    */
}
