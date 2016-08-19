<?php

namespace article\models;

use common\components\Utility;
use common\models\Article;
use common\models\Image;
use Yii;

/**
 * This is the model class for table "news_item".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $type
 * @property integer $style
 * @property integer $relation_id
 * @property string $title
 * @property string $abstract
 * @property integer $pub_time
 * @property string $link
 * @property string $cover_ids
 * @property integer $source
 * @property integer $media
 * @property integer $is_hot
 * @property integer $is_stick
 * @property integer $be_hot_time
 * @property integer $on_stick_time
 * @property integer $off_stick_time
 * @property string $label
 */
class NewsItem extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_item';
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
            [['status', 'type', 'style', 'relation_id', 'title',  'pub_time', ], 'required'],
            [['media','status', 'type', 'style', 'relation_id', 'pub_time',  'can_delete', 'is_hot', 'is_stick', 'be_hot_time', 'on_stick_time', 'off_stick_time'], 'integer'],
            [[ 'link'], 'string'],
            [['title', 'abstract'], 'string', 'max' => 1024],
            [['cover_ids'], 'string', 'max' => 255],
            [['label'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'type' => 'Type',
            'style' => 'Style',
            'relation_id' => 'Relation ID',
            'title' => 'Title',
            'abstract' => 'Abstract',
            'pub_time' => 'Pub Time',
            'link' => 'Link',
            'cover_ids' => 'Cover Ids',
            'media' => 'Media',
            'is_hot' => 'Is Hot',
            'can_delete' => 'Can Delete',
            'is_stick' => 'Is Stick',
            'be_hot_time' => 'Be Hot Time',
            'on_stick_time' => 'On Stick Time',
            'off_stick_time' => 'Off Stick Time',
            'label' => 'Label',
        ];
    }

    /**
     * @param TtArticle $ttArticle
     * @return bool
     */
    public function recommend($ttArticle) {
        $this->setAttributes(
            [
                'status'=>self::STATUS_ACTIVE,
                'title'=>$ttArticle->article->title,
                'type' => $ttArticle->type,
                'style' => $ttArticle->style,
                'relation_id'=>$ttArticle->article_id,
                'abstract'=>$ttArticle->article->abstract,
                'pub_time'=>$ttArticle->article->pub_time,
                'cover_ids'=>$ttArticle->cover_ids,
                'link'=>$ttArticle->article->src_link,
                'media'=>$ttArticle->media_id,
            ], false
        );
        if (!$this->save()) {
            return false;
        }
        $ttArticleCount = $ttArticle->article->countInfo;
        if (!empty($ttArticleCount)) {
            $nItemCount = NewsItemCount::findOne(['news_item_id'=>$this->id]);
            if (empty($nItemCount)) {
                $nItemCount = new NewsItemCount();
                $nItemCount->news_item_id = $this->id;
                $nItemCount->like_count = $ttArticleCount->like_count;
                $nItemCount->comment_count = $ttArticleCount->comment_count;
                $nItemCount->dig_count = $ttArticleCount->dig_count;
                $nItemCount->bury_count = $ttArticleCount->bury_count;
                $nItemCount->read_count = $ttArticleCount->read_count;
                if (!$nItemCount->save()) {
                    $this->addErrors($nItemCount->getErrors());
                }
            }
        }
        return true;
    }

    public function getSid() {
        return Utility::sid($this->id);
    }

    public function getRelSid() {
        return Utility::sid($this->relation_id);
    }
    public function getTags() {
        if (in_array($this->type, [TtArticle::TYPE_GALLERY, TtArticle::TYPE_VIDEO, TtArticle::TYPE_ARTICLE])) {
            $article = Article::findOne($this->relation_id);
            if (!empty($article)) {
                return $article->tags;
            }
        }
        return null;
    }
    public function getImageCount() {
        if ($this->type == TtArticle::TYPE_GALLERY) {
            return TtArticleImage::find()->where(['tt_article_id'=>$this->relation_id])->count();
        }
        return null;
    }

    public function getLabelInfo() {
        if (empty($this->label)) {
            $labelArr = [];
        } else {
            $labelArr = explode(',', $this->label);
        }
        if (in_array($this->type, [TtArticle::TYPE_GALLERY, TtArticle::TYPE_VIDEO, TtArticle::TYPE_AD])) {
            if (!in_array(TtArticle::TYPE_DICT[$this->type], $labelArr)) {
                array_unshift($labelArr, TtArticle::TYPE_DICT[$this->type]);
            }
        }
        if (!empty($labelArr)) {
            return implode(',', $labelArr);
        } else {
            return '';
        }

    }

    public function getVideoInfo() {
        if ($this->type == TtArticle::TYPE_VIDEO) {
            return TtArticleVideo::findOne(['article_id'=>$this->relation_id]);
        }
        return null;
    }
    public function getCoverList() {
        if (!empty($this->cover_ids)) {
            $coverIds = explode(',', $this->cover_ids);
            if (!empty($coverIds)) {
                return Image::find()->where(['in', 'id', $coverIds])->all();
            }
        }
        return null;
    }

    public function getMediaInfo() {
        return $this->hasOne(TtMedia::className(), ['id' => 'media']);
    }

    public function getNItemCount() {
        return $this->hasOne(NewsItemCount::className(), ['news_item_id' => 'id']);
    }

    public function getLikeCount() {
        if (!empty($this->nItemCount)) {
            return $this->nItemCount->like_count;
        }
        return null;
    }

    public function getCommentCount() {
        if (!empty($this->nItemCount)) {
            return $this->nItemCount->comment_count;
        }
        return null;
    }

    public function getPubTime() {
        return Utility::time_get_past($this->pub_time);
    }



    public function fields()
    {
        $fields = [
            'sid',
            'relSid',
            'type',
            'style',
            'title',
            'abstract',
            'pubTime',
            'media' => 'mediaInfo',
            'can_delete',
            'link',
            'thumbs'=>'coverList',
            'is_hot',
            'is_stick',
            'be_hot_time',
            'label' => 'labelInfo',
            'like_count'=>'likeCount',
            'comment_count'=>'commentCount',
            'image_count'=>'imageCount',
            'video_info'=>'videoInfo',
            'tags',
        ];
        return $fields;
    }
}
