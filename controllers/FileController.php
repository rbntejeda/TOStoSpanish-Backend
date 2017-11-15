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
		$config=json_decode('[{"id":1,"name":"ETC","split":19},{"id":2,"name":"INTL","split":20},{"id":3,"name":"ITEM","split":20},{"id":4,"name":"QUEST","split":21},{"id":5,"name":"QUEST_JOBSTEP","split":29},{"id":6,"name":"QUEST_LV_0100","split":29},{"id":7,"name":"QUEST_LV_0200","split":29},{"id":8,"name":"QUEST_LV_0300","split":29},{"id":9,"name":"QUEST_LV_0400","split":29},{"id":10,"name":"QUEST_UNUSED","split":28},{"id":11,"name":"SKILL","split":21},{"id":12,"name":"UI","split":18}]');
		foreach ($config as $file) 
		{
			foreach(file(Yii::getAlias("@data/$file->name.tsv")) as $line)
			{
				print_r($line);
				$header=substr($line, 0, $file->split);
				$body=substr($line, $file->split+1,strlen($line)-1);
				print_r($header);
				print_r($body);
				$model=new TosBase();
				$model->attributes=[
					'file_id'=>$file->id,
					'header'=>$header,
					'body'=>$body
				];
				if(!$model->save())
				{
					return $model;
				}
			}
		}
		return "Exito!";
	}
}