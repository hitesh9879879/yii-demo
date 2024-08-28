<?php

namespace app\controllers;

use app\models\Comment;
use app\models\Post;
use Yii;

class CommentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $posts = Post::find()->all();

        return $this->render('index', compact('posts'));
    }

    public function actionPostView($id)
    {
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

    public function actionCommentList()
    {
        $comments = Comment::find()->all();

        return $this->render('list', compact('comments'));
    }

}
