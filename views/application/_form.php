<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use dosamigos\fileupload\FileUploadUI;
use limion\jqueryfileupload\JQueryFileUpload;


/* @var $this yii\web\View */
/* @var $model app\models\Application */
/* @var $form yii\widgets\ActiveForm */
?>
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

<div class="application-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="container" style="height: auto;">
        <section class="just_section  row">
            <div class="col-sm-2">
                <div class="card">
                    <?= Html::img('@web/images/no-images.png', ['style' => 'width:100%;', 'alt' => 'Avatar']); ?>
                    <div class=" card-container">
                        <h4 style="font-family: 'Poppins', sans-serif;">
                            <b><?= \app\models\User::findOne(['id' => Yii::$app->user->getId()])->first_name; ?></b>
                        </h4>
                        <span style="font-weight: bold;">Фамилия</span>
                        <p style="font-family: 'Poppins', sans-serif;"><?= \app\models\User::findOne(['id' => Yii::$app->user->getId()])->last_name; ?></p>
                        <span style="font-weight: bold;">Отчество</span>
                        <p style="font-family: 'Poppins', sans-serif;"><?= \app\models\User::findOne(['id' => Yii::$app->user->getId()])->patronymic; ?></p>
                        <!--                        <span style="font-weight: bold;">Эл-почта</span><p class="this_p" style="overflow-x: auto; font-family: 'Poppins', sans-serif;">-->
                        <? //= \app\models\User::findOne(['id' => Yii::$app->user->getId()])->email;?><!--</p>-->
                        <span style="font-weight: bold;">Должность</span>
                        <p class="this_p"
                           style="overflow-x: auto; font-family: 'Poppins', sans-serif;"><?= \app\models\User::findOne(['id' => Yii::$app->user->getId()])->responsibility; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="col-sm-9 text-left">
                    <h3 style="font-weight: bold; color:deepskyblue; font-family: 'Poppins', sans-serif;">Приложения для
                        оплаты гонорара.</h3>
                    <h5 style="font-style: italic; font-family: 'Poppins', sans-serif; color:red;"
                        class="alert alert-danger">Необходимо писать только те проекты которые были подтверждены через
                        СДУ. </h5>
                </div>
                <div class="col-sm-3">
                    <div class="col-sm-12">
                        <h5 style="font-weight: bold; font-family: 'Poppins', sans-serif; font-size: 1.8rem; "
                            class="text-left">Приложения <span> &#35;<?= \app\models\Application::find()->count()+1; ?> </span></h5>
                        <label for="date" style="float:left; font-family: 'Poppins', sans-serif; color: gray; ">День
                            сдачи: </label>
                        <input class="beauty_input" name='date' type="text" disabled value="<?php
                        time();
                        echo $date = date('m/d/Y', time()); ?>">
                    </div>
                </div>
                <div class="row-no-gutters col-sm-12" style="height: auto; padding: 30px 20px;">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'rank')->textInput(['style' => 'width:90%;', 'value' => \app\models\User::findOne(['id' => Yii::$app->user->getId()])->rank])->label('Департамент. ', ['class' => 'label-class-left']) ?>
                        </div>
                        <div class="col-sm-6 text-left">
                            <?= $form->field($model, 'phone_number')->textInput(['style' => 'width:90%;'])->label('Тел. номер.', ['class' => 'label-class-left']) ?>
                        </div>
                    </div>
                    <div style="margin-top: 1rem;" class="row-no-gutters  col-sm-12">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'google_scholar_Url')->textInput(['style' => 'width:90%;'])->label('Google Scholar URL', ['class' => 'label-class-left']) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($model, 'research_gate_Url')->textInput(['style' => 'width:90%;'])->label('Research gate Url', ['class' => 'label-class-left']) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($model, 'academia_Url')->textInput(['style' => 'width:90%;'])->label('Academia URL', ['class' => 'label-class-left']) ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 row-no-gutters for-checkbox-css" style="margin-top: -2rem;">
                    <div class="col-sm-12 text-left">
                        <?= $form->field($model, 'type_of_application')->radioList(
                            [
                                '1' => 'Статья',
                                '2' => 'Книга',
                                '3' => 'Интервью',
                                '4' => 'Петент',
                                '5' => 'Обьекты авторских прав',
                            ],
                            [
                                'separator' => '&nbsp; &nbsp; &nbsp; ',
                                'itemOptions' => [
//                                    'class' => 'radionButton',
                                ],
                                'class' => 'radioButton',
                            ]
                        ) ?>
                    </div>


                </div>


                <div class="col-sm-12 ">
                    <?= $form->field($model, 'publication_name')->textInput(['rows' => 2])
                        ->label('Имя публикаций или книги.', ['class' => 'label-class-left publication'])


                    ?>
                </div>

                <div class="col-sm-12">
                    <div class="row col-sm-12" style="font-size: 1.8rem;">
                        <?=
                        $form->field($model, 'authors')->widget(MultipleInput::className(), [
                            'max' => 6,
                            'min' => 1, // should be at least 1 rows
                            'allowEmptyList' => true,
                            'enableGuessTitle' => false,
                            'addButtonPosition' => MultipleInput::POS_ROW,

                        ])
                            ->label('Авторы (за исключением себя):');
                        ?>


                    </div>
                </div>

                <div class="col-sm-12 " style="margin-top: 1.5rem;">
                    <?= $form->field($model, 'publishing_house')->textInput()->label('Издательство.', ['class' => 'label-class-left']) ?>
                </div>

                <div class="col-sm-12 row">
                    <div class="col-sm-2">
                        <?= $form->field($model, 'number')->textInput()->label('&#8470;', ['class' => 'label-class-left']) ?>
                    </div>
                    <div class="col-sm-2 ISSN">
                        <?= $form->field($model, 'ISSN')->textInput()->label('ISSN:', ['class' => 'label-class-left']) ?>
                    </div>
                    <div class="col-sm-2 ISBN hidden">
                        <?= $form->field($model, 'ISBN')->textInput()->label('ISBN:', ['class' => 'label-class-left']) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'all_page')->textInput()->label('Колво стр: ', ['class' => 'label-class-left']) ?>
                    </div>
                    <div class="col-sm-3 hide-interval">
                        <?= $form->field($model, 'pages')->textInput()->label('Интервал страниц: ', ['class' => 'label-class-left']) ?>
                    </div>
                </div>

                <div class="col-sm-12" style="margin-top: 1.5rem;font-size: 1.8rem;">
                    <?= $form->field($model, 'impact_factor_type')->dropDownList([
                        1 => '0 - 0,49',
                        2 => '0,5 - 1,49',
                        3 => '1,5 - 2,49',
                        4 => 'выше чем 2,9',
                    ])->label('Выберите импакт фактор') ?>
                </div>

                <div class="col-sm-12" style="margin-top: 1.5rem; font-size: 1.8rem;">
                    <?= $form->field($model, 'type_for_total')->checkboxList(
                        [
                            1 => 'Был опубликован в инормационной базе Томсан Рейтер',
                            2 => 'Был опубликован в базе Скопус',
                            3 => 'Был рецензирован в журналах Английского , Немецкого и Французкого языка',
                            4 => 'Был опубликован в КР БГМ',
                        ],
                        [
                            'separator' => '<br>',
                        ]
                    )->label('Статус публикаций для подчета гонорар'); ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($model, 'DOI_link')->textInput()->label('Ссылка на DOI: ', ['class' => 'label-class-left']) ?>
                </div>
                <div class="col-sm-12 text-left" style="font-size: 1.8rem;">
                    <?= $form->field($model, 'type_of_application')->radioList(
                        [
                            '1' => 'Прикрепите статью.',
                            '2' => 'Прикрепите сертификаты.',
                            '3' => 'Прикрепите дополнительные файлы.',
                        ],
                        [
                            'separator' => '&nbsp; &nbsp; &nbsp; ',
                            'itemOptions' => [
                                'class' => 'radioButton',
                            ],
                        ]
                    ) ?>
                </div>

                <div class="col-sm-12 hidden" id="fileupload" style="margin-top: 4rem;">
                    <div class="atach_file">
                        <div class="alert alert-success" style="font-size: 1.5rem;">
                            Прикрепите статью.
                        </div>
                        <div class="alert alert-success" style="font-size: 1.5rem;">
                            Прикрепите сертификаты.
                        </div>
                        <div class="alert alert-success" style="font-size: 1.5rem;">
                            Прикрепите дополнительные файлы.
                        </div>
                    </div>


                    <div class="col-sm-12 public_file">
                        <?= FileUploadUI::widget([
                            'model' => $model,
                            'attribute' => 'image_pub_f',
                            'options' => ['style' => 'margin-top:3rem;'],
                            'url' => ['application/image-upload', 'type' => 'PUB_F'],
                            'gallery' => false,
                            'fieldOptions' => [
                                'accept' => 'image/*'
                            ],
                            'clientOptions' => [
                                'maxFileSize' => 2000000,
                                'autoUpload' => true
                            ],
                            // ...
                            'clientEvents' => [
                                'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
                                'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
                            ],
                        ]); ?>
                    </div>

                    <div class="col-sm-12 certificate_test hidden">
                        <?= FileUploadUI::widget([
                            'model' => $model,
                            'attribute' => 'image_cer_f',
                            'options' => ['style' => 'margin-top:3rem;'],
                            'url' => ['application/image-upload', 'type' => 'CER_F'],
                            'gallery' => false,
                            'fieldOptions' => [
                                'accept' => 'image/*'
                            ],
                            'clientOptions' => [
                                'maxFileSize' => 2000000,
                                'autoUpload' => true
                            ],
                            // ...
                            'clientEvents' => [
                                'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
                                'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
                            ],
                        ]); ?>
                    </div>
                    <div class="col-sm-12 compl_file hidden">
                        <?= FileUploadUI::widget([
                            'model' => $model,
                            'attribute' => 'image_com_f',
                            'options' => ['style' => 'margin-top:3rem;'],
                            'url' => ['application/image-upload', 'type' => 'COM_F'],
                            'gallery' => false,
                            'fieldOptions' => [
                                'accept' => 'image/*'
                            ],
                            'clientOptions' => [
                                'maxFileSize' => 2000000,
                                'autoUpload' => true
                            ],
                            // ...
                            'clientEvents' => [
                                'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
                                'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
                            ],
                        ]); ?>
                    </div>


                </div>

                <div class="col-sm-12 row" style="margin-top: 2rem;">
                    <div class="col-sm-6" style="font-size: 1.8rem;">
                        <?= $form->field($model, 'is_agree')->checkbox(); ?>
                    </div>
                </div>
                <div class="col-sm-12" style="font-size: 1.8rem;">
                    <?= $form->field($model, 'from_sdu')->checkbox(); ?>
                </div>
            </div>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'style' => 'float:right;margin-right:2.5rem;padding:10px 20px; margin-top:4rem;']) ?>
        </section>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$css = <<<CSS
#w0{
height: auto;
}
    .just_section{
        /*background: #fc0; !* Цвет фона *!*/
        box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Параметры тени */
        height: auto;
        padding: 2rem 10px;
    }
    .just_section > div:nth-child(1){
        /*background-color: orange;*/
        height: 100%;
    }
    .just_section > div:nth-child(2){
        /*background-color: #0c5460;*/
        height: auto;
    }
    .ul-here{
        text-decoration: none;
        list-style-type: none;
    }
    
    .card {
      /*box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);*/
      /*transition: 0.3s;*/
      width: 100%;
    }
    
    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    
    .card-container {
      padding: 2px 16px;
    }
    .this_p::-webkit-scrollbar {
        display: block;
    }
    .beauty_input{
         padding: 5px 8px;
         display: inline-block;
         border: 1px solid #ccc;
         border-radius: 4px;
         box-sizing: border-box;
    }
    .label-class-left{
        float: left !important; 
        font-size: 1.8rem;
        font-family: 'Poppins', sans-serif; 
    }
    .label-class-left-2{
        float: left !important; 
        font-size: 1.8rem;
        font-family: 'Poppins', sans-serif; 
        margin-right: 1rem;
    }
    .for-checkbox-css > div{
        font-size: 1.8rem !important;
    }
    
CSS;

$this->registerCss($css);


$js = <<<JS

            $('.radioButton > label:not(:nth-child(1)):not(:nth-child(2)) > input').prop('disabled' , 'true;');


    $('#application-type_of_application > label:nth-child(1) > input').click(function(){
      $('.for-hide').removeClass('hidden');
      $('.hide-1').removeClass('hidden');
      $('.hide-2').addClass('hidden');
      $('.ISSN').removeClass('hidden');
      $('.ISBN').addClass('hidden');
      $('.hide_interval').addClass('hidden');
      
    });
    $('#application-type_of_application > label:nth-child(2) > input').click(function(){
      $('.for-hide').addClass('hidden');
      $('.hide-2').removeClass('hidden');
      $('.hide-1').addClass('hidden');
      $('.ISSN').addClass('hidden');
      $('.ISBN').removeClass('hidden');
      $('.hide_interval').removeClass('hidden');
    });
    
    
   
    
    $('.add_input').bind('click', function(){
        var new_chq_no = parseInt($('#total_chq').val())+1;
        var new_input="<input type='text' id='new_"+new_chq_no+"'  style='padding: 5px 5px;border-radius: 5%;'>";
        $('.input_group').append(new_input);
        $('#total_chq').val(new_chq_no);
    });
    
    $('.delete_input').bind('click' , function(){
      var last_chq_no = $('#total_chq').val();
      if(last_chq_no>1){
        $('#new_'+last_chq_no).remove();
        $('#total_chq').val(last_chq_no-1);
      }});
    
    $('#application-type_of_application > label:nth-child(1) > input').bind('click' , function(){
        $('#fileupload').removeClass('hidden');
        $('#fileupload > .atach_file > div').addClass('hidden');
        $('#fileupload >  .atach_file > div:nth-child(1)').removeClass('hidden');
        $('.public_file').removeClass('hidden');
        $('.certificate_test').addClass('hidden');
        $('.compl_file').addClass('hidden');
        
    });
     $('#application-type_of_application > label:nth-child(2) > input').bind('click' , function(){
        $('#fileupload').removeClass('hidden');
        $('#fileupload >  .atach_file > div').addClass('hidden');
        $('#fileupload >  .atach_file > div:nth-child(2)').removeClass('hidden');
        $('.public_file').addClass('hidden');
        $('.certificate_test').removeClass('hidden');
        $('.compl_file').addClass('hidden');
        
    });
      $('#application-type_of_application > label:nth-child(3) > input').bind('click' , function(){
        $('#fileupload').removeClass('hidden');
        $('#fileupload >  .atach_file > div').addClass('hidden');  
        $('#fileupload >  .atach_file > div:nth-child(3)').removeClass('hidden');
        $('.public_file').addClass('hidden');
        $('.certificate_test').addClass('hidden');
        $('.compl_file').removeClass('hidden');
        
    });
      
     
    $('.radioButton > label:nth-child(1) > input').bind('click' , function(){
        $('.hide-interval').removeClass('hidden');
    });
     $('.radioButton > label:nth-child(2) > input').bind('click' , function(){
        $('.hide-interval').addClass('hidden');
    });
     
    
JS;

$this->registerJs($js);


?>
