<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   
        $products = Products::find()->all();
        return $this->render('index' , [
            'products'=> $products,
        ]);
    }

    public function actionCreate()
{
    $product = new Products();
    
    if ($product->load(Yii::$app->request->post())) {
        if ($product->save()) {
            Yii::$app->session->setFlash('success', 'Product added successfully');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to add product');
        }
    }

    return $this->render('create', ['product' => $product]);
}

    

    

    public function actionView($id){
        $product = Products::findOne($id);
        return $this->render('view' , ["product" => $product ]);
    }

    public function actionDelete($id){
        $product = Products::findOne($id);
        if($product->delete()){
            Yii::$app->getSession()->setFlash('success' , "Prodcut delete successfully");
            return $this->redirect(['index']);
        }
    }  
    
    public function actionUpdate($id){
        $product = Products::findOne($id);
        if($product->load(Yii::$app->request->post()) && $product->save() ){
            Yii::$app->getSession()->setFlash('success' , "Product update successfully");
            return $this->redirect(['index']);    
        } else{
            return $this->render('update' , ['product' => $product]);
        }
        
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**2 
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
