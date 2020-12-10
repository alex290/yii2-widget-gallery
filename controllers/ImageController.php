<?php

namespace alex290\widgetgallery\controllers;

use alex290\widgetgallery\models\ImagesGalleryModel;
use Yii;
use yii\web\Controller;

class ImageController extends Controller
{



    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $url = Yii::$app->request->get('url');
        $model = ImagesGalleryModel::findOne($id);

        $modelName = $model->modelName;
        $itemId = $model->itemId;

        $model->removeImages();
        $model->delete();

        $models = ImagesGalleryModel::find()->andWhere(['modelName' => $modelName])->andWhere(['itemId' => $itemId])->orderBy(['weight' => SORT_ASC])->all();
        if (!($models == null)) {
            foreach ($models as $key => $modelItem) {
                $modelItem->weight = $key;
                $modelItem->save();
            }
        }


        return $this->redirect($url);
    }
}
