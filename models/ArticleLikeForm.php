<?php
/**
 * Created by PhpStorm.
 * User: cx
 * Date: 2016/7/25
 * Time: 15:23
 */

namespace article\models;


use article\models\TtArticleCount;
use article\models\TtArticleLike;
use common\components\Utility;
use yii\base\Model;

class ArticleLikeForm extends Model
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

    public function like()
    {
        $this->userId = \Yii::$app->user->identity->id;
        $ttLike = TtArticleLike::find()->where([
            'article_id' => $this->getId(),
            'user_id' => $this->userId,
            'like' => 1,
        ])->one();
        if (!$ttLike) {
            $ttLike = new TtArticleLike();
            $ttLike->article_id = $this->getId();
            $ttLike->user_id = $this->userId;
            $ttLike->like = 1;
            $ttLike->time = time();
            if (!$ttLike->save()) {
                $this->addErrors($ttLike->getErrors());
                return false;
            }

            $tCount = TtArticleCount::findOne(['article_id'=>$this->getId()]);
            if (!$tCount) {
                $tCount = new TtArticleCount();
                $tCount->article_id = $this->getId();
                $tCount->like_count = 1;
                if (!$tCount->save()) {
                    $this->addErrors($tCount->getErrors());
                    return false;
                }
            } else {
                if (!$tCount->updateCounters(['like_count' => 1])) {
                    $this->addErrors($tCount->getErrors());
                    return false;
                }
            }
        }
        return true;
    }
}