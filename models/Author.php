<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $full_name
 * @property int $application_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Application $application
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

//    public function behaviors()
//    {
//        return [
//            'class' => TimestampBehavior::className(),
//            'attributes' => [
//                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at' ,'updated_at'],
//                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//            ],
//        ];
//    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name'], 'string', 'max' => 255],
//            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'application_id' => 'Application ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['id' => 'application_id']);
    }
}
