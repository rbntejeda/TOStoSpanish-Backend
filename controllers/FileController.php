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
		// $config=json_decode('[{"id":1,"name":"ETC","split":19},{"id":2,"name":"INTL","split":20},{"id":3,"name":"ITEM","split":20},{"id":4,"name":"QUEST","split":21},{"id":5,"name":"QUEST_JOBSTEP","split":29},{"id":6,"name":"QUEST_LV_0100","split":29},{"id":7,"name":"QUEST_LV_0200","split":29},{"id":8,"name":"QUEST_LV_0300","split":29},{"id":9,"name":"QUEST_LV_0400","split":29},{"id":10,"name":"QUEST_UNUSED","split":28},{"id":11,"name":"SKILL","split":21},{"id":12,"name":"UI","split":18}]');
		// $file=$config[12];
		// // foreach ($config as $file) 
		// // {
		// 	$i=0;
		// 	$model=array();
		// 	$connection=Yii::$app->db;
		// 	foreach(file(Yii::getAlias("@data/$file->name.tsv")) as $line)
		// 	{
		// 		$header=substr($line, 0, $file->split);
		// 		$body=substr($line, $file->split+1,strlen($line)-1);
		// 		$model[]=[$file->id,$header,$body!==false?$body:null];
		// 		$i++;
		// 		if($i===500)
		// 		{
		// 			$data=$connection->createCommand()->batchInsert('tos_base', ['file_id', 'header', 'body'],$model )->execute();
		// 			$i=0;
		// 			$model=array();
		// 		}
		// 	}
		// 	if(!empty($model))
		// 	{
		// 		$connection->createCommand()->batchInsert('tos_base', ['file_id', 'header', 'body'], $model)->execute();
		// 	}
		// // }
		// return "Exito!";
	}
}