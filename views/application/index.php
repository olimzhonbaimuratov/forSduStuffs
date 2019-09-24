<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->can('stuff') || Yii::$app->user->can('admin')): ?>
            <?= Html::a('Создать приложения', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif;?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',

            [
                    'label' => 'ФИО',
                    'format' => 'raw',
                    'value' => function($model){
                        return Html::tag('a' , $model->name . '(' .$model->rank. ')');
                    }

            ],
            [
                    'label' => 'Контаткты',
                    'format' => 'raw',
                    'value' => function($model){
                        return Html::tag('a' ,"Почта: " . $model->email . '<br>' . "Тел: " . $model->phone_number );}
                        ],

            'rank',

            //'link_for_application',
            //'type_of_application',
            //'application_edition',
            //'ISSN',
            //'ISBN',
            //'from_sdu',
            //'first_auhtor',
            //'number_of_author',
            //'is_agree',
            //'DOI_link',
            //'created_at',
            //'updated_at',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=> '{view} {delete} {update}',
            ],
        ],
    ]); ?>


</div>
