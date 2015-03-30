<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 20.03.15
 * Time: 7:31
 */

namespace frontend\components;

use yii\base\Widget ;

class FirstWidget extends Widget
{
    public function init() {
        parent::init();
    }

    public function run() {
        return $this->render('first');
    }
}
