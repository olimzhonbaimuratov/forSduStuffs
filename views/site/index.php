<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>
<div class="site-index">
    Сулейман Демирель
</div>

<?php if(Yii::$app->user->can('accountant')): ?>
    <h3>Hello accountant</h3>

<?php elseif (Yii::$app->user->can('admin')): ?>
    <h3>Hello admin</h3>

<?php elseif(Yii::$app->user->can('stuff')): ?>
    <h3>Hello stuff</h3>

<?php elseif(Yii::$app->user->can('adminScienceDepartment')): ?>
    <h3>hello adminScienceDepartment </h3>
<?php  endif; ?>


