<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CustomerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('post');
    }

}
