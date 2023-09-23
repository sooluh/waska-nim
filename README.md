# NIM Parser

[![Latest Stable Version](http://poser.pugx.org/sooluh/waska-nim/v)](https://packagist.org/packages/sooluh/waska-nim)
[![Total Downloads](http://poser.pugx.org/sooluh/waska-nim/downloads)](https://packagist.org/packages/sooluh/waska-nim)
[![Latest Unstable Version](http://poser.pugx.org/sooluh/waska-nim/v/unstable)](https://packagist.org/packages/sooluh/waska-nim)
[![License](http://poser.pugx.org/sooluh/waska-nim/license)](https://packagist.org/packages/sooluh/waska-nim)

Sekolah Tinggi Teknologi Student ID (NIM) Parser.

## Requirements

- PHP >= 7.4
- Composer
- curl

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

    var_dump($nim->isValidAdmissionYear());
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## To-Do

- [ ] Integration with PDDikti

## License

This project is licensed under [MIT License](./LICENSE).
