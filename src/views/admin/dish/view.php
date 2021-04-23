<?php

use sibus\food\models\Dish;
use sibus\food\models\Ingredient;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model sibus\food\models\Dish */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="dish-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'ingredients',
                'format' => 'raw',
                'value' => function (Dish $dish) {
                    return array_reduce(
                        $dish->getIngredients()->all(),
                        function ($result, Ingredient $ingredient) {
                            $name = Html::encode($ingredient->getNameWithVisibilityMark());

                            return $result . "<span style='display: block;'>{$name}</span>";
                        },
                        ''
                    );
                },
            ],
        ],
    ]) ?>

</div>
