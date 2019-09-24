<?php

use yii\db\Migration;

/**
 * Class m190921_084751_add_column_publihing_house
 */
class m190921_084751_add_column_publihing_house extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('application', true)->columns;

        if (!isset($columns['publishing_house']) ) {
            $this->addColumn('application', 'publishing_house', $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190921_084751_add_column_publihing_house cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190921_084751_add_column_publihing_house cannot be reverted.\n";

        return false;
    }
    */
}
