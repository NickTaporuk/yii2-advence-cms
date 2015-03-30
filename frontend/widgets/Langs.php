<?php
namespace frontend\widgets;
use frontend\models\Lang;

class Langs extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('langs/view', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])->all(),
        ]);
    }
}