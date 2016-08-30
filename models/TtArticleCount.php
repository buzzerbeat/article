<?php

namespace article\models;

use Yii;

/**
 * This is the model class for table "tt_article_count".
 *
 * @property integer $article_id
 * @property integer $like_count
 * @property integer $comment_count
 * @property integer $read_count
 * @property integer $bury_count
 * @property integer $dig_count
 * @property integer $fav_count
 */
class TtArticleCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tt_article_count';
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
            [['article_id', 'like_count', 'comment_count', 'read_count', 'bury_count', 'dig_count', 'fav_count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'like_count' => 'Like Count',
            'comment_count' => 'Comment Count',
            'read_count' => 'Read Count',
            'bury_count' => 'Bury Count',
            'dig_count' => 'Dig Count',
            'fav_count' => 'Fav Count',
        ];
    }


    public function fields()
    {
        $fields = [
            'like_count',
            'comment_count',
            'read_count',
            'bury_count',
            'dig_count',
            'fav_count',
        ];
        return $fields;
    }
}
