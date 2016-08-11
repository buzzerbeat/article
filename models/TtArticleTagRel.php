<?php

namespace article\models;

use Yii;

/**
 * This is the model class for table "tt_article_tag_rel".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $tag_id
 */
class TtArticleTagRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tt_article_tag_rel';
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
            [[ 'article_id', 'tag_id'], 'required'],
            [[ 'article_id', 'tag_id'], 'integer'],
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
            'tag_id' => 'Tag ID',
        ];
    }
}
