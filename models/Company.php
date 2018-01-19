<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $adress
 * @property string $url
 *
 * @property Call[] $calls
 * @property ContactPerson[] $contactPeople
 * @property Status[] $statuses
 * @property Task[] $tasks
 */
class Company extends \yii\db\ActiveRecord
{
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::info('Company created: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        } else {
            Yii::info('Company updated: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Yii::info('Company deleted: ' . Json::encode($this) .
            'Admin:' . Json::encode(Yii::$app->user->identity),
            'my_info_log');
        parent::afterDelete();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'adress', 'url'], 'string', 'max' => 255],
            [['name'], 'required'],
            [['email'], 'email'],
            [['phone'], 'match', 'pattern' => '/^(1[ \-\+]{0,3}|\+1[ -\+]{0,3}|\+1|\+)?((\(\+?1-[2-9][0-9]{1,2}\))|(\(\+?[2-8][0-9][0-9]\))|(\(\+?[1-9][0-9]\))|(\(\+?[17]\))|(\([2-9][2-9]\))|([ \-\.]{0,3}[0-9]{2,4}))?([ \-\.][0-9])?([ \-\.]{0,3}[0-9]{2,4}){2,3}$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'adress' => 'Adress',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalls()
    {
        return $this->hasMany(Call::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactPeople()
    {
        return $this->hasMany(ContactPerson::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatuses()
    {
        return $this->hasMany(Status::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['company_id' => 'id']);
    }
}
