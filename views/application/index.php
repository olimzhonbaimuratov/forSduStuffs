<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приложение';
$this->params['breadcrumbs'][] = $this->title;
//echo $notify;
?>
<div class="application-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--        --><?php //if (Yii::$app->user->can('stuff') || Yii::$app->user->can('admin')): ?>
        <!--            --><? //= Html::a('Создать приложения', ['create'], ['class' => 'btn btn-success']) ?>
        <!--        --><?php //endif; ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'created_at',
                'format' => 'date',
                'filter' => false,
                'label' => 'Дата подачи'
            ],
            [
                'label' => 'ФИО',
                'format' => 'raw',
                'value' => function ($model) {
                    $result = $model->user->first_name && $model->user->first_name . ' ' . $model->user->last_name . ' ' . $model->user->patronymic;
                    return Html::tag('a', $result);
                }

            ],
            [
                'label' => 'Наименование публикаций',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->publication_name;
                }

            ],
            [
                'label' => 'Издатель',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->publishing_house;
                }
            ],

            [
                'label' => 'Должность',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->user->responsibility;
                }
            ],
            [
                'label' => 'Департамент',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->user->rank;
                }
            ],
            [
                'label' => 'Файл публикация',
                'format' => 'raw',
                'value' => function ($model) {

                    $result = \app\models\Application::getImages($model->id);
                    return '<a  class="btn btn-primary">' . count($result) . '</a>';
//                        return '<img src="/uploads/application_files/PUB_F15691716875d87a8e7005fe8.17041853.png"  width="100" />';
//                        return Html::img(Yii::getAlias('@web').'/uploads/application_files/'.'CER_F15703856795d9a2f0f4d22c5.48151976.png') ;

//                    $totalResult = '';
//                    foreach ($result as $data) {
//                        echo Html::img('@web/images/application_files/'. $data['imageUrl'] , ['style'=>'width:100%;' , 'alt' => 'Avatar']);
//                        $result = '<div class="card this-card">
//                                '.Html::img('@web/images/application_files/' . $data['imageUrl']).'
//                                <div class="container this-container">
//
//                                </div>
//                                </div>';
//                            $img = Url::to('@web/uploads/application_files/').$data['imageUrl'];
//                            $image = '<img src="'.$img.'" width="600" />';
//                            echo $image;
//                            $totalResult .= Html::a($data['imageUrl'] , '@web/uploads/application_files/' . $data['imageUrl']  ) . '<br>';
//                            echo $data['imageUrl'];
//                            $totalResult .= $data['imageUrl'] . '<br>';

//                    }
//                    return $result;

//                    $totalResult .= Html::a($data['imageUrl'] , '@web/uploads/application_files/' . $data['imageUrl']  );
//                    return  Html::img('@web/images/application_files/PUB_F15704689215d9b7439a99ed9.50070984.jpg' , ['style'=>'width:100%;' , 'alt' => 'Avatar']);
//                    return $totalResult;
                }
            ],


            [
                'label' => 'Статус приложение',
                'format' => 'raw',
                'value' => function ($model) {
                    $totalHtml = '';
                    $totalHtml .= '<table>';
                    if ($model->status === null) {
                        $totalHtml .= '<tr>';
                        $totalHtml .= '<td>Подтверждено департаментом наук:</td>';
                        $totalHtml .= '<td><div class="btn btn-primary ">В ожидание</div></td>';
                        $totalHtml .= '</tr>';
                    }
                    if ($model->status_by_accountant === null) {
                        $totalHtml .= '<tr>';
                        $totalHtml .= '<td>Подтверждено бухгалтерией:</td>';
                        $totalHtml .= '<td><div class="btn btn-primary ">В ожидание</div></td>';
                        $totalHtml .= '</tr>';
                    } else {
                        $totalHtml .= '<tr>';
                        $totalHtml .= '<td>Подтверждено департаментом наук:</td>';
                        $totalHtml .= $model->status == '1' ? '<td><div class="btn btn-success ">Подтвержден</div></td>' : '<td><div class="btn btn-danger ">Отказано</div></td>';
                        $totalHtml .= '</tr>';
                        $totalHtml .= '<tr>';
                        $totalHtml .= '<td>Подтверждено бухгалтерией:</td>';
                        $totalHtml .= $model->status_by_accountant == '1' ? '<td><div class="btn btn-success ">Подтвержден</div></td>' : '<td><div class="btn btn-danger ">Отказано</div></td>';
                        $totalHtml .= '</tr>';

                    }

                    $totalHtml .= '</table>';
                    return $totalHtml;


                },

            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton} {delete} {update}',
                'buttons' => [
                    'myButton' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::toRoute(['/application/show-application/', 'id' => $model->id]));
                    }
                ],
            ],
        ],
    ]); ?>


</div>

<?php
$css = <<<CSS
    .this-card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
}

.this-card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.this-container {
  padding: 2px 16px;
}
table{
    border: 1px solid black;
}
table tr{
  border: 1px solid black;
  padding: 1rem;
}
table tr td{
border: 1px solid black;
padding: 1rem;
}
#w0{
overflow-x: auto;
}
CSS;

$this->registerCss($css);


?>
