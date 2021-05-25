<?php

namespace backend\controllers;

use Yii;
use app\models\Apple;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AppleController implements the CRUD actions for Apple model.
 */
class AppleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'create', 'generate', 'fall', 'eat', 'delete'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Apple models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Apple::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Apple model.
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
     * Creates a new Apple model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Apple();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idApple]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
  
    /**
     * Generate a number of Apples model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGenerate()
    {
        $apple_count =  random_int(1,10);
        for ($i = 1; $i <= $apple_count; $i++){
          $model = new Apple();
          $model->save();
        }
        Yii::$app->session->setFlash('success', "$apple_count Apples generated"); 
        return $this->redirect(['index']);
    }
  
     /**
     * Fall Apple 
     * @return mixed
     */
    public function actionFall($id)
    {
        $model = $this->findModel($id);
        if( $model->Fall() ){
          $model->save();
          Yii::$app->session->setFlash('success', "Apple #$model->idApple fall"); 
        }
        else{
          $model->save();
          Yii::$app->session->setFlash('warning', "Apple #$model->idApple already been Fall");
        }
        return $this->redirect(['index']);
    }
  
  
    /**
     * Fall Apple 
     * @return mixed
     */
    public function actionEat($id, $eat_part)
    {
        $model = $this->findModel($id);
        if ($model->Eat($eat_part)){        
          if ($model->Eaten >=100) {
            $model->delete();
             Yii::$app->session->setFlash('success', "Apple #$model->idApple was Eaten full and than Delete");
          }
          else{
            $model->save();
            Yii::$app->session->setFlash('success', "Apple #$model->idApple was eaten"); 
          }
        }
        else{
          Yii::$app->session->setFlash('warning', "Apple #$model->idApple not possible to eat (it's Bad or on the Tree)"); 
        }
        return $this->redirect(['index']);
    }


    /**
     * Updates an existing Apple model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idApple]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Apple model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {      
        //For CompanyAdmin
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Apple model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Apple the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apple::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
