<?php

namespace frontend\modules\znakomster\controllers;

use yii\web\Controller;
use yii;
use yii\helpers\Url;

class DefaultController extends Controller
{
    public function actionIndex()
    {
//        ECHO Yii::$app->homeUrl;
//        ECHO Url::base();
//        EXIT;
        $this->layout ='main11';
        return $this->render('index');
    }
}
