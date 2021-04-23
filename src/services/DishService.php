<?php

namespace sibus\food\services;

use sibus\food\forms\admin\DishForm;
use sibus\food\models\Dish;
use sibus\food\models\Ingredient;

class DishService
{
    public function create(DishForm $form)
    {
        $dish = new Dish();
        $dish->name = $form->name;

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $dish->save();
            foreach ($form->ingredients as $ingredientId) {
                $ingredient = Ingredient::findOne($ingredientId);
                $dish->link('ingredients', $ingredient);
            }
            $transaction->commit();
            return $dish;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function update(int $id, DishForm $form)
    {
        $dish = Dish::findOne($id);
        $dish->name = $form->name;

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $dish->save();
            $dish->unlinkAll('ingredients', true);
            foreach ($form->ingredients as $ingredientId) {
                $ingredient = Ingredient::findOne($ingredientId);
                $dish->link('ingredients', $ingredient);
            }
            $transaction->commit();
            return $dish;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}