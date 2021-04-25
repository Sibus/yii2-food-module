<?php

namespace sibus\food\controllers;

use sibus\food\finders\DishFinder;
use sibus\food\models\Dish;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Default controller for the `food` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DishFinder();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
