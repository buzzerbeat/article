<?php

namespace article\models;

use common\components\Utility;
use Yii;

/**
 * This is the model class for table "tt_article_tag".
 *
 * @property integer $id
 * @property integer $name
 */
class TtArticleTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tt_article_tag';
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
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getSid() {
        return Utility::sid($this->id);
    }


    public function fields()
    {
        $fields = [
            'sid',
            'name',
        ];
        return $fields;
    }
}
