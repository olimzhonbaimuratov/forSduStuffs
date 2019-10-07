<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'last_name') ?>
        <?= $form->field($model, 'patronymic') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'rank')->label('Департамент') ?>
        <?= $form->field($model, 'responsibility')->label('Должность') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'retypePassword')->passwordInput() ?>

        <select name="user_role" id="">
           <?php foreach ($roles as $role) : ?>
               <option value="<?=$role->name ?>"><?= $role->name?></option>
           <?php endforeach; ?>
        </select>



    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>


</div>
