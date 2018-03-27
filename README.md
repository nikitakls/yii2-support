Yii2 support module with ticket system
======================================
Yii2 support module with ticket system

> **NOTE:** Module is in initial development. Anything may change at any time.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nikitakls/yii2-support-ticket "*"
```

or add

```
"nikitakls/yii2-support-ticket": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

- **Apply migrations**
```
yii migrate/up -p=@nikitakls/support/migrations
```
## Restrict and split frontend and backend applications

- **Configure module**

Add module in config file application for frontend:

```php
'modules'   => [
    'class' => \nikitakls\support\Support::class,
    'support'   => 'nikitakls\support\Support',
    'layout' => '@frontend/views/layouts/profile',
    'guestLayout' => '@frontend/views/layouts/main',
    'isBackend' => false,
    'supportEmail' => 'support@example.com',
    'sendEmailToSupport' => true,
    'sendEmailToUser' => true,
    'uploadBehavior' => [
        'filePath' => '@filePath/origin/support/[[attribute_ticket_id]]/[[pk]].[[extension]]',
        'fileUrl' => '@fileUrl/origin/support/[[attribute_ticket_id]]/[[pk]].[[extension]]',
    ]
],
```
You can get access to module via url:
http://application.url/support/default - for users
http://application.url/support/contact - for guest


Add module in config file application for backend:
```php
'modules'   => [
    ...
    'isBackend' => true,
],
```

