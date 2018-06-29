<?php
/**
 * BigDecimal Type
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Tests\Webinv\Types\BigDecimal;

use PHPUnit\Framework\TestCase;
use Webinv\Types\BigDecimal\BigDecimal;

/**
 * Class BigDecimalTest
 * @package Tests\Webinv\Types\BigDecimal
 */
class BigDecimalTest extends TestCase
{
    /**
     * @test
     * @dataProvider bigDecimalEqual
     * @param string $left
     * @param string $right
     */
    public function big_decimal_is_equal_to(string $left, string $right)
    {
        $this->assertTrue(
            (new BigDecimal($left))->isEqualTo($right),
            sprintf('BigDecimal is equal %s = %s', $left, $right)
        );
    }

    /**
     * @return array
     */
    public function bigDecimalEqual()
    {
        return [
            ['0.00008630', '0.00008630'],
            ['0.00008632', '0.00008632'],
            ['0.00000000', '0'],
            ['0.00000000', '0.0'],
            ['0', '0.0']
        ];
    }

    /**
     * @test
     * @dataProvider bigDecimalGreaterThan
     * @param string $left
     * @param string $right
     */
    public function big_decimal_is_greater_than(string $left, string $right)
    {
        $this->assertTrue(
            (new BigDecimal($left))->isGreaterThan($right),
            sprintf('BigDecimal is greater than %s > %s', $left, $right)
        );
    }

    /**
     * @return array
     */
    public function bigDecimalGreaterThan()
    {
        return [
            ['0.00009639', '0.00008630'],
            ['0.00008644', '0.00008632'],
            ['0.00008644', '0'],
            ['0.00008639', '0.0'],
            ['0.00000001', '0.0']
        ];
    }

    /**
     * @test
     * @dataProvider bigDecimalLowerThan
     * @param string $left
     * @param string $right
     */
    public function big_decimal_is_lower_than(string $left, string $right)
    {
        $this->assertTrue(
            (new BigDecimal($left))->isLowerThan($right),
            sprintf('BigDecimal is greater than %s < %s', $left, $right)
        );
    }

    /**
     * @return array
     */
    public function bigDecimalLowerThan()
    {
        return [
            ['0.00007639', '0.00008630'],
            ['0.00008631', '0.00008632'],
            ['0.00008644', '0.00008645'],
            ['0.00008639', '0.00008649'],
            ['0.0', '0.00000001']
        ];
    }
}
