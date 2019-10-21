<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'username')->label("ID-номер") ?>
<!--                    --><?//= $form->field($model, 'first_name')->label('Имя') ?>
<!--                    --><?//= $form->field($model, 'last_name')->label('Фамилия') ?>
<!--                    --><?//= $form->field($model, 'patronymic')->label('Отчество') ?>
<!--                    --><?//= $form->field($model, 'rank')->label('Департамент') ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'responsibility')->label('Должность') ?>
                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                    <?= $form->field($model, 'retypePassword')->passwordInput()->label('Повторите пароль') ?>
                    <?= $form->field($model, 'roles')->dropDownList(\app\models\User::getDropDownList())->label('Выберите роль'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
