<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "contactPerson".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $position
 * @property string $phone
 * @property string $email
 * @property int $company_id
 *
 * @property Company $company
 */
class ContactPerson extends \yii\db\ActiveRecord
{
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::info('Contact Person created: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        } else {
            Yii::info('Contact Person updated: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Yii::info('Contact Person deleted: ' . Json::encode($this) .
            'Admin:' . Json::encode(Yii::$app->user->identity),
            'my_info_log');
        parent::afterDelete();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contactPerson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['phone'], 'match', 'pattern' => '/^(1[ \-\+]{0,3}|\+1[ -\+]{0,3}|\+1|\+)?((\(\+?1-[2-9][0-9]{1,2}\))|(\(\+?[2-8][0-9][0-9]\))|(\(\+?[1-9][0-9]\))|(\(\+?[17]\))|(\([2-9][2-9]\))|([ \-\.]{0,3}[0-9]{2,4}))?([ \-\.][0-9])?([ \-\.]{0,3}[0-9]{2,4}){2,3}$/'],
            [['email'],'email'],
            [['name','surname','phone'], 'required'],
            [['name', 'surname', 'position', 'phone', 'email'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'surname' => 'Surname',
            'position' => 'Position',
            'phone' => 'Phone',
            'email' => 'Email',
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

    public function getFullName(){
        return $this->name.' '.$this->surname;
    }
}
