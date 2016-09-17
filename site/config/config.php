<?php
    namespace Octo;

    Config::set('application.name', 'Pages');
    Config::set('application.dir', realpath(__DIR__ . '/../'));
    Config::set('model.dir', realpath(__DIR__ . '/../models'));

    Config::set('octalia.dir', realpath('/var/www/storage/data'));
    Config::set('dir.cache', realpath('/var/www/storage/cache'));

    /* MySQL */
    Config::set('mysql.username', 'octo');
    Config::set('mysql.password', 'octo');

    /* Mailer */
    Config::set('mailer.driver', 'smtp');
    Config::set('mailer.host', 'mailtrap.io');
    Config::set('mailer.port', 2525);
    Config::set('mailer.username', '6ef16346830bd9');
    Config::set('mailer.password', '96b273fdb024d2');
    Config::set('mailer.secure', 'tls');
    Config::set('mailer.timeout', 20);
    Config::set('mailer.persistent', null);

    Config::set('notification.driver', 'mail');

    path('config',          realpath(__DIR__));
    path('app',             realpath(__DIR__ . '/../'));
    path('content',         realpath(__DIR__ . '/../content'));
    path('pages',           realpath(__DIR__ . '/../content/pages'));
    path('themes',          realpath(__DIR__ . '/../content/themes'));
    path('tasks',           realpath(__DIR__ . '/../tasks'));
    path('tests',           realpath(__DIR__ . '/../tests'));
    path('public',          realpath(__DIR__ . '/../../public'));
    path('models',          realpath(__DIR__ . '/../content/models'));
    path('controllers',     realpath(__DIR__ . '/../content/controllers'));
    path('translations',    realpath(__DIR__ . '/../content/translations'));
    path('storage',         realpath(__DIR__ . '/var/www/storage'));
    path('octalia',         Config::get('octalia.dir', session_save_path()));
    path('cache',           Config::get('dir.cache', session_save_path()));

    Registry::set('cb.404', function () {
        if (!headers_sent()) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            header('Location:' . Registry::get('octo.subdir', '') . '/is404');
        }
    });
