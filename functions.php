<?php

define('TEXT_DOMAIN', 'fooz');

$path = __DIR__ . '/inc';

function twentytwentyone_child_theme_setup() {
    add_editor_style('style-editor.css');
}

add_action('after_setup_theme', 'twentytwentyone_child_theme_setup');

if (is_dir($path)) {
    $directoryIterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($directoryIterator);

    foreach ($iterator as $fileinfo) {

        if ($fileinfo->isFile() && $fileinfo->getExtension() === 'php') {
            include $fileinfo->getPathname();
        }
    }
}

