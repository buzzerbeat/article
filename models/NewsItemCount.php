<?php

namespace article\models;

use Yii;

/**
 * This is the model class for table "news_item_count".
 *
 * @property integer $news_item_id
 * @property integer $like_count
 * @property integer $read_count
 * @property integer $dig_count
 * @property integer $bury_count
 * @property integer $comment_count
 */
class NewsItemCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_item_count';
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
            [['news_item_id', 'like_count', 'read_count', 'dig_count', 'bury_count', 'comment_count'], 'required'],
            [['news_item_id', 'like_count', 'read_count', 'dig_count', 'bury_count', 'comment_count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_item_id' => 'News Item ID',
            'like_count' => 'Like Count',
            'read_count' => 'Read Count',
            'dig_count' => 'Dig Count',
            'bury_count' => 'Bury Count',
            'comment_count' => 'Comment Count',
        ];
    }
}
