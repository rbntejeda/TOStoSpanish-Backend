<?php 

namespace app\controllers;

use yii;
use app\models\User;

use yii\rest\Controller;
use yii\web\HttpException;

class SiteController extends Controller
{
	public function actionIndex()
	{
		return "It's Works!";
	}

	public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}