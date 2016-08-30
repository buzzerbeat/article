<?php
/**
 * Created by PhpStorm.
 * User: cx
 * Date: 2016/8/9
 * Time: 11:59
 */

namespace article\controllers;


use article\models\TtArticle;
use common\components\Utility;
use common\models\Article;
use article\models\ArticleFavForm;
use article\models\ArticleLikeForm;
use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class ArticleController extends Controller
{


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];


        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['fav',  'like', 'fav-list', 'like-list'],
        ];


        return $behaviors;
    }
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        $type = $request->get("type", 0);
        $query = Article::find();
        if ($type) {
            $query->where(['type'=>$type]);
        }
        return new ActiveDataProvider([
            'query' => $query->orderBy(["id"=>SORT_DESC])
        ]);
    }


    public function actionView($sid)
    {
        return Article::findOne(Utility::id($sid));
    }


    public function actionFavList() {
        $user = \Yii::$app->user->identity;
        $idArr =  TtArticle::find()
            ->leftJoin('tt_article_fav', '`tt_article_fav`.`article_id` = `tt_article`.`article_id`')
            ->where([
                '`tt_article_fav`.`user_id`' => $user->id,
            ])->select("`tt_article`.article_id")->asArray()->column();
        $query = Article::find()->where(['in', 'id', $idArr]);
        if (!empty($idArr)) {
            $query = $query->orderBy([new Expression('FIELD (id, ' . implode(',' , $idArr) .')')]);
        }
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

    public function actionLikeList() {
        $user = \Yii::$app->user->identity;
        $idArr =  TtArticle::find()
            ->leftJoin('tt_article_like', '`tt_article_like`.`article_id` = `tt_article`.`article_id`')
            ->where([
                '`tt_article_like`.`user_id`' => $user->id,
            ])
            ->select("`tt_article`.article_id")->asArray()->column();
        $query = Article::find()->where(['in', 'id', $idArr]);
        if (!empty($idArr)) {
            $query = $query->orderBy([new Expression('FIELD (id, ' . implode(',' , $idArr) .')')]);
        }
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }



    public function actionLike()
    {
        $likeForm = new ArticleLikeForm();
        if ($likeForm->load(Yii::$app->getRequest()->post(), '') && $likeForm->like()) {
            return ["status"=>0, "message"=>""];
        }
        return ["status"=>1, "message"=>implode(",", $likeForm->getFirstErrors())];
    }

    public function actionFav()
    {
        $favForm = new ArticleFavForm();
        if ($favForm->load(Yii::$app->getRequest()->post(), '') && $favForm->fav()) {
            return ["status"=>0, "message"=>""];
        }
        return ["status"=>1, "message"=>implode(",", $favForm->getFirstErrors())];

    }
}