<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Posts;
use app\models\PostsSearch;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use HTMLPurifier;
use HTMLPurifier_Config;
use yii\web\Response;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                // Access Control Behavior
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['?'], // Guests can only view posts
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create', 'update', 'delete', 'view', 'index'],
                            'roles' => ['@'], // Only authenticated users can perform CRUD actions
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update', 'delete'],
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                $postId = Yii::$app->request->get('id');
                                $post = Posts::findOne($postId);
                                return $post && $post->user_id == Yii::$app->user->id; // User can only edit their own posts
                            },
                        ],
                    ],
                ],
                // Verb Filter Behavior
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'], // Ensure only POST method for delete action
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Posts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Filter posts to only include those belonging to the currently logged-in user
        $dataProvider->query->andWhere(['user_id' => Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Posts model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModelWithViewCount($id); // Fetch model and handle view count
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Post model and increments the view count if needed.
     *
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelWithViewCount(int $id): Posts
    {
        $model = Posts::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        $viewedPosts = $session->get('viewedPosts', []);

        if (!in_array($id, $viewedPosts, true)) {
            $viewedPosts[] = $id;
            $session->set('viewedPosts', $viewedPosts);

            $model->updateCounters(['view_count' => 1]);
        }

        return $model;
    }


    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new Posts();
        $model->user_id = \Yii::$app->user->id;
        // Fetch categories
        $categoryList = Categories::find()
            ->select(['name'])
            ->indexBy('id') // Creates [id => name]
            ->column();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Sanitize content before saving
                $model->content = $this->sanitizeContent($model->content);

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'categoryList' => $categoryList, // Pass category list
        ]);
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryList = Categories::find()
            ->select(['name'])
            ->indexBy('id') // Creates [id => name]
            ->column();

        if ($this->request->isPost && $model->load($this->request->post())) {
            // Sanitize content before saving
            $model->content = $this->sanitizeContent($model->content);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categoryList' => $categoryList,
        ]);
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Helper method to sanitize content (prevent XSS)
     * @param string $content
     * @return string
     */
    protected function sanitizeContent($content)
    {
        // Using HTMLPurifier for advanced sanitization
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($content); // Ensure the content is safe
    }
}
