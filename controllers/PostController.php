<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class PostController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'index', 'user', 'about', 'contact', 'post', 'setting'],
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
                    [
                        'actions' => ['setting'],
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

    public function actionIndex()
    {
        return $this->render('post');
    }

}
