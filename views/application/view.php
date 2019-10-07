<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Application */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'patronymic',
            'rank',
            'email:email',
            'phone_number',
            'google_scholar_url',
            'research_gate_url',
            'academia_url',
            [
                    'attribute' => 'type_of_application',
                    'label' => 'Тип приложение',
                    'value' => function($model){
                        $type_of_app = '';
                        switch ($model->type_of_application){
                            case 1 :
                                $type_of_app = 'Статья';
                                break;
                            case 2:
                                $type_of_app = 'Книга';
                                break;
                            case 3:
                                $type_of_app = 'Интервью';
                                break;
                            case 4:
                                $type_of_app = 'Патент';
                                break;
                            case 5:
                                $type_of_app = 'Обьекты авторских прав';
                                break;
                            default:
                                $type_of_app = 'Не был выбран';
                                break;
                        }
                        return $type_of_app;
                    },

            ],
            'application_edition',
            [
                    'attribute' => 'number_of_page',
                    'label' => 'Количество страниц',
                    'value' => function($model){

                        $result = $model->pages ?  sprintf('%s  Интервал страницы (%s)' , $model->number_of_page , $model->pages ) : $model->number_of_page;
                        return $result;

                    }
            ],
            'ISSN',
            'ISBN',
             [
                     'attribute' => 'is_agree',
                    'label' => 'Подтвердил отправку данных' ,
                    'value' => function($model){
                        return $YesOrNo = $model->is_agree ? 'Да' : 'Нет';
                    }


             ],
            [
                    'attribute' => 'number_of_author',
                    'label' => 'Авторы',
                    'format' => 'raw',
                    'value' => function($model){
                       $result = '';
                       foreach($model->author as $author){
                            $result .= $author->full_name .'<br>' ;
                       }
                       return ($result);
                    },

            ],
//            [
//                    'attribute' => '$image_pub_f',
//                    'label' => 'Сертификат',
//                    'format' => 'raw',
//                    'value' => function($model){
//                        foreach($model->image as $image){
//                           return  Html::img(Yii::getAlias('@app/web/uploads/application_files') . DIRECTORY_SEPARATOR .'CER_F15691681145d879af2c16814.62208946.png' ,['width'=>'50' , 'height'=>'50']);
//                        }
//                        return  . $model->image->
//                    }
//            ],

            'DOI_link',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
