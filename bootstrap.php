<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

if (file_exists(__DIR__ . '/../../autoload.php')) {
    require __DIR__ . '/../../autoload.php';
} else {
    require __DIR__ . '/vendor/autoload.php';
}

/**
 * @return string
 */
function run_path()
{
    return getcwd();
}

/**
 * @return string
 */
function test_path()
{
    return __DIR__ . '/tests';
}