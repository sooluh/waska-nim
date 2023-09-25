# Waska NIM

[![Version](http://poser.pugx.org/wastukancana/nim/version)](https://packagist.org/packages/wastukancana/nim)
[![Total Downloads](http://poser.pugx.org/wastukancana/nim/downloads)](https://packagist.org/packages/wastukancana/nim)
[![Latest Unstable Version](http://poser.pugx.org/wastukancana/nim/v/unstable)](https://packagist.org/packages/wastukancana/nim)
[![License](http://poser.pugx.org/wastukancana/nim/license)](https://packagist.org/packages/wastukancana/nim)

Sekolah Tinggi Teknologi Wastukancana Student ID (NIM) Parser.

## Requirements

- PHP `>= 7.4`
- Composer v2
- cURL `>= 7.19.4`

## Installation

Install the package with:

```bash
composer require wastukancana/nim
```

## Example

```php
<?php

use Wastukancana\NIM;

require __DIR__ . '/vendor/autoload.php';

try {
    $nim = new NIM('211351143');

    var_dump($nim->dump());
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## License

This project is licensed under [MIT License](./LICENSE).
