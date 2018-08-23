[![Build Status](https://travis-ci.org/jeckel/php7-enum.svg?branch=master)](https://travis-ci.org/jeckel/php7-enum) [![Twitter](https://img.shields.io/badge/Twitter-%40jeckel4-blue.svg)](https://twitter.com/jeckel4) [![LinkedIn](https://img.shields.io/badge/LinkedIn-Julien%20Mercier-blue.svg)](https://www.linkedin.com/in/jeckel/)

# php7-enum
PHP7 Enum library

This library create ValueObject for Enum lists

# Installation

```sh
composer require jeckel/php7-enum
```

# Usage

To declare new Enum list, just create a new class that extends the **EnumAbstract** and declare possible values as constants

```php
<?php
/**
 * Class StatusEnum
 *
 * @method static DRAFT(): StatusEnum
 * @method static VALID(): StatusEnum
 * @method static DELETED(): StatusEnum
 */
class StatusEnum extends PHP7Enum\EnumAbstract
{
    const DRAFT = 'draft';
    const VALID = 'valid';
    const DELETED = 'deleted';
}
```

Now you can get valueObject as statics methods.

All instances of the same item are pointer to the same object and then identical.

```php
<?php

$draft = StatusEnum::DRAFT();
$valid = StatusEnum::VALID();

echo ($draft instanceof StatusEnum::class) ? 'true' : 'false'; // true
echo $draft; // draft

// 2 different calls return the same instance
echo ($draft === StatusEnum::DRAFT()) ? 'true' : 'false'; //true

?>
```
