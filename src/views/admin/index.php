<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="container">
    <div class="row">
        <main class="col-md-9">
            <div>
                <?= Html::a('Ingredients', ['admin/ingredient/index']) ?>
            </div>
        </main>
    </div>
</div>
