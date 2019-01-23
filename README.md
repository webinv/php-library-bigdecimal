# BigDecimal Type

[![Build Status](https://travis-ci.org/webinv/php-library-bigdecimal.svg?branch=master)](https://travis-ci.org/webinv/php-library-bigdecimal)
[![Latest Stable Version](https://poser.pugx.org/webinv/bigdecimal/v/stable)](https://packagist.org/packages/webinv/bigdecimal)
[![Total Downloads](https://poser.pugx.org/webinv/bigdecimal/downloads)](https://packagist.org/packages/webinv/bigdecimal)
[![Latest Unstable Version](https://poser.pugx.org/webinv/bigdecimal/v/unstable)](https://packagist.org/packages/webinv/bigdecimal)
[![License](https://poser.pugx.org/webinv/bigdecimal/license)](https://packagist.org/packages/webinv/bigdecimal)


## Installation

`composer require webinv/bigdecimal`


## Usage

```php 
use Webinv\Types\BigDecimal\BigDecimal;

$bigdecimal = new BigDecimal('0.00008630');
$bigdecimal->add('0.00000001');

if ($bigdecimal->isGreaterThan('0.00008630')) {
    echo 'Yes !';
}

```