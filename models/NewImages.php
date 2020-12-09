<?php

namespace alex290\widgetgallery\models;

use Yii;
use yii\base\Model;


class NewImages extends Model
{
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function upload($modelName, $itemId)
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $path = 'upload/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $model = new ImagesGalleryModel();
                $model->attachImage($path);

                unlink($path);
            }
            return true;
        } else {
            return false;
        }
    }
}
