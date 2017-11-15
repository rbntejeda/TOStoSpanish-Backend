<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tos_base".
 *
 * @property integer $id
 * @property integer $file_id
 * @property string $header
 * @property string $body
 * @property string $status
 * @property string $creado
 * @property string $modificado
 *
 * @property TosFile $file
 * @property TosTranslate[] $tosTranslates
 * @property User[] $users
 */
class TosBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tos_base';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_id', 'header'], 'required'],
            [['file_id'], 'integer'],
            [['body', 'status'], 'string'],
            [['creado', 'modificado'], 'safe'],
            [['header'], 'string', 'max' => 30],
            // [['header'], 'unique'],
            // [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => TosFile::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => 'File ID',
            'header' => 'Header',
            'body' => 'Body',
            'status' => 'Status',
            'creado' => 'Creado',
            'modificado' => 'Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(TosFile::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTosTranslates()
    {
        return $this->hasMany(TosTranslate::className(), ['base_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('tos_translate', ['base_id' => 'id']);
    }
}
