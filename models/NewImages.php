<?php

namespace alex290\widgetgallery\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class NewImages extends Model
{
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function upload($model)
    {
        $this->imageFiles = UploadedFile::getInstances($this, 'imageFiles');
        // debug($this->imageFiles);
        if ($model->id > 0) {
            FileHelper::createDirectory('upload');
            $modelNamePath = $model->className();
            $data = explode("\\", $modelNamePath);
            $modelName = $data[(count($data) - 1)];

            $query = ImagesGalleryModel::find()->andWhere(['modelName' => $modelName])->andWhere(['itemId' => $model->id])->indexBy('id');
            $models = $query->all();

            $count = $query->count();

            if (Model::loadMultiple($models, Yii::$app->request->post())) {
                foreach ($models as $modelItem) {
                    $modelItem->save(false);
                }
            }

            if ($this->imageFiles) {

                foreach ($this->imageFiles as $file) {
                    $path = 'upload/' . $file->baseName . '.' . $file->extension;
                    $file->saveAs($path);
                    $modelNew = new ImagesGalleryModel();
                    $modelNew->weight = $count;
                    $modelNew->modelName = $modelName;
                    $modelNew->itemId = $model->id;

                    if ($modelNew->save()) {
                        $modelNew->attachImage($path);
                    }

                    unlink($path);
                    $count++;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
