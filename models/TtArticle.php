<?php

namespace article\models;

use common\components\Utility;
use common\models\Article;
use common\models\Image;
use Yii;

/**
 * This is the model class for table "tt_article".
 *
 * @property integer $article_id
 * @property integer $type
 * @property integer $style
 * @property integer $wenda_info
 * @property integer $media_id
 * @property string $cover_ids
 * @property integer $is_hot
 * @property integer $behot_time
 * @property integer $is_stick
 * @property string $label
 * @property integer $bestick_time
 * @property integer $off_stick_time
 */
class TtArticle extends \yii\db\ActiveRecord
{
    const TYPE_VIDEO = 2;
    const TYPE_ARTICLE = 1;
    const STYLE_DEFAULT = 0;
    const TYPE_GALLERY = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tt_article';
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
            [['article_id'], 'required'],
            [['article_id', 'type', 'style', 'wenda_info', 'media_id', 'is_hot', 'behot_time', 'is_stick', 'bestick_time', 'off_stick_time'], 'integer'],
            [['cover_ids', 'label'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'type' => 'Type',
            'style' => 'Style',
            'wenda_info' => 'Wenda Info',
            'media_id' => 'Media ID',
            'cover_ids' => 'Cover Ids',
            'is_hot' => 'Is Hot',
            'behot_time' => 'Behot Time',
            'is_stick' => 'Is Stick',
            'label' => 'Label',
            'bestick_time' => 'Bestick Time',
            'off_stick_time' => 'Off Stick Time',
        ];
    }

    public function getArticle() {
        return $this->hasOne(Article::className(), ['id'=>'article_id']);
    }

    public function getImages() {
        return $this->hasMany(TtArticleImage::className(), ['tt_article_id' => 'article_id']);
    }

    public function getMedia() {
        return $this->hasOne(TtMedia::className(), ['id' => 'media_id']);
    }

    public function getSid() {
        return Utility::sid($this->article_id);
    }

    public function getCoverList() {
        $coverIds = explode(',', $this->cover_ids);
        if (!empty($this->cover_ids)) {
            return Image::find()->where(['in', 'id', $coverIds])->all();
        }
        return null;
    }

   

    public function fields()
    {
        $fields = [
            'article',
//            'media',
//            'images',
//            'type',
//            'style',
//            'coverList',
//            'video',
//            'tags',
        ];
        return $fields;
    }
}
