<?php
    namespace Octo;

    require_once realpath(__DIR__) . '/../vendor/autoload.php';

    $from_root = isAke($_SERVER, 'FROM_ROOT', null);

    if ($from_root) {
        $root = realpath(__DIR__ . '/..');

        $nameDir = Arrays::last(explode(DS, $root));

        if (fnmatch('/' . $nameDir . '/*', $_SERVER['REQUEST_URI'])) {
            define('FROM_ROOT', $nameDir);
        }
    }

    systemBoot(__DIR__);

    Loading::add('Pages', realpath(__DIR__) . '/../site');
    Loading::add('Octo', realpath(__DIR__) . '/../site');

    Loading::register();

    try {
        Bootstrap::run();
    } catch (\Exception $e) {
        $debug = Config::get("debug", true);

        if (true === $debug) {
            ob_start();
            echo '<h1><i class="fa fa-info-circle fa-2x"></i> Infos</h1>';
            $infos = Registry::get('BACKTRACE', $e->getTrace());
            echo '<pre>';
            var_dump($infos);
            echo '</pre>';

            $trace = ob_get_clean();

            $html = '<h1><i class="fa fa-warning fa-2x"></i> Error to boot Octo</h1>';
            $html .= 'Please read the next message to fix.';
            $html .= '<div style="margin-top: 15px;" class="alert alert-danger">
            ' . $e->getMessage();

            if (!Registry::has('BACKTRACE')) {dd('ici');
                $html .= '<hr>in ' . $e->getFile() . ' (line: ' . $e->getLine() . ')';
            }

            $html .= '</div><hr>' . $trace . '';

            view($html, 500, 'Octo Error Report');
        }
    }
