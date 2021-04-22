<?php

namespace sibus\food\controllers;

use yii\web\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
