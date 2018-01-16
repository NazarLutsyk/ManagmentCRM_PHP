<?php

namespace app\models;

use Yii;

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

    public function getCompanyName(){
        return $this->company->name;
    }
}
