<?php

namespace app\controllers;

use app\models\AddComment;
use app\models\Post;
use app\models\RemovePost;
use app\models\RemovePostImage;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

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
                'only' => ['logout', 'index', 'user', 'about', 'contact', 'post', 'array'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                    [
                        'actions' => ['user'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['about'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                    [
                        'actions' => ['contact'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                    [
                        'actions' => ['post'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                    [
                        'actions' => ['add'],
                        'allow' => true,
                        'roles' => ['admin'],
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
        if(Yii::$app->user->can('user')) {
            return $this->render('fe_index');
        } else {
            return $this->render('index');
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
            $user = User::find()->where(['email' => Yii::$app->user->identity->email])->one();

            if(empty($user->accepted_token)) {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', "Please check your email to account activation or send new activation email.");
                return $this->redirect(['login']);
            } else {
                return $this->redirect(['site/index']);
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('fe_contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionSendMail()
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

    /**
     * Displays user page.
     *
     * @return string
     */
    public function actionUser()
    {
        $users = User::find()->all();

        return $this->render('users/index', compact('users'));
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = new User();
        if ($user->load(Yii::$app->request->post())) {
            $password = $user->password;
            $user->password = Yii::$app->security->generatePasswordHash($user->password);
            $user->authKey = Yii::$app->security->generateRandomString(30);
            $user->accessToken = Yii::$app->security->generateRandomString(30);

            if ($user->save()) {
                $auth = Yii::$app->authManager;
                $role = $auth->getRole('user');
                $auth->assign($role, $user->getId());
                $user->register([$user->email, $user->username, $password]);
                return $this->redirect(['login']);
            }
        }

        return $this->render('register', compact('user'));
    }

    public function actionAccept($email, $pass)
    {
        $user = User::find()->where(['email' => $email])->one();

        if(empty($user->accepted_token)) {
            $sql = 'UPDATE users SET accepted_token = :accepted_token, accepted_at = :accepted_at WHERE email = :email';

            $params = [
                ':accepted_token' => Yii::$app->security->generateRandomString(30),
                ':accepted_at' => date('Y-m-d H:i:s'),
                ':email' => $email,
            ];

            if (\Yii::$app->db->createCommand($sql, $params)->execute()) {
                $user->account_activation(['email' => $email, 'user_name' => $user->username]);
                Yii::$app->user->logout();

                $model = new LoginForm();
                $model->email = $email;
                $model->password = $pass;

                if ($model->validate() && $model->login()) {
                    Yii::$app->session->setFlash('success', "User Login successfully.");
                    return $this->redirect(['site/index']);
                }
            }
        } else {
            Yii::$app->user->logout();
            Yii::$app->session->setFlash('error', "This link already accepted please login with email & password.");
            return $this->redirect(['login']);
        }
    }

    public function actionForgotPassword()
    {
        $email = \Yii::$app->request->get('email');

        if(!empty($email)) {
            $user = User::findOne(['email' => $email]);

            if($user) {
                $user->forgot([$email]);
                Yii::$app->session->setFlash('success', "Check your email for forgot password.");
                return $this->redirect(['login']);
            } else {
                Yii::$app->session->setFlash('error', "No user is associated with this email address.");
                return $this->redirect(['site/forgot-password']);
            }
        }

        return $this->render('forgot');
    }

    public function actionNewPassword($email)
    {
        $password = \Yii::$app->request->get('password');

        if(!empty($password)) {
            $sql = 'UPDATE users SET password = :password WHERE email = :email';

            $params = [
                ':password' => Yii::$app->security->generatePasswordHash($password),
                ':email' => $email,
            ];

            if (\Yii::$app->db->createCommand($sql, $params)->execute()) {
                return $this->redirect(['login']);
            };
        }

        return $this->render('new_password', compact('email'));
    }

    public function actionUserAdd()
    {
        $user = new User();
        if ($user->load(Yii::$app->request->post())) {
            $user->password = Yii::$app->security->generatePasswordHash($user->password);
            $user->authKey = Yii::$app->security->generateRandomString(30);
            $user->accessToken = Yii::$app->security->generateRandomString(30);

            if ($user->save()) {
                return $this->redirect(['user']);
            }
        }

        return $this->render('users/user_form', compact('user'));
    }

    public function actionUserEdit($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        if($user === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if($user->load(Yii::$app->request->post()) && $user->save()){
            return $this->redirect(['index']);
        }
        return $this->render('users/user_form', ['user' => $user]);
    }

    public function actionUserDelete($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        if($user === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $user->delete();
        return $this->render('index');
    }

    public function actionPost()
    {
        $posts = Post::find()->with('user')->all();
        $users = User::find()->all();
        return $this->render('posts/index', compact('posts', 'users'));
    }

    public function actionPostAdd()
    {
        $post = new Post();
        if ($post->load(Yii::$app->request->post())) {
            $post->post_image = UploadedFile::getInstance($post, 'post_image');
            $fileName = time().'.'.$post->post_image->extension;
            $post->post_image->saveAs('posts/'. $fileName);
            $post->post_image = $fileName;

            if ($post->save()) {
                return $this->redirect(['post']);
            }
        }

        return $this->render('posts/post_form', compact('post'));
    }

    public function actionPostEdit($id) {
        $post = Post::findOne($id);

        if ($post->load(Yii::$app->request->post())) {
            $postImageFile = UploadedFile::getInstance($post, 'post_image');

            if ($postImageFile) {
                $fileName = time() . '.' . $postImageFile->extension;
                $filePath = Yii::getAlias('@webroot') . '/posts/' . $fileName;

                if ($postImageFile->saveAs($filePath)) {
                    if (!empty($post->post_image)) {
                        @unlink(Yii::getAlias('@webroot') . '/posts/' . $post->post_image);
                    }
                    $post->post_image = $fileName;
                }
            } else {
                $post->post_image = $post->oldAttributes['post_image'];
            }

            if ($post->save()) {
                return $this->redirect(['post']);
            }
        }

        return $this->render('posts/post_form', compact('post'));
    }

    public function actionFilterPost()
    {
        $title = \Yii::$app->request->get('title');
        $user_id = \Yii::$app->request->get('user_id') ?? '';

        $query = Post::find();

        if ($title) {
            $query->andWhere(['like', 'title', $title]);
        }

        if ($user_id) {
            $query->andWhere(['user_id' => $user_id]);
        }

        $posts = $query->all();
        $users = User::find()->all();
        return $this->render('posts/index', compact('posts', 'users', 'title', 'user_id'));
    }

    public function actionCommentAdd()
    {
        $count = \Yii::$app->request->get('query', 1);

        if (is_numeric($count) && $count > 0) {
            \Yii::$app->queue->push(new AddComment(['count' => (int)$count]));
            Yii::$app->queue->run(0);
        } else {
            \Yii::$app->session->setFlash('error', 'Invalid count value.');
        }

        return $this->redirect(['index']);
    }

    public function actionCommentRemove()
    {
        \Yii::$app->queue->push(new RemovePost());
        Yii::$app->queue->run(0);

        return $this->redirect(['index']);
    }

    public function actionQueueWork()
    {
        Yii::$app->queue->run(0);

        return $this->redirect(['index']);
    }

    public function actionClearDirectory()
    {
        \Yii::$app->queue->push(new RemovePostImage());
        Yii::$app->queue->run(0);

        return $this->redirect(['index']);
    }


}
