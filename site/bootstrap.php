<?php
    namespace Octo;

    class Bootstrap
    {
        public static function run()
        {
            Timer::start();

            extender('Pages', 'Octo');

            require_once realpath(__DIR__) . '/config/config.php';

            new Page;
        }
    }
