<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 23.02.15
 * Time: 23:39
 */

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class UserController extends Controller {

    public function actionIndex()
    {
        print_r('<pre>');
//        var_dump(Yii::$app->getRequest());
//        var_dump(Yii::$app->requestedAction());
        print_r('</pre>');
        return $this->render('index');
    }
}