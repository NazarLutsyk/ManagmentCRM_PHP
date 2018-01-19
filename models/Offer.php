<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "offer".
 *
 * @property int $id
 * @property string $name
 *
 * @property OfferStatus[] $offerStatuses
 */
class Offer extends \yii\db\ActiveRecord
{
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            Yii::info('Offer created: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        } else {
            Yii::info('Offer updated: ' . Json::encode($this) .
                'Admin:' . Json::encode(Yii::$app->user->identity),
                'my_info_log');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Yii::info('Offer deleted: ' . Json::encode($this) .
            'Admin:' . Json::encode(Yii::$app->user->identity),
            'my_info_log');
        parent::afterDelete();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfferStatuses()
    {
        return $this->hasMany(OfferStatus::className(), ['offer_id' => 'id']);
    }
}
