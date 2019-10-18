<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use yii\helpers\Html; ?>
<div class="site-index">
    Добро пожаловть
</div>


<?php if(Yii::$app->user->can('accountant')): ?>
    <h3>Hello accountant</h3>


<?php elseif (Yii::$app->user->can('admin')): ?>
    <h3>Добро пожаловать Олимжан Баймуратов</h3>

<?php elseif(Yii::$app->user->can('stuff')): ?>
    <h3>Hello stuff</h3>

<?php elseif(Yii::$app->user->can('adminScienceDepartment')): ?>
    <h3>hello adminScienceDepartment </h3>
<?php  endif; ?>


