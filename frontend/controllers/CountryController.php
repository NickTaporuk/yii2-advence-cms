<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 29.03.15
 * Time: 21:27
 */

namespace frontend\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use frontend\models\Country;

class CountryController extends Controller {

    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
}