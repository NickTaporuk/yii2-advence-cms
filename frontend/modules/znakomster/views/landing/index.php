<?php
use frontend\components\FirstWidget;
use frontend\components\SecondWidget;
use yii\bootstrap\Modal;
use yii\bootstrap\Carousel;
use yii\bootstrap\Dropdown;
use yii\jui\DatePicker;
?>
<div class="znakomster-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>

<?=FirstWidget::widget();?>

<?php SecondWidget::begin();?>
    Красный текст
<?php SecondWidget::end();?>

<?php Modal::begin([
'header' => '<h2>Hello world</h2>',
'toggleButton' => ['label' => 'click me'],
]);

echo 'Say hello...';

Modal::end();?>

<?php
echo Carousel::widget([
    'items' => [
        // the item contains only the image
        '<img src="http://s.fishki.net/upload/post/201412/06/1343339/1_03.jpg"/>',
        // equivalent to the above
        ['content' => '<img src="http://s.fishki.net/upload/post/201412/06/1343339/1_03.jpg"/>'],
        // the item contains both the image and the caption
        [
            'content' => '<img src="http://s.fishki.net/upload/post/201412/06/1343339/1_03.jpg"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
        ],
    ]
]);
?>

<div class="dropdown">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Label <b class="caret"></b></a>
    <?php
    echo Dropdown::widget([
        'items' => [
            ['label' => 'DropdownA', 'url' => '/'],
            ['label' => 'DropdownB', 'url' => '#'],
        ],
    ]);
    ?>
</div>

<?php echo DatePicker::widget([
//'model' => $model,
    'name'=>'tests',
    'attribute' => 'from_date',
//'language' => 'ru',
//'dateFormat' => 'yyyy-MM-dd',
]);?>