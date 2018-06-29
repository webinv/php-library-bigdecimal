<?php
/**
 * BigDecimal Type
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Webinv\Types\BigDecimal;

use InvalidArgumentException;

/**
 * Class BigDecimal
 * @package Webinv\Types\BigDecimal
 */
class BigDecimal
{
    /**
     * @var string
     */
    private $value = '0';

    /**
     * @var int
     */
    private $scale = 8;

    /**
     * BigDecimal constructor.
     * @param $value
     * @param int $scale
     */
    public function __construct($value = '0', int $scale = 8)
    {
        $this->value = $this->normalize($value);
        $this->scale = $scale;
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return $this
     */
    public function isEqualTo($value) : bool
    {
        return 0 === bccomp($this->value, $this->normalize($value), $this->scale);
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return $this
     */
    public function isGreaterThan($value) : bool
    {
        return 1 === bccomp($this->value, $this->normalize($value), $this->scale);
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return $this
     */
    public function isGreaterThanOrEqual(string $value) : bool
    {
        return $this->isEqualTo($value) || 1 === bccomp($this->value, $this->normalize($value), $this->scale);
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return bool
     */
    public function isLowerThan($value) : bool
    {
        return -1 === bccomp($this->value, $this->normalize($value), $this->scale);
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return bool
     */
    public function isLowerThanOrEqual($value) : bool
    {
        return $this->isEqualTo($value) || -1 === bccomp($this->value, $this->normalize($value), $this->scale);
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return $this
     */
    public function add($value) : BigDecimal
    {
        $this->value = bcadd($this->value, $this->normalize($value), $this->scale);
        return $this;
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return $this
     */
    public function sub($value) : BigDecimal
    {
        $this->value = bcsub($this->value, $this->normalize($value), $this->scale);
        return $this;
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return $this
     */
    public function multiply($value) : BigDecimal
    {
        $this->value = bcmul($this->value, $this->normalize($value), $this->scale);
        return $this;
    }

    /**
     * @param string|float|int|BigDecimal $value
     * @return $this
     */
    public function divide($value) : BigDecimal
    {
        $this->value = bcdiv($this->value, $this->normalize($value), $this->scale);
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return float
     */
    public function getFloat(): float
    {
        return floatval($this->value);
    }

    /**
     * @param int $scale
     * @param int $mode
     * @return BigDecimal
     */
    public function round($scale = 0, int $mode = PHP_ROUND_HALF_UP): BigDecimal
    {
        return new self(round($this->getFloat(), $scale, $mode));
    }

    /**
     * @return float
     */
    public function getInt(): float
    {
        return intval($this->value);
    }

    /**
     * @return int
     */
    public function getScale(): int
    {
        return $this->scale;
    }

    /**
     * @return BigDecimal
     */
    public function getCopy(): BigDecimal
    {
        return new self($this->value, $this->scale);
    }

    /**
     * @return string
     */
    public function format()
    {
        return number_format($this->value, $this->scale, '.', ',');
    }

    /**
     * @param $value
     * @return string
     * @throws InvalidArgumentException
     */
    private function normalize($value) : string
    {
        if (is_float($value)) {
            $value = number_format($value, $this->scale, '.', '');
        } elseif (empty($value)) {
            $value = '0';
        } else {
            $value = (string)$value;
        }

        if (!is_numeric($value)) {
            throw new InvalidArgumentException(sprintf('Invalid value %s', $value));
        }

        return $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
