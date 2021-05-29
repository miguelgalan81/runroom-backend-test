<?php

namespace Runroom\GildedRose;

class Item
{
    const BRIE      = 'Aged Brie';
    const BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS  = 'Sulfuras, Hand of Ragnaros';

    public $name;
    public $sell_in;
    public $quality;

    function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    /**
     * updateItem
     *
     * @return void
     */
    public function updateItem(): void
    {
        if ($this->name === self::BRIE || $this->name === self::BACKSTAGE) {
            $this->checkQualityToUpdateIt();
        } else {
            $this->checkQualityAndNameToDowngradeQuality();
        }

        if ($this->name != self::SULFURAS) {
            $this->sell_in--;
        }

        if ($this->sell_in < 0) {
            $this->modifyQualityByName();
        }
    }

    /**
     * updateQualityIfIsBackstageAndSellLessThanEleven
     *
     * @return Item
     */
    public function updateQualityIfIsBackstageAndSellLessThanEleven(): Item
    {
        if ($this->name == self::BACKSTAGE) {
            if ($this->sell_in < 11) {
                $this->quality++;
            }
            if ($this->sell_in < 6) {
                $this->quality++;
            }
        }

        return $this;
    }

    /**
     * modifyQualityByName
     *
     * @return Item
     */
    public function modifyQualityByName(): Item
    {
        if ($this->name == self::BRIE) {
            if ($this->quality < 50) {
                $this->quality++;
            }
        } else {
            if ($this->name == self::BACKSTAGE) {
                $this->quality = 0;
            } else {
                if ($this->quality > 0 && $this->name != self::SULFURAS) {
                    $this->quality--;
                }
            }
        }

        return $this;
    }

    /**
     * modifyQualityByName
     *
     * @return Item
     */
    public function checkQualityToUpdateIt(): Item
    {
        if ($this->quality < 50) {
            $this->quality++;
            $this->updateQualityIfIsBackstageAndSellLessThanEleven();
        }

        return $this;
    }

    /**
     * checkQualityAndNameToDowngradeQuality
     *
     * @return Item
     */
    public function checkQualityAndNameToDowngradeQuality(): Item
    {
        if ($this->quality > 0 && $this->name != self::SULFURAS) {
            $this->quality = $this->quality - 1;
        }

        return $this;
    }
}
