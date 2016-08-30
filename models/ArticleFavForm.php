<?php
/**
 * Created by PhpStorm.
 * User: cx
 * Date: 2016/7/25
 * Time: 15:23
 */

namespace article\models;


use common\components\Utility;
use yii\base\Model;

class ArticleFavForm extends Model
{
    public $sid;
    private $userId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['sid'], 'required'],
        ];
    }

    public function getId() {
        return Utility::id($this->sid);
    }

    public function fav()
    {
        $this->userId = \Yii::$app->user->identity->id;
        $ttFav = TtArticleFav::find()->where([
            'article_id' => $this->getId(),
            'user_id' => $this->userId,
            'fav' => 1,
        ])->one();
        if (!$ttFav) {
            $ttFav = new TtArticleFav();
            $ttFav->article_id = $this->getId();
            $ttFav->user_id = $this->userId;
            $ttFav->fav = 1;
            $ttFav->time = time();
            if (!$ttFav->save()) {
                $this->addErrors($ttFav->getErrors());
                return false;
            }
            $tCount = TtArticleCount::findOne(['article_id'=>$this->getId()]);
            if (!$tCount) {
                $tCount = new TtArticleCount();
                $tCount->article_id = $this->getId();
                $tCount->fav_count = 1;
                if (!$tCount->save()) {
                    $this->addErrors($tCount->getErrors());
                    return false;
                }
            } else {
                if (!$tCount->updateCounters(['fav_count' => 1])) {
                    $this->addErrors($tCount->getErrors());
                    return false;
                }
            }
        }
        return true;
    }
}