<?php

use yii\db\Migration;

/**
 * Class m191008_170444_add_columns_for_price_determination_to_table_applcation
 */
class m191008_170444_add_columns_for_price_determination_to_table_applcation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = $this->db->getTableSchema('application')->columns;
        if(!isset($columns['impact_factor'])){
            $this->addColumn('application' , 'impact_factor' , $this->string());
        }
        if(!isset($columns['thomson_reuters'])){
            $this->addColumn('application' , 'thomson_reuters' , $this->string());
        }
        if(!isset($columns['skopus'])){
            $this->addColumn('application' , 'skopus' , $this->string());
        }
        if(!isset($columns['english_france'])){
            $this->addColumn('application' , 'english_france' , $this->string());
        }
        if(!isset($columns['RKBGM'])){
            $this->addColumn('application' , 'RKBGM' , $this->string());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191008_170444_add_columns_for_price_determination_to_table_applcation cannot be reverted.\n";

        return false;
    }
}
