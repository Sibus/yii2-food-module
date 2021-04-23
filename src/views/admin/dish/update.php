<?php

use sibus\food\forms\admin\DishForm;
use sibus\food\models\Dish;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dish Dish */
/* @var $form DishForm */

$this->title = 'Update Dish: ' . $dish->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $dish->name, 'url' => ['view', 'id' => $dish->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $form,
    ]) ?>

</div>
