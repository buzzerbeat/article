<?php

namespace article\models;

use common\components\Utility;
use common\models\Image;
use Yii;

/**
 * This is the model class for table "tt_article_image".
 *
 * @property integer $image_id
 * @property integer $tt_article_id
 * @property string $sub_title
 * @property string $sub_abstract
 * @property integer $index
 * @property string $tt_uri
 * @property integer $is_thumb
 * @property integer $mode
 */
class TtArticleImage extends \yii\db\ActiveRecord
{
    const MODE_GALLERY = 1;
    const MODE_DEFAULT = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tt_article_image';
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
            [[ 'image_id',  'tt_uri'], 'required'],
            [[ 'image_id', 'tt_article_id', 'index',  'mode', 'is_thumb'], 'integer'],
            [['tt_uri'], 'string', 'max' => 1024],
            [['sub_title', 'sub_abstract'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'tt_article_id' => 'Tt Article ID',
            'index' => 'Index',
            'tt_uri' => 'Tt Uri',
            'sub_title' => 'Sub Title',
            'sub_abstract' => 'Sub Abstract',
            'is_thumb' => 'Is Thumb',
            'mode' => 'Mode',
        ];
    }
    public function getImg() {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
    public function getSid() {
        return Utility::sid($this->id);
    }

    public function fields()
    {
        $fields = [
            'index',
            'image'=>'img',
            'tt_uri',
            'sub_title',
            'sub_abstract',
        ];
        return $fields;
    }
}
