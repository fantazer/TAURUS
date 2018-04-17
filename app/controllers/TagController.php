<?php

namespace app\controllers;

use Yii;
use app\models\Tag;
use app\models\search\Tag as TagSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\repositories\ProductRepository;
use app\repositories\TagRepository;
use app\models\TagProduct;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
{
    /**
     * @inheritdoc
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCreateTagForProduct($product_id)
    {
        $product = ProductRepository::findById($product_id);

        if (is_null($product)) {
            throw new NotFoundHttpException('Невозможно добавить тег - продукт не найден');
        } else {
            $model = new Tag();

            if ($model->load(Yii::$app->request->post())) {
                $tag = TagRepository::findByName($model->name);

                if (is_null($tag)) {
                    if ($model->save()) {
                        $tagProduct = new TagProduct();
                        $tagProduct->product_id = $product->id;
                        $tagProduct->tag_id = $model->id;
                        $tagProduct->save();
                    }
                } else {
                    $tagProduct = new TagProduct();
                    $tagProduct->product_id = $product->id;
                    $tagProduct->tag_id = $tag->id;
                    $tagProduct->save();
                }

                return $this->redirect(['product/view', 'id' => $product_id]);
            }
        }

        return $this->render('add_tag_for_product', [
            'model' => $model,
            'product' => $product,
        ]);
    }

    public function actionRemoveTagFromProduct($tag_id, $product_id)
    {
        TagProduct::find()
            ->where('tag_id = :tag_id AND product_id = :product_id', [
                ':tag_id' => $tag_id,
                ':product_id' => $product_id,
            ])
            ->one()
            ->delete();

        return $this->redirect(['product/view', 'id' => $product_id]);
    }

    public function actionAjaxSearchTag()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $tagName = $request->post('tag', null);

            if (is_null($tagName)) {
                return [];
            } else {
                return TagRepository::findNamesByString($tagName);
            }
        } else {
            throw new ForbiddenHttpException('Only ajax request');
        }
    }
}
