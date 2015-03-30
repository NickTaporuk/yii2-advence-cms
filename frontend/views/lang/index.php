<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use frontend\widgets\Langs;
use frontend\components\SecondWidget;

$this->title = Yii::t('app', 'Langs');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php SecondWidget::begin()?>
dshkjvgwejygvjweuvbwej
<?php SecondWidget::end()?>
<?//=var_dump(Yii::$app->response)?>
<?= Langs::widget();?>

<?=Yii::t('main','blog')?>

<div class="lang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Lang'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'local',
            'name',
            'default',
            // 'date_update',
            // 'date_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
