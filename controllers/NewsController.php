<?php
/**
 * Created by PhpStorm.
 * User: cx
 * Date: 2016/8/9
 * Time: 11:59
 */

namespace article\controllers;


use article\models\NewsItem;
use article\models\TtArticle;
use common\components\Utility;
use common\models\Article;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class NewsController extends Controller
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
        $query = NewsItem::find();
        if ($type) {
            $query->where(['type'=>$type]);
        }
        return new ActiveDataProvider([
            'query' => $query->orderBy(["id"=>SORT_DESC])
        ]);
    }


    public function actionView($id)
    {
        return NewsItem::findOne($id);
    }
}