<?php

use Wastukancana\Nim;

require __DIR__ . '/vendor/autoload.php';

try {
    $nim = new Nim('221351017');

    var_dump($nim->dump());
} catch (\Exception $e) {
    echo $e->getMessage();
}
