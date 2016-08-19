<?php

namespace article\models;

use common\components\Utility;
use common\models\Image;
use Yii;

/**
 * This is the model class for table "tt_media".
 *
 * @property integer $id
 * @property integer $tt_media_id
 * @property string $name
 * @property integer $avatar
 * @property string $description
 */
class TtMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tt_media';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('atDb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tt_media_id', 'name', 'avatar', 'description'], 'required'],
            [['tt_media_id', 'avatar'], 'integer'],
            [['description'], 'string'],
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
            'tt_media_id' => 'Tt Media ID',
            'name' => 'Name',
            'avatar' => 'Avatar',
            'description' => 'Description',
        ];
    }

    public function getSid() {
        return Utility::sid($this->id);
    }

    public function fields()
    {
        $fields = [
            'name',
            'avatar'=>function($model) {
                return Image::findOne($model->avatar);
            },
        ];
        return $fields;
    }
}
