<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $value
 * @property int $company_id
 *
 * @property OfferStatus[] $offerStatuses
 * @property Company $company
 */
class Status extends \yii\db\ActiveRecord
{
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::info('Status created: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        } else {
            Yii::info('Status updated: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Yii::info('Status deleted: ' . Json::encode($this) .
            'Admin:' . Json::encode(Yii::$app->user->identity),
            'my_info_log');
        parent::afterDelete();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['value'], 'required'],
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
            'value' => 'Value',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfferStatuses()
    {
        return $this->hasMany(OfferStatus::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    public function getOffers(){
        return Offer::find()
            ->innerJoin("offerStatus",'offer.id=offerStatus.offer_id')
            ->innerJoin("status",'offerStatus.status_id=status.id')
            ->where("status_id=:id", array(':id' => $this->id));
    }

}
