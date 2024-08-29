<?php

namespace app\controllers;

use app\models\Comment;
use app\models\Post;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CommentController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin', 'user', 'temporary admin'],
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

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity->status;

            if($user == 0) {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', "Your status is deactivated, please contact the administrator.");
                return $this->redirect(['../site/login']);
            }
        }

        if(Yii::$app->session->get('key') == 'locked') {
            Yii::$app->session->setFlash('error', 'Please unlock you admin panel.');
            return $this->redirect(['site/index']);
        } else {
            $posts = Post::find()->all();

            return $this->render('index', compact('posts'));
        }
    }

    public function actionPostView($id)
    {
        if(Yii::$app->session->get('key') == 'locked') {
            Yii::$app->session->setFlash('error', 'Please unlock you admin panel.');
            return $this->redirect(['site/index']);
        } else {

            $post = Post::findOne($id);
            $comment = new Comment();

            if ($comment->load(Yii::$app->request->post())) {
                if (!Yii::$app->user->isGuest) {
                    $comment->user_id = Yii::$app->user->identity->id;
                    $comment->post_id = $post->id;
                    $comment->like = $comment->like ? '1' : '0';

                    if ($comment->save()) {
                        Yii::$app->session->setFlash('success', 'Comment posted successfully.');
                        return $this->redirect(['post-view', 'id' => $id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to post comment.');
                    }
                } else {
                    return $this->redirect(['site/login']);
                }
            }

            $comments = Comment::find()->all();

            return $this->render('view', compact('post', 'comment', 'comments'));
        }
    }

    public function actionCommentList()
    {
        $comments = Comment::find()->all();

        return $this->render('list', compact('comments'));
    }

}
