<?php

use Pkg6\Apidoc\Builder;

require 'vendor/autoload.php';

$classes = array(
    "Pkg6\Apidoc\Tests\TestClasses\User",
    "Pkg6\Apidoc\Tests\TestClasses\Article"
);

$output_file = 'api.html'; // defaults to index.html
try {
    $builder = new Builder($classes, ".", 'Api Title', $output_file);
    $builder->generate();
} catch (Exception $e) {
    echo 'There was an error generating the documentation: ', $e->getMessage();
}