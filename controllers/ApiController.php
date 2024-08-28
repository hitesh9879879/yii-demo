<?php

namespace app\controllers;

use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\httpclient\Client;

class ApiController extends \yii\web\Controller
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
                        'roles' => ['admin', 'user'],
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
        $date = \Yii::$app->request->get('date', '28-08-2024');
        $title = \Yii::$app->request->get('title', 'tesla');
        $apiKey = '59772770dab64f8f971173fe8e30292c';
        $client = new Client(['baseUrl' => 'https://newsapi.org/v2']);

        $pageSize = 4;
        $page = \Yii::$app->request->get('page', 1);
        $offset = ($page - 1) * $pageSize;

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('everything')
            ->addHeaders(['User-Agent' => 'Yii2-HttpClient/1.0'])
            ->setData([
                'q' => $title,
                'from' => $date,
                'sortBy' => 'publishedAt',
                'pageSize' => $pageSize,
                'page' => $page,
                'apiKey' => $apiKey,
            ])
            ->send();

        if ($response->isOk) {
            $data = $response->data;
            $totalCount = isset($data['totalResults']) ? $data['totalResults'] : 0;

            $pagination = new Pagination([
                'defaultPageSize' => $pageSize,
                'totalCount' => $totalCount,
            ]);

            return $this->render('index', [
                'articles' => $data['articles'],
                'pagination' => $pagination,
                'title' => $title,
                'date' => $date
            ]);
        } else {
            throw new \yii\web\HttpException(500, 'Error fetching news data: ' . $response->content);
        }
    }

    public function PostApiData()
    {
        dd('Set Api Data Function!');

        $model = \Yii::$app->request->get('model');

        if (!empty($model)) {
            $tableName = \Yii::$app->db->quoteTableName($model);
            $data = \Yii::$app->db->createCommand('SELECT * FROM ' . $tableName)->queryAll();
        } else {
            $data = ['status' => 'error', 'message' => 'Please select model to get data!!'];
        }

        dd($data);
    }

    public function actionGetApiData()
    {
        $model = \Yii::$app->request->get('model', '');

        if (!empty($model)) {
            $tableName = \Yii::$app->db->quoteTableName($model);
            $data = ['status' => 'success', 'message' => 'Data successfully fetch from ' . $model . ' Table.', 'data' => \Yii::$app->db->createCommand('SELECT * FROM ' . $tableName)->queryAll()];
        } else {
            $data = ['status' => 'error', 'message' => 'Please select model to get data!!', 'data' => ''];
        }

        return json_encode($data);
    }

}
