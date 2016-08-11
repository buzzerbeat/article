<?php

namespace article\models;

use common\components\Utility;
use common\models\Video;
use Yii;

/**
 * This is the model class for table "tt_article_video".
 *
 * @property integer $id
 * @property string $tt_video_id
 * @property integer $video_id
 * @property integer $article_id
 * @property integer $create_time
 */
class TtArticleVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tt_article_video';
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
            [['tt_video_id', 'video_id',  'create_time'], 'required'],
            [['video_id', 'article_id', 'create_time'], 'integer'],
            [['tt_video_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tt_video_id' => 'Tt Video ID',
            'video_id' => 'Video ID',
            'article_id' => 'Article ID',
            'create_time' => 'Create Time',
        ];
    }

    public function getSid() {
        return Utility::sid($this->id);
    }
    public function getVideo() {
        return $this->hasOne(Video::className(), ['id'=>'video_id']);
    }
    public function fields()
    {
        $fields = [
            'sid',
            'video',
            'create_time',
          
        ];
        return $fields;
    }
}
