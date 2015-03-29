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
//        var_dump(Yii::getAlias('@frontend'));exit;
        $this->layout ='main11';
        return $this->render('index');
    }
}
