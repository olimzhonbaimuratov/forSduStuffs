<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список всех пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пользователей', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'username',
                'label' => 'Пользователь',
            ],
            [
                'attribute' => 'FIO',
                'label' => 'ФИО',
                'value' => function ($model) {
                    $fio = sprintf('%s %s %s', $model->first_name, $model->last_name, $model->patronymic);
                    return $fio;
                }
            ],
            [
                'attribute' => 'rank',
                'label' => 'Департамент (учреждение)',
            ],
            [
                'attribute' => 'responsibility',
                'label' => 'Должность'
            ],
            [
                    'attribute' => 'status',
                    'label' => 'Статус',
                    'value' => function($model){
                        return $model->status == 10 ? '<div class="text text-success">Активен</div>' : '<div class="text text-danger">Не активен</div>';
                    },
                    'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
