<?php

use Wastukancana\Nim;

require __DIR__ . '/vendor/autoload.php';

try {
    $nim = new Nim('211351143');

    var_dump($nim->dump());
} catch (\Exception $e) {
    echo $e->getMessage();
}
