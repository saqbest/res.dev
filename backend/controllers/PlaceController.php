<?php

namespace backend\controllers;

use common\models\Photos;
use common\models\PvtPlacesKitchens;
use Yii;
use common\models\Places;
use common\models\PlacesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PlaceController implements the CRUD actions for Places model.
 */
class PlaceController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Places models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlacesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Places model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Places model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Places();
        $user_id = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Your information saved.');
            return $this->render('upload');

            echo Yii::$app->session->getFlash('success');
        } else {
            return $this->render('create', [
                'model' => $model,
                'user_id' => $user_id,
            ]);
        }
    }

    /**
     * Updates an existing Places model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->kitchensIds = $model->getKitchensIds(); //could it be automatically??
        $model->servicesIds = $model->getServicesIds(); //could it be automatically??
        $model->metrosIds = $model->getMetrosIds(); //could it be automatically??
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Your information updated.');
            return $this->render('upload');
            echo Yii::$app->session->getFlash('success');        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Places model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      $this->findModel($id)->delete();
      return $this->redirect(['index']);

//        if ($model->load(Yii::$app->request->post())) {
//            PvtPlacesKitchens::deleteAll('kitchen_id = :kitchenId', [':kitchenId' => $model->id]);
//            $model->delete();
//
//        }
    }
public function actionTest(){
    //  $model=new Places();
//$a=$model->getPvtPlacesKitchens()->where(['place_id'=>3])->all();
//    print_r($a);
    //$model->test();
    // $s=Yii::getAlias('@savepic');
    // mkdir($s.'/545', 0777);
    print_r(Yii::$app->user->identity->id);
}

    public function actionUpload()
    {
        $model = new Photos();
        //$model2 = new Page();
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $place_id = $data['place_id'];
            print_r($_POST['place_id']);
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
//       print_r($model->imageFiles);
//            print_r($model->upload());
//            foreach ($model->imageFiles as $file) {
//                $file->saveAs('uploads/' . $file->baseName .date('Yhis') .'.' . $file->extension);

            //      }
            if ($model->upload($place_id)) {
                //file is uploaded successfully
                echo 111;


            }
        }
//        $pic = $model2->find()->where(['user_id' => Yii::$app->user->identity->id])->all();
//        return $this->render('upload', ['model' => $model,
//            'pic' => $pic
//        ]);
    }
    /**
     * Finds the Places model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Places the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Places::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
