<?php

$jsonFile = isset($argv[1]) ? $argv[1] : null;

if (is_null($jsonFile)) die("You need to provide a json file\n");


$generator = new FBSG\Generator\Generator;
$generator->setJsonFile($jsonFile);

echo "generating output file\n";
$generator->generate();

