<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 29.03.15
 * Time: 21:42
 */

namespace frontend\controllers;

use yii;
use yii\rest\ActiveController;

class RestController extends ActiveController {

    public $modelClass = 'frontend\models\Country';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actionTests()
    {

        $params=$_REQUEST;
//        $filter=array();
//        $sort="";
//
//        $page=1;
//        $limit=10;
//
//        if(isset($params['page']))
//            $page=$params['page'];
//
//
//        if(isset($params['limit']))
//            $limit=$params['limit'];
//
//        $offset=$limit*($page-1);
//
//
//        /* Filter elements */
//        if(isset($params['filter']))
//        {
//            $filter=(array)json_decode($params['filter']);
//        }
//
//        if(isset($params['datefilter']))
//        {
//            $datefilter=(array)json_decode($params['datefilter']);
//        }
//
//
//        if(isset($params['sort']))
//        {
//            $sort=$params['sort'];
//            if(isset($params['order']))
//            {
//                if($params['order']=="false")
//                    $sort.=" desc";
//                else
//                    $sort.=" asc";
//
//            }
//        }
//
//
//        $query=new Query;
//        $query->offset($offset)
//            ->limit($limit)
//            ->from('user')
//            ->andFilterWhere(['like', 'id', $filter['id']])
//            ->andFilterWhere(['like', 'name', $filter['name']])
//            ->andFilterWhere(['like', 'age', $filter['age']])
//            ->orderBy($sort)
//            ->select("id,name,age,createdAt,updatedAt");
//
//        if($datefilter['from'])
//        {
//            $query->andWhere("createdAt >= '".$datefilter['from']."' ");
//        }
//        if($datefilter['to'])
//        {
//            $query->andWhere("createdAt <= '".$datefilter['to']."'");
//        }
//        $command = $query->createCommand();
//        $models = $command->queryAll();
//
//        $totalItems=$query->count();
//
//        $this->setHeader(200);
//
//        echo json_encode(array('status'=>1,'data'=>$models,'totalItems'=>$totalItems),JSON_PRETTY_PRINT);
//        echo json_encode($params,JSON_PRETTY_PRINT);
        $str ='';
//        echo json_encode($_SERVhttp_get_request_headersER['HTTP_AUTHENTICATION'],JSON_PRETTY_PRINT);
        echo json_encode(http_get_request_headers(),JSON_PRETTY_PRINT);
//        echo json_encode(Yii::$app->getRequest()->getMethod(),JSON_PRETTY_PRINT);

    }


}