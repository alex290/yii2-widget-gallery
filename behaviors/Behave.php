<?php



namespace alex290\widgetgallery\behaviors;

// use alex290\yii2images\models\Image;

use alex290\widgetgallery\models\ContentWidget;
use alex290\widgetgallery\models\ImagesGalleryModel;
use alex290\widgetgallery\models\NewImages;
use alex290\widgetgallery\models\WidgetDoc;
use Yii;
use yii\base\Behavior;
use yii\helpers\Url;

class Behave extends Behavior
{

    public function getInfo()
    {
        $itemId = $this->owner->primaryKey;

        $modelName = get_class($this->owner);
        return 'id - ' . $itemId. ' '. $modelName;
    }

    public function getGalleryAdmin($title = 'Title', $desc = 'Description')
    {
        $model = $this->owner;
        $modelNamePath = $model->className();
        $data = explode("\\", $modelNamePath);
        $modelName = $data[(count($data) - 1)];
        $path = str_replace($modelName, '', $modelNamePath);
        $url = Url::to();

        // debug($imagesPath);

        $html = $this->adminHtml($model->id, $modelName, $path, $url, $title, $desc);
        return $html;
    }

    public function getNewImages()
    {
        $newImages = new NewImages();
        return $newImages;
    }

    
    public function getGallery()
    {
        $model = $this->owner;
        $modelNamePath = $model->className();
        $data = explode("\\", $modelNamePath);
        $modelName = $data[(count($data) - 1)];

        $modelWidget = ImagesGalleryModel::find()->andWhere(['itemId' => $model->id])->andWhere(['modelName' => $modelName])->indexBy('id')->orderBy(['weight' => SORT_ASC])->all();

        return $modelWidget;
    }

    public function removeGalleryAll()
    {
        $model = $this->owner;
        $modelNamePath = $model->className();
        $data = explode("\\", $modelNamePath);
        $modelName = $data[(count($data) - 1)];

        $modelWidgets = ImagesGalleryModel::find()->andWhere(['itemId' => $model->id])->andWhere(['modelName' => $modelName])->orderBy(['weight' => SORT_ASC])->all();

        if ($modelWidgets != null) {
            foreach ($modelWidgets as $key => $value) {
                $value->removeImages();
                $value->delete();
            }
        }
    }



    public function removeGalleryItem($id)
    {
        $modelWidget = ImagesGalleryModel::findOne($id);
        if ($modelWidget != null) {
            $modelWidget->removeImages();
            $modelWidget->delete();
        }
    }
    

    protected function adminHtml($itemId, $modelName, $subdir, $url, $title, $desc)
    {
        ob_start();
        include __DIR__ . '/../tpl/admin-html.php';
        return ob_get_clean();
    }

}
