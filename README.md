Yii2 food module
================
Yii2 food module

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sibus/yii2-food
```

or add

```
"sibus/yii2-food": "~1.0.0"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    'modules' => [
        'food' => [
            'class' => 'sibus\food\Module',
        ],
        // ...
    ],
    // ...
];
```

You can then access the module through the following URL:

```
http://localhost/path/to/index.php?r=food
```

or if you have enabled pretty URLs, you may use the following URL:

```
http://localhost/path/to/index.php/food
```
