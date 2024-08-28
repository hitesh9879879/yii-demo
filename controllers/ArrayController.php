<?php

namespace app\controllers;

use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ArrayController extends \yii\web\Controller
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
        $model = \Yii::$app->request->get('model');
        $count = \Yii::$app->request->get('count');

        if (!empty($model)) {
            $query = new Query();
            $provider = new ArrayDataProvider([
                'allModels' => $query->from($model)->all(),
                'pagination' => [
                    'pageSize' => $count,
                ],
            ]);

            $data = $provider->getModels();
            $pageDataCount = $provider->getCount();
        } else {
            $data = '';
            $pageDataCount = '0';
        }

        return $this->render('index', compact('data', 'model', 'count', 'pageDataCount'));
    }


}
