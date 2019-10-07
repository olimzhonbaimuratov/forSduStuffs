<?php

use yii\db\Migration;

/**
 * Class m190921_083307_add_columns_google_scholar_url_and_research_gate_url_and_academia_url
 */
class m190921_083307_add_columns_google_scholar_url_and_research_gate_url_and_academia_url extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('application', true)->columns;

        if (!isset($columns['google_scholar_url']) || !isset($columns['research_gate_url']) || !isset($columns['academia_url']) ) {
            $this->addColumn('application', 'google_scholar_url', $this->string());
            $this->addColumn('application', 'research_gate_url', $this->string());
            $this->addColumn('application', 'academia_url', $this->string());
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190921_083307_add_columns_google_scholar_url_and_research_gate_url_and_academia_url cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190921_083307_add_columns_google_scholar_url_and_research_gate_url_and_academia_url cannot be reverted.\n";

        return false;
    }
    */
}
