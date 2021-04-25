<?php

use sibus\food\finders\DishFinder;
use sibus\food\models\Dish;
use sibus\food\models\Ingredient;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel DishFinder */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dishes';
$ingredients = ArrayHelper::merge(['' => ''], $searchModel->getIngredientList());
?>
<div class="food-default-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <div class="card">
                    <div class="filter-group">
                        <div class="card-header">Ingredients</div>
                        <div class="filter-content">
                            <div class="card-body">

                                <?php $form = ActiveForm::begin(['method' => 'GET']); ?>

                                <?= $form->field($searchModel, 'ingredient_1')->dropDownList($ingredients)->label(false) ?>
                                <?= $form->field($searchModel, 'ingredient_2')->dropDownList($ingredients)->label(false) ?>
                                <?= $form->field($searchModel, 'ingredient_3')->dropDownList($ingredients)->label(false) ?>
                                <?= $form->field($searchModel, 'ingredient_4')->dropDownList($ingredients)->label(false) ?>
                                <?= $form->field($searchModel, 'ingredient_5')->dropDownList($ingredients)->label(false) ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Find', ['class' => 'btn btn-success']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <main class="col-md-9">
                <?= GridView::widget([
                    'filterModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'name',
                        [
                            'attribute' => 'ingredients',
                            'format' => 'raw',
                            'value' => function (Dish $dish) use ($searchModel) {
                                return array_reduce(
                                    $dish->getIngredients()->all(),
                                    function (string $result, Ingredient $ingredient) use ($searchModel) {
                                        $name = Html::encode($ingredient->name);
                                        if ($searchModel->looksFor($ingredient->id)) {
                                            $name = "<span style='font-weight: bold;'>{$name}</span>";
                                        }

                                        return $result . "<span style='display: block;'>{$name}</span>";
                                    },
                                ''
                                );
                            },
                        ],
                    ],
                ]) ?>
            </main>
        </div>
    </div>

</div>
