<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $description
 * @property string $dateExec
 * @property int $checked
 * @property int $company_id
 *
 * @property Company $company
 */
class Task extends \yii\db\ActiveRecord
{
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::info('Task created: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        } else {
            Yii::info('Task updated: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Yii::info('Task deleted: ' . Json::encode($this) .
            'Admin:' . Json::encode(Yii::$app->user->identity),
            'my_info_log');
        parent::afterDelete();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            if (empty($this->checked))
                $this->checked = 0;
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dateExec'], 'safe'],
            [['dateExec'], 'required'],
            [['checked', 'company_id'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'dateExec' => 'Date Exec',
            'checked' => 'Checked',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    public function getCompanyname(){
        return $this->company->name;
    }
}
