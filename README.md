Widget gallery
==============
Yii2 Widget gallery

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist alex290/yii2-widget-gallery "*"
```

or add

```
"alex290/yii2-widget-gallery": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

в конфиге web.php прописать

    'modules' => [
        'widget-gallery' => [
            'class' => 'alex290\widgetgallery\Module',
            'path' => 'upload', //path to files
        ],
    ],

run migrate

php yii migrate/up --migrationPath=@vendor/alex290/yii2-widget-gallery/migrations

attach behaviour to your model (be sure that your model has "id" property)

    public function behaviors()
    {
        return [
            'gallery' => [
                'class' => 'alex290\widgetgallery\behaviors\Behave',
            ]
        ];
    }


Вывести виджет в админке

    <?= $model->getGalleryAdmin($title = 'Название', $desc = 'Описание') ?>


    $title = false

Скрывает поле $title

    $desc = false

Скрывает поле $desc


Получить массив объектов виджетов данной модели

    $model->getGallery();


Удалить виджеты

    $model->removeGalleryAll();

    $model->removeGalleryItem($id);
    
Выводить записи на странице
    
    <?php if ($model->getGalleryData() != null) : ?>
        <?php foreach ($model->getGalleryData() as $key => $gallery) : ?>
                

        <?php endforeach ?>
    <?php endif ?>
    
