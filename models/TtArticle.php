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
 * @property Article $article
 */
class TtArticle extends \yii\db\ActiveRecord
{

    const TYPE_ARTICLE = 1;
    const TYPE_GALLERY = 2;
    const TYPE_VIDEO = 3;
    const TYPE_AD = 5;
    const TYPE_WEB_VIEW = 6;
    const STYLE_DEFAULT = 0;
    const STYLE_MULTI_THUMBS = 3;
    const STYLE_LARGE_THUMB = 11;
    const STYLE_THUMB = 1;
    const STYLE_NO_THUMB = 2;

    const TYPE_DICT = [
        self::TYPE_ARTICLE => "新闻",
        self::TYPE_GALLERY => "图片",
        self::TYPE_VIDEO => "视频",
        self::TYPE_AD => "推广",
        self::TYPE_WEB_VIEW => "链接",
    ];

    const STYLE_DICT = [
        self::STYLE_DEFAULT => "默认",
        self::STYLE_THUMB => "单图",
        self::STYLE_NO_THUMB => "无图",
        self::STYLE_LARGE_THUMB => "大图",
        self::STYLE_MULTI_THUMBS => "多图",
    ];

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
            [['article_id', 'type', 'style', 'media_id'], 'integer'],
            [['cover_ids'], 'string', 'max' => 64],
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
            'media_id' => 'Media ID',
            'cover_ids' => 'Cover Ids',
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
