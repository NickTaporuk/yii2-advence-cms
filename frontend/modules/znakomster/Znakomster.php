<?php

namespace frontend\modules\znakomster;

class Znakomster extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\znakomster\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
//        \Yii::configure($this, require(__DIR__ . '/config.php'));
        /*$this->modules = [
            'admin' => [
                // you should consider using a shorter namespace here!
                'class' => 'app\modules\forum\modules\admin\Module',
            ],
        ];*/
    }
}
