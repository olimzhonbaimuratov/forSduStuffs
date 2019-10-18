<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_image".
 *
 * @property int $id
 * @property int $application_id
 * @property string $image_url
 *
 * @property Application $application
 */
class ApplicationImage extends \yii\db\ActiveRecord
{


    public $image_type;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application_image';

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application_id'], 'integer'],
            [['image_url'], 'string', 'max' => 255],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',

            'image_url' => 'Image Url',
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
