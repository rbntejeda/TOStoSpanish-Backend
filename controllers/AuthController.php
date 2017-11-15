<?php 

namespace app\controllers;

use yii;
use app\models\User;

use yii\rest\Controller;
use yii\web\HttpException;

class AuthController extends Controller
{
	public function actionToken()
	{
		$request = Yii::$app->request;
		$user = User::findMultipleMethod($request->post('username'),['username','email'])->one();
		switch ($request->post('grant_type')) {
			case 'password':
				if(empty($user)){
                    throw new HttpException(401, "Error en credenciales. El usuario no existe.");
				}else{
					if(!$user->validatePassword($request->post('password'))){
						throw new HttpException(401, "Error en credenciales. Contraseña invalida.");
					}
				}
				break;		
			default:
                throw new HttpException(405, "Method Not Allowed.");
				break;
		}
		$rememberMe = $request->post('rememberMe',"1 hour");
		$timeOut=3600;
		switch ($rememberMe) {
			case '6 hour':
				$timeOut*=6;
				break;
			case '1 Day':
				$timeOut*=24;
				break;
			case '1 Month':
				$timeOut*=24*30;
				break;
			case 'forever':
				$timeOut=-1;
				break;
		}
		$token = $user->Token($timeOut);
		$Auth=[
			'token'=>$token,
			'token_type'=>'Bearer',
			'expire_in'=>$timeOut
		];
		return $Auth;
	}
}