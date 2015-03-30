<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 20.03.15
 * Time: 7:31
 */

namespace frontend\components;

use yii\base\Widget ;

class SecondWidget extends Widget
{
    public function init() {
        parent::init();
        ob_start();
    }

    public function run() {
        $content = ob_get_clean();
//        var_dump($content);
        return $this->render('second',['content'=>$content]);
    }
}
