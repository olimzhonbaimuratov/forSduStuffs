<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $rank
 * @property string $email
 * @property int $phone_number
 * @property string $link_for_application
 * @property string $type_of_application
 * @property string $application_edition
 * @property string $ISSN
 * @property string $ISBN
 * @property int $from_sdu
 * @property int $first_auhtor
 * @property int $number_of_author
 * @property int $is_agree
 * @property string $DOI_link
 * @property int $created_at
 * @property int $updated_at
 */
class Application extends \yii\db\ActiveRecord
{
    public $type;
    public $department;
    public $google_scholar_Url;
    public $research_gate_Url;
    public $academia_Url;
    public $number;
    public $all_page;
    public $authors;
    public $image;
    public $image_type;
    public $image_com_f;
    public $image_cer_f;
    public $image_pub_f;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                // 'value' => new Expression('NOW()'),
            ],
        ];

    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [[  'ISSN', 'ISBN', 'from_sdu', 'first_auhtor', 'number_of_author'], 'required'],
//            ['type_of_application' , 'required' ,'message'=>'Необходимо выбрать тип приложения.'],
//            ['application_edition' , 'required' ,'message'=>'Необходимо заполнить имя приложения.'],
//            [['phone_number', 'from_sdu', 'first_auhtor', 'number_of_author', 'is_agree', 'created_at', 'updated_at'], 'integer'],
//            [['name', 'surname', 'patronymic', 'rank', 'email', 'link_for_application', 'type_of_application', 'application_edition', 'ISSN', 'ISBN', 'DOI_link'], 'string', 'max' => 255],
        [['publication_name', 'application_image'] , 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'rank' => 'Статус',
            'email' => 'Почтовый адрес',
            'phone_number' => 'Номер телефона',
            'link_for_application' => 'Напишите свои собственные ссылки по ResearchGate.net/Google Scholar/Academai.edu (обязательно)',
            'type_of_application' => '',
            'application_edition' => 'Серия приложения',
            'ISSN' => 'ISSN',
            'ISBN' => 'ISBN',
            'from_sdu' => 'Из СДУ ?',
            'first_auhtor' => '',
            'number_of_author' => 'Количество авторов.',
            'is_agree' => 'Я подтверждаю отправку данных',
            'DOI_link' => 'Ссылка DOI',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => '',
            'authors' => 'hello',
        ];
    }

    public function getAuthor(){
        return $this->hasMany(Author::className() , ['application_id' => 'id']);
    }
    public function getImage(){
        return $this->hasMany(ApplicationImage::className() , ['application_id' => 'id']);
    }
    public function getUser(){
        return $this->hasOne(User::className() , ['id' => 'user_id']);
    }
    public static function getImages($id){
//        return Application::find()->innerJoin('application_image' , 'application_image.application_id = application.id')->where(['application_image.application_id' => $id])->groupBy('application.id')->count();
        return (new \yii\db\Query())
            ->select('application_image.image_url AS imageUrl ')
            ->from('application')
            ->innerJoin('application_image' , 'application.id = application_image.application_id')
            ->where('application_image.application_id  = 123')
            ->all();
    }

}
