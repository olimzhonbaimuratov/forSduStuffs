<?php

use app\models\Application;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Просмотр приложение';
$this->params['breadcrumbs'][] = $this->title;

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="application-index">


    <p>
        <div class="card">
            <div class="card-body">
                <label for="">Статус</label>
                <?php if ($model->status === null): ?>
                    <div class="alert alert-info">В ожидание</div>
                <?php elseif ($model->status == 1): ?>
                    <div class="alert alert-success">Подтвержден</div>
                <?php elseif ($model->status == 0): ?>
                    <div class="alert alert-danger">Отказано</div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-sm-6">
                        <table id="customers">
                            <tr>
                                <td style="font-weight: bold;">Имя</td>
                                <td><?= $model->user ? $model->user->first_name :null ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Фамилия</td>
                                <td><?=  $model->user ? $model->user->last_name :null  ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Отчество</td>
                                <td><?= $model->user ? $model->user->patronymic : null; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Имя публикаций</td>
                                <td><?= $model->publication_name ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Авторы</td>
                                <td>
                                    <?php $work = User::findOne(['id' => $model->user_id]); ?>
                                    <?= '1) ' . '<span style="color:red">' . (isset($work) ? $work->first_name: null ) . ' ' . \app\models\User::findOne(['id' => $model->user_id])->last_name . '</span>' . '<br>' ?>
                                    <?php $counter = 2; ?>
                                    <?php foreach ($model->author as $author): ?>
                                        <?= $counter . ') ' . $author->full_name . '<br>' ?>
                                        <?php $counter++; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Издательство</td>
                                <td><?= $model->publishing_house ?></td>
                            </tr>
                        </table>
                        <div class="card">
                            <div class="card-body text-center">
                                <div style="font-size: 2rem;">
    <p style="display: inline-block">Сумма к оплате:</p> <h4
            style="display: inline-block; font-size:3rem; font-weight: bold"><span><?= $total_sum ?></span>
        тг</h4>
</div>
<div class="btn-group">
    <?php if (!Yii::$app->user->can('admin')): ?>
        <div id="confirm" class=" btn btn-success">Подтверждаю</div>
        <div id="reject" class="status-button btn btn-danger">Отказать</div>
    <?php endif; ?>
</div>
<div class="form-group text-left" style="font-size: 2rem;">
    <label for="exampleFormControlTextarea1">Причина отказа</label>
    <textarea class="form-control" id="exampleFormControlTextarea1"
              rows="3"><?= $model->reason_of_rejected ?></textarea>
</div>
</div>
</div>
</div>
<input type="hidden" id="app_id" value="<?= $model->id ?>">

<div class="col-sm-6">
    <div class="card" style="height: auto; padding: 0px  20px;">
        <div class="card-body text-center bg-success" style="height: 400px;">
            <div id="here-for-images" class="">

            </div>
            <iframe id="iframe" src="" width="100%" height="100%" align="left" class="hidden">
                Ваш браузер не поддерживает плавающие фреймы!
            </iframe>

            <div id="image-show" class="row" style="padding: 2rem;">
                <div class="row-no-gutters">

                </div>
            </div>

        </div>
        <div class="btn-group " style="margin-top: 20px;">
            <div class="btn-group btn-first-group">
                <button id="article" value="article" class="btn btn-primary">Статья</button>
                <button id="certificate" value="certificate" class="btn btn-primary">Сертификат</button>
                <button id="complete_intelligence" value="complete_intelligence" class="btn btn-primary">Доп свединие
                </button>
            </div>
            <div class="btn-group btn-second-group">
                <button id="google_scholar_url" value="google_scholar_url" class="btn btn-default">Google Scholar Url
                </button>
                <button id="academia_url" value="academia_url" class="btn btn-default">Academia Url</button>
                <button id="research_gate_url" value="research_gate_url" class="btn btn-default">ResearchGate Url
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

</div>

<style>
    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
<script src="/assets/6f0d5075/jquery.js"></script>
<script>
    $('#confirm').bind('click', function () {
        $.ajax({
            url: <?= "'" . yii\helpers\Url::to(["/application/form-status/", "id" => $model->id]) . "'" ?> ,
            type: 'post',
            data: {data: 1},
        });
    });
    $('#reject').bind('click', function () {
        var reason = $('#exampleFormControlTextarea1').val();
        $.ajax({
            url: <?= "'" . yii\helpers\Url::to(["/application/form-status/", "id" => $model->id]) . "'" ?> ,
            type: 'post',
            data: {data: 0, reason: reason},

        });
    });

    $('.btn-second-group button').bind('click', function () {
        var urlType = $(this).val();
        $.ajax({
            url: <?= "'" . yii\helpers\Url::to(["/application/get-url/", "id" => $model->id]) . "'" ?>,
            type: 'post',
            data: {data: urlType},
            success: function (data) {
                $('#iframe').removeClass('hidden');
                $('#image-show').addClass('hidden');
                $('#iframe').attr('src', data);
            }
        });
    });
    $('.btn-first-group button').bind('click', function () {
        var urlType = $(this).val();
        $('#image-show .card').remove();
        $.ajax({
            url: <?= "'" . yii\helpers\Url::to(["/application/get-url-img/", "id" => $model->id]) . "'"?>,
            type: 'post',
            data: {data: urlType},
            success: function (data) {
                var data = JSON.parse(data);
                $('#iframe').addClass('hidden');
                $('#image-show').removeClass('hidden');
                for (var i = 0; i < data.length; i++) {
                    $('#image-show .row-no-gutters').append(' <div class="card col-sm-3 shadow" style="border: 1px solid grey; padding: 1rem;">\n' +
                        '                        <div class="card-header">\n' +
                        '\n' +
                        '                        </div>\n' +
                        '                        <div class="card-body">\n' +
                        '                            <img  src="/images/application_files/' + data[i] + '" width="100"\n' +
                        '                                 height="100">\n' +
                        '                        </div>\n' +
                        '                        <div class="card-footer" style="padding: 1rem 0 0 0;">\n' +
                        '                            <span><a href="" download="/images/application_files/' + data[i] + '">Скачать</a></span>\n' +
                        '                            <span><a href="/images/application_files/' + data[i] + '" target="_blank">Посмотреть</a> </span>\n' +
                        '                        </div>\n' +
                        '                    </div>');
                }

            }
        });
    });
</script>