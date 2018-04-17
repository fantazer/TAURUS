<?php

namespace app\controllers;

use app\repositories\TagRepository;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\forms\LoginForm;
use app\forms\ContactForm;
use app\repositories\CategoryRepository;
use app\repositories\ProductRepository;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'site.php';

    /**
     * @var string
     */
    const EXCEPTION_MESSAGE_CATEGORY_NOT_FOUND = 'Указанная категория - не найдена';

    /**
     * @var string
     */
    const EXCEPTION_MESSAGE_PRODUCT_NOT_FOUND = 'Указанный продукта - не найден';

    /**
     * @var string
     */
    const EXCEPTION_INVALID_URL_FOR_PRODUCT = 'Указан неверный URL для продукта';

    /**
     * @var string
     */
    const EXCEPTION_TAG_NOT_FOUND = 'Указанный тег - не найден';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'admin'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/admin']);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionContacts()
    {
        $contactForm = new ContactForm();
        $request = Yii::$app->request;

        if ($request->isPost) {
            if ($contactForm->load($request->post()) && $contactForm->validate()) {
				$contactForm->sendEmail();
				\Yii::$app->session->setFlash('emailSend');
            }
        }

        return $this->render('contacts', [
            'contactForm' => $contactForm,
        ]);
    }

    public function actionAdmin()
    {
        $this->layout = 'main.php';

        return $this->render('admin');
    }

    public function actionCategory($id = null, $url = null)
    {
        if (is_null($id) && is_null($url)) {
            throw new NotFoundHttpException(self::EXCEPTION_MESSAGE_CATEGORY_NOT_FOUND);
        } else if (!is_null($url)) {
            $category = CategoryRepository::findByUrl($url);

            if (is_null($category)) {
                throw new NotFoundHttpException(self::EXCEPTION_MESSAGE_CATEGORY_NOT_FOUND);
            }
        } else {
            $category = CategoryRepository::findById($id);

            if (is_null($category)) {
                throw new NotFoundHttpException(self::EXCEPTION_MESSAGE_CATEGORY_NOT_FOUND);
            }
        }

        return $this->render('category', [
            'category' => $category,
        ]);
    }

    /**
     * @param integer $category_id
     * @param string $category_url
     * @param integer $product_id
     * @param string $product_url
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionProduct($category_id = null, $category_url = null, $product_id = null, $product_url = null)
    {
        if ((is_null($category_id) && is_null($category_url) || (is_null($product_id) && is_null($product_url)))) {
            throw new NotFoundHttpException(self::EXCEPTION_MESSAGE_PRODUCT_NOT_FOUND);
        } else {
            if (!is_null($product_id)) {
                $product = ProductRepository::findById($product_id);
            } else {
                $product = ProductRepository::findByUrl($product_url);
            }

            if (!is_null($category_id)) {
                if ($product->category_id != $category_id) {
                    throw new NotFoundHttpException(self::EXCEPTION_INVALID_URL_FOR_PRODUCT);
                }
            } else {
                $category = CategoryRepository::findByUrl($category_url);

                if (is_null($category)) {
                    throw new NotFoundHttpException(self::EXCEPTION_MESSAGE_CATEGORY_NOT_FOUND);
                } else {
                    if (is_null($product)) {
                        throw new NotFoundHttpException(self::EXCEPTION_MESSAGE_PRODUCT_NOT_FOUND);
                    } else {
                        if ($category->id != $product->category_id) {
                            throw new NotFoundHttpException(self::EXCEPTION_INVALID_URL_FOR_PRODUCT);
                        }
                    }
                }
            }
        }

        return $this->render('product', [
            'product' => $product,
        ]);
    }

    /**
     * @param string $search
     * @return string
     */
    public function actionSearch($search)
    {
        $products = ProductRepository::findNameOrDescriptionLike($search);

        return $this->render('search', [
            'products' => $products,
            'search' => $search,
        ]);
    }

    /**
     * @param integer $tag
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionProductByTag($tag)
    {
        $tag = TagRepository::findById($tag);

        if (!$tag) {
            throw new NotFoundHttpException(self::EXCEPTION_TAG_NOT_FOUND);
        }

        return $this->render('product_by_tag', [
            'tag' => $tag,
        ]);
    }
	
	/**
     * Ajax отправка email
     *
     * @return array
     */
    public function actionSendEmail()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $response = [
            'error' => false,
            'message' => '',
        ];

        if ($request->isAjax) {
            $callbackForm = new ContactForm();

            if ($callbackForm->load($request->post()) && $callbackForm->validate()) {
                $callbackForm->sendEmail();
                $response['message'] = 'Спасибо за обращение, ваше сообщение отправлено.';
            } else {
                $response['error'] = true;

                $temp = [];
                foreach ($callbackForm->getErrors() as $error) {
                    $temp[] = $error[0];
                }

                $response['message'] = implode(' ', $temp);
            }

            return $response;
        } else {
            $response['error'] = true;
            $response['message'] = 'Only ajax request';

            return $response;
        }
    }
}
