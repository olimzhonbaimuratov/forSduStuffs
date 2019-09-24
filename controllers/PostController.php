<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 14.09.2019
 * Time: 23:32
 */

namespace app\controllers;


use app\models\Post;
use yii\web\Controller;

class PostController extends Controller
{
    public function actionIndex(){
        $posts = Post::find()->all();
        return $this->render('index' , compact('posts'));
    }
}