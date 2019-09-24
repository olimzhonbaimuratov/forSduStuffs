<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'patronymic') ?>

    <?= $form->field($model, 'rank') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'link_for_application') ?>

    <?php // echo $form->field($model, 'type_of_application') ?>

    <?php // echo $form->field($model, 'application_edition') ?>

    <?php // echo $form->field($model, 'ISSN') ?>

    <?php // echo $form->field($model, 'ISBN') ?>

    <?php // echo $form->field($model, 'from_sdu') ?>

    <?php // echo $form->field($model, 'first_auhtor') ?>

    <?php // echo $form->field($model, 'number_of_author') ?>

    <?php // echo $form->field($model, 'is_agree') ?>

    <?php // echo $form->field($model, 'DOI_link') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
