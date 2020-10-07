<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p> <a class="btn btn-lg btn-success" href="<?=Url::to(['apple/index'])?>">Get started with Apples</a></p>
    </div>
</div>
