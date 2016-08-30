<?php

namespace article\models;

use Yii;

/**
 * This is the model class for table "tt_article_like".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $user_id
 * @property integer $like
 * @property integer $time
 */
class TtArticleLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tt_article_like';
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
            [['article_id', 'user_id', 'like', 'time'], 'required'],
            [['article_id', 'user_id', 'like', 'time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'user_id' => 'User ID',
            'like' => 'Like',
            'time' => 'Time',
        ];
    }
}
