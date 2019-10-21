<?php

namespace app\controllers;

use app\models\ApplicationImage;
use app\models\Author;
use app\models\Notification;
use app\models\User;
use Yii;
use app\models\Application;
use app\models\ApplicationSearch;
use yii\base\Exception;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ApplicationController implements the CRUD actions for Application model.
 */
class ApplicationController extends Controller
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
     * Lists all Application models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApplicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Application model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $model = new Application();
        $authorModel = new Author();

        $user = User::findOne(['id' => Yii::$app->user->getId()]);
        $model->name = (User::findOne(['id' => Yii::$app->user->getId()]))->first_name;
        $model->surname = (User::findOne(['id' => Yii::$app->user->getId()]))->last_name;
        $model->patronymic = (User::findOne(['id' => Yii::$app->user->getId()]))->patronymic;
//        $model->email = (User::findOne(['id' => Yii::$app->user->getId()]))->email;
        $model->publication_name = (Yii::$app->getRequest()->post('Application')['publication_name']);
        $model->from_sdu = (Yii::$app->getRequest()->post('Application')['from_sdu']);
        $model->rank = (Yii::$app->getRequest()->post('Application')['rank']);
        $model->phone_number = (Yii::$app->getRequest()->post('Application')['phone_number']);
        $model->google_scholar_url = (Yii::$app->getRequest()->post('Application')['google_scholar_Url']);
        $model->research_gate_url = (Yii::$app->getRequest()->post('Application')['research_gate_Url']);
        $model->academia_url = (Yii::$app->getRequest()->post('Application')['academia_Url']);
        $model->google_scholar_url = (Yii::$app->getRequest()->post('Application')['google_scholar_Url']);
        $model->publishing_house = (Yii::$app->getRequest()->post('Application')['publishing_house']);
        $model->number = (Yii::$app->getRequest()->post('Application')['number']);
        $model->ISSN = (Yii::$app->getRequest()->post('Application')['ISSN']);
        $model->number_of_page = (Yii::$app->getRequest()->post('Application')['all_page']);
        $model->pages = (Yii::$app->getRequest()->post('Application')['pages']);
        $model->DOI_link = (Yii::$app->getRequest()->post('Application')['DOI_link']);
        $model->type_of_application = (Yii::$app->getRequest()->post('Application')['type_of_application']);
        $model->is_agree = (Yii::$app->getRequest()->post('Application')['is_agree']);
        $model->user_id = Yii::$app->user->getId();
        $app_type = (Yii::$app->getRequest()->post('Application')['impact_factor_type']) !== null ? (Yii::$app->getRequest()->post('Application')['impact_factor_type']) : '';
        $model->impact_factor = $app_type;
        if ((Yii::$app->getRequest()->post('Application')['type_for_total']) !== null && (int)(Yii::$app->getRequest()->post('Application')['type_for_total']) != 0) {
            $array = (Yii::$app->getRequest()->post('Application')['type_for_total']);
            if (in_array(1, $array)) {
                $model->thomson_reuters = 1;
            }
            if (in_array(2, $array)) {
                $model->skopus = 1;
            }
            if (in_array(3, $array)) {
                $model->english_france = 1;
            }
            if (in_array(4, $array)) {
                $model->RKBGM = 1;
            }
        }


        $directory = Yii::getAlias('@app/web/images/temp') . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
        $to_directory = Yii::getAlias('@app/web/images/application_files') . DIRECTORY_SEPARATOR;

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        if (!is_dir($to_directory)) {
            FileHelper::createDirectory($to_directory, 0775, true);
        }


        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $authors = Yii::$app->request->post('Application')['authors'];

                foreach ($authors as $author) {
                    Yii::$app->db->createCommand()->insert('author', [
                        'full_name' => $author,
                        'application_id' => $model->id,
                    ])->execute();
                }

                if (is_dir($directory)) {
                    $files = scandir($directory);
                    foreach ($files as $key => $value) {
                        if (!in_array($value, ['.', '..'])) {
                            $image_type = substr($value, 0, 5);
                            $imageupload = new ApplicationImage();
                            $imageupload->application_id = $model->id;
                            $imageupload->image_url = $value;
                            $imageupload->image_type = $image_type;
                            $imageupload->save();
                        }
                    }

                    $files = scandir($directory);
                    foreach ($files as $key => $value) {
                        if (!in_array($value, ['.', '..'])) {
                            $path = $directory . $value;
                            $to_path = $to_directory . $value;
                            rename($path, $to_path);
                        }
                    }
                }


                $db->transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing Application model.
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
     * Deletes an existing Application model.
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
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMyApplication()
    {
//        var_dump(Yii::$app->user->getId());
        if (Yii::$app->user->can('stuff')) {
            $searchModel = new ApplicationSearch();
            $dataProvider = $searchModel->searchForstuffs(Yii::$app->request->queryParams);
//
            return $this->render('myapplication', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
//            return $this->render('myapplication');
        }
    }

    public function actionShowApplication($id = null)
    {
        $model = Application::findOne(['id' => $id]);

        $total_sum = 0;
        if ($model->impact_factor) {
            switch ($model->impact_factor) {
                case 1:
                    $total_sum += 100000;
                    break;
                case 2:
                    $total_sum += 250000;
                    break;
                case 3:
                    $total_sum += 500000;
                    break;
                case 4:
                    $total_sum += 750000;
                    break;
            }
        }
        if ($model->thomson_reuters) {
            $total_sum += 45000;
        }
        if ($model->skopus) {
            $total_sum += 35000;
        }
        if ($model->english_france) {
            $total_sum += 20000;
        }
        if ($model->RKBGM) {
            $total_sum += 10000;
        }
        $typeApplication = Application::findOne(['id' => $id])->type_of_application;
        if ($typeApplication == 1) {
            $total_sum_20 = ($total_sum / 100) * 20;
            $count = Author::find()->andWhere(['application_id' => $id])->count();
            $total_sum = ($total_sum / $count) + $total_sum_20;
        } else {
            $count = Author::find()->andWhere(['application_id' => $id])->count();
            $total_sum = $total_sum / $count;
        }


        return $this->render('show_application', [
            'model' => $model,
            'total_sum' => $total_sum,
        ]);
    }

    public function actionFormStatus()
    {
        $model = Application::findOne(['id' => Yii::$app->request->get('id')]);
        $notify = new Notification();
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->can('adminScienceDepartment')) {
                $model->status = Yii::$app->request->post('data');
                $notify_body = '';
                $notify_body = $model->status == 1 ? 'Ваше приложение была подтверждена департаментом наук' : 'Ваше приложение была отказано департаментом наук';
                $notify->notify_body = $notify_body;
                $notify->application_id = Yii::$app->request->get('id');
                $notify->application_by_role = 'adminScienceDepartment';
            }

            if (Yii::$app->user->can('accountant')) {
                $notify_body = $model->status == 1 ? 'Ваше приложение была подтверждена бухгалтером' : 'Ваше приложение была отказано бухгалтером';
                $model->status_by_accountant = Yii::$app->request->post('data');
                $notify->notify_body = $notify_body;
                $notify->application_id = Yii::$app->request->get('id');
                $notify->application_by_role = 'accountant';
            }

            $model->reason_of_rejected = Yii::$app->request->post('reason');

            if ($model->save() && $notify->save())
                Yii::$app->session->setFlash('success', 'Статус успешно изменен');
            return $this->redirect('/application/index');
        } else {
            Yii::$app->session->setFlash('danger', 'Произошла ошибка');
            return $this->redirect('/application/index');
        }
    }

    public function actionImageUpload()
    {
        $model = new Application();

        $type_image = Yii::$app->getRequest()->get('type');

        if ($type_image == 'PUB_F') {
            $imageFile = UploadedFile::getInstance($model, 'image_pub_f');
        } elseif ($type_image == 'CER_F') {
            $imageFile = UploadedFile::getInstance($model, 'image_cer_f');
        } elseif ($type_image == 'COM_F') {
            $imageFile = UploadedFile::getInstance($model, 'image_com_f');
        }


        $directory = Yii::getAlias('@app/web/images/temp') . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $type_image . $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;
            if ($imageFile->saveAs($filePath)) {
                $path = '/images/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'url' => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => '/application/image-delete?name=' . $fileName,
                            'deleteType' => 'POST',
                        ],
                    ],
                ]);
            }
        }

        return '';
    }

    public function actionGetUrl()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post('data');
            if (isset($data)) {
                switch ($data) {
                    case 'google_scholar_url' :
                        $google_scholar_url = Application::findOne(['id' => Yii::$app->request->get('id')]);
                        $google_scholar_url = $google_scholar_url->google_scholar_url;
                        return $google_scholar_url;
                        break;

                    case 'academia_url':
                        $academia_url = Application::findOne(['id' => Yii::$app->request->get('id')]);
                        $academia_url = $academia_url->academia_url;
                        return ($academia_url);
                        break;

                    case 'research_gate_url':
                        $research_gate_url = Application::findOne(['id' => Yii::$app->request->get('id')]);
                        $research_gate_url = $research_gate_url->research_gate_url;
                        return ($research_gate_url);
                        break;
                }
            }

        }
    }

    public function actionGetUrlImg()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post('data');
            if (isset($data)) {
                switch ($data) {
                    case 'article':
                        $imageArray = [];
                        $article_images = Application::find()->where(['id' => Yii::$app->request->get('id')])->with('image')->asArray()->all();

                        foreach ($article_images as $image) {
                            foreach ($image['image'] as $image_url) {
                                if (substr($image_url['image_url'], 0, 3) == 'PUB') {
                                    array_push($imageArray, $image_url['image_url']);
                                }

                            }
                        }
                        return json_encode($imageArray);
                        break;

                    case 'certificate' :
                        $imageArray = [];
                        $article_images = Application::find()->where(['id' => Yii::$app->request->get('id')])->with('image')->asArray()->all();

                        foreach ($article_images as $image) {
                            foreach ($image['image'] as $image_url) {
                                if (substr($image_url['image_url'], 0, 3) == 'CER') {
                                    array_push($imageArray, $image_url['image_url']);
                                }

                            }
                        }
                        return json_encode($imageArray);
                        break;

                    case 'complete_intelligence' :
                        $imageArray = [];
                        $article_images = Application::find()->where(['id' => Yii::$app->request->get('id')])->with('image')->asArray()->all();

                        foreach ($article_images as $image) {
                            foreach ($image['image'] as $image_url) {
                                if (substr($image_url['image_url'], 0, 3) == 'COM') {
                                    array_push($imageArray, $image_url['image_url']);
                                }

                            }
                        }
                        return json_encode($imageArray);
                }
            }
        }


    }

    public function actionImageDelete($name)
    {
        $directory = Yii::getAlias('@app/web/images/temp') . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = '/images/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => '/application/image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }


}
