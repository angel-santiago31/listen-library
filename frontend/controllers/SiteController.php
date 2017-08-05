<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\CreditCard;
use backend\models\Audiobook;
use backend\models\AudiobookSearch;
use backend\models\Order;
use backend\models\Contains;
use common\models\Customer;
use kartik\growl\Growl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
     * @return mixed
     */
     public function actionIndex($title = NULL)
     {
        $model = new Audiobook();

        if ($model->load(Yii::$app->request->post()) && $title == NULL) {
            $query = "SELECT * FROM `audiobook` WHERE `title` LIKE '%$model->title%' AND active = 10";
            $audiobookList = Audiobook::findBySql($query)->all();

            Yii::$app->getSession()->setFlash('index_audiobooks_search', [
                       'type' => 'success',
                       'duration' => 5000,
                       'icon' => 'glyphicon glyphicon-ok-sign',
                       'title' => 'Search Bar',
                       'message' => $query,
                       'positonY' => 'top',
                       'positonX' => 'right'
                       ]);

            return $this->render('index', [
               'model' => $model,
               'audiobookList' => $audiobookList,
            ]);
        }

        $audiobookList = Audiobook::find()->where(['active' => Audiobook::STATUS_ACTIVE])->all();
        $query = "SELECT * FROM `audiobook` WHERE active = 10";
        Yii::$app->getSession()->setFlash('index_audiobooks', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Default Index',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('index', [
           'model' => $model,
           'audiobookList' => $audiobookList,
        ]);
     }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $query = "INSERT INTO customer VALUES($model->first_name, $model->last_name, $model->initial,
                    $model->age, $model->email, $model->phone_number_1, $model->phone_number_2)";
                    Yii::$app->getSession()->setFlash('customer_signup_1', [
                                 'type' => 'success',
                                 'duration' => 5000,
                                 'icon' => 'glyphicon glyphicon-ok-sign',
                                 'title' => 'Customer Signup 1',
                                 'message' => $query,
                                 'positonY' => 'top',
                                 'positonX' => 'right'
                                ]);

                    $query = "INSERT INTO credit_card VALUES($model->card_last_digits, $model->expiration_date, $model->card_type)";
                    Yii::$app->getSession()->setFlash('customer_signup_2', [
                                 'type' => 'success',
                                 'duration' => 5000,
                                 'icon' => 'glyphicon glyphicon-ok-sign',
                                 'title' => 'Customer Signup 2',
                                 'message' => $query,
                                 'positonY' => 'top',
                                 'positonX' => 'right'
                                ]);

                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionAddToCart($id)
    {
        $cart = Yii::$app->cart;

        $model = Audiobook::findOne($id);
        if ($model) {
            $cart->put($model, 1);
            return $this->redirect(['cart-view']);
        }
        throw new NotFoundHttpException();
    }

    public function actionCartView()
    {
       $itemsCount = \Yii::$app->cart->getCount();
       $total = \Yii::$app->cart->getCost();

       return $this->render('cart-view', [
           'itemsCount' => $itemsCount,
            'total' => $total,
       ]);
    }

    public function actionCartRemove($id)
    {
       $cart = Yii::$app->cart;

       $model = Audiobook::findOne($id);

       if ($model) {
           $cart->remove($model);

           return $this->redirect(['cart-view']);
       }

       throw new NotFoundHttpException();
    }

    public function actionCheckout()
    {
         //if user is guest, redirect him/her to log in page
         if (Yii::$app->user->isGuest) {

             return $this->redirect(['login']);
         }

         return $this->redirect(['placeorder']);
    }

    public function actionPlaceorder()
    {
        //Get the current customer's credit card.
        $credit_card = $this->findPaymentMethod(Yii::$app->user->identity->getId());

        //Create a new Order.
        $order = new Order();
        $order->item_quantity = Yii::$app->cart->getCount();
        $order->status = Order::STATUS_ACTIVE;
        $order->customer_id = Yii::$app->user->identity->getId();
        $order->credit_card = $credit_card->id;
        $order->price_total = Yii::$app->cart->getCost();

        if ($order->save(false)) {
            //asociate items to created order
            $positions = Yii::$app->cart->positions;

            $query = "INSERT INTO order VALUES ($order->item_quantity, $order->status, $order->customer_id, $order->credit_card, $order->price_total)";
            Yii::$app->getSession()->setFlash('order', [
                       'type' => 'success',
                       'duration' => 5000,
                       'icon' => 'glyphicon glyphicon-ok-sign',
                       'title' => 'Order Placed',
                       'message' => $query,
                       'positonY' => 'top',
                       'positonX' => 'right'
                      ]);

            foreach($positions as $position) {
                $audiobook = new Contains();
                $audiobook->order_id = $order->id;
                $audiobook->audiobook_id = $position->id;
                $audiobook->save(false);

                $query = "INSERT INTO item_in_order VALUES($audiobook->order_id, $audiobook->audiobook_id, $audiobook->audiobook_id)";
                Yii::$app->getSession()->setFlash('order_item', [
                           'type' => 'success',
                           'duration' => 5000,
                           'icon' => 'glyphicon glyphicon-ok-sign',
                           'title' => 'Order Item',
                           'message' => $query,
                           'positonY' => 'top',
                           'positonX' => 'right'
                          ]);
            }

            Yii::$app->cart->removeAll();

            return $this->redirect(['site/view-order-details', 'id' => $order->id]);
        }

        Yii::$app->getSession()->setFlash('order', [
                   'type' => 'danger',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Error Message',
                   'message' => 'A problem occured and your purchase did not went through.',
                   'positonY' => 'top',
                   'positonX' => 'right'
                  ]);

        return $this->redirect(['cart-view']);
    }

    public function actionViewOrderDetails($id)
    {
        $items_in_order = Contains::find()->where(['order_id' => $id])->all();

        $query = "SELECT * FROM `item_in_order` WHERE `order_id`= $id";
        Yii::$app->getSession()->setFlash('order_details', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Order Details',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('view-order-details', [
            'model' => $this->findOrder($id),
            'items_in_order' => $items_in_order,
        ]);
    }

    public function actionViewItemDetails($id)
    {
        $query = "SELECT * FROM `audiobook` WHERE `id`= $id";
        Yii::$app->getSession()->setFlash('view_item_details', [
                   'type' => 'success',
                   'duration' => 5000,
                   'icon' => 'glyphicon glyphicon-ok-sign',
                   'title' => 'Order Details',
                   'message' => $query,
                   'positonY' => 'top',
                   'positonX' => 'right'
                   ]);

        return $this->render('view-item-details', [
            'model' => $this->findAudiobook($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPaymentMethod($id)
    {
        if (($model = CreditCard::find()->where(['customer_id' => $id])->one()) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAudiobook($id)
    {
        if (($model = Audiobook::findOne($id)) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findOrder($id)
    {
        if (($model = Order::findOne($id)) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
