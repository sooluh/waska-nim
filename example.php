<?php

use Wastukancana\NIM;

require __DIR__ . '/vendor/autoload.php';

try {
    $nim = new NIM('211351143');

    var_dump($nim->dump());
} catch (\Exception $e) {
    echo $e->getMessage();
}
