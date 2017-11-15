<?php 

namespace app\controllers;

use yii;
use app\models\User;
use app\models\TosBase;

use yii\rest\Controller;
use yii\web\HttpException;

class FileController extends Controller
{
	public function actionIndex()
	{
		foreach(file('myfile.txt') as $line) {
		   echo $line. "\n";
		}
		return ['hola'];
	}
}