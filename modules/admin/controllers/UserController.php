<?php

namespace app\modules\admin\controllers;

use app\models\AuthAssignment;
use http\Url;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mdm\admin\models\form\Signup;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

//        echo  '<pre>' , var_dump(User::find()->where(['id'=>$id])->with('roles')->all())  ,'</pre>' ;
//        var_dump($this->findModel($id));
//        echo '<br>';
//        var_dump(User::find()->where(['id' => $id])->one());
        return $this->render('view', [
            'model' => User::find()->where(['id' => $id])->one(),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Signup();
        $roles = Yii::$app->authManager->getRoles();
        $authassignment = new AuthAssignment();

        if ($model->load(Yii::$app->request->post())) {

            if ($user = $model->signup()) {
                $userId = ($this->getId($model->email)['id']);
                $authassignment->item_name = Yii::$app->request->post('user_role');
                $authassignment->user_id = $userId;
//                var_dump( Yii::$app->request->post('user_role') . ' ' .$userId);
                if ($authassignment->save()) {
                    return $this->goHome();
                }

            }

        }
        return $this->render('create', compact('model', 'roles'));
    }

    public function getId($email)
    {
        $userID = User::findOne(['email' => $email]);
        return $userID;
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
