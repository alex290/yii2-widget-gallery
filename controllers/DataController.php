<?php

namespace alex290\widgetgallery\controllers;

use alex290\widgetgallery\models\ImagesGalleryModel;
use yii\helpers\Json;
use yii\web\Controller;

class DataController extends Controller
{

    public function actionSortable($data)
    {
        foreach (Json::decode($data) as $key => $id) {
            $model = ImagesGalleryModel::findOne($id);
            $model->weight = $key;
            $model->save();
        }
        return true;
    }
}
