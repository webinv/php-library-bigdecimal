# BigDecimal Type

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