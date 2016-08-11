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


        return $behaviors;
    }
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        $type = $request->get("type", 0);
        $query = TtArticle::find();
        if ($type) {
            $query->where(['type'=>$type]);
        }
        return new ActiveDataProvider([
            'query' => $query->orderBy(["article_id"=>SORT_DESC])
        ]);
    }


    public function actionView($id)
    {
//        return Article::findOne(Utility::id($sid));
        return Article::findOne($id);
    }
}