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

    function __construct(string $name, int $sell_in, int $quality) {
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
     * updateQualityIfIsBackstageAndSellLessThanEleven
     *
     * @param Item $item
     * @return Item
     */
    public function updateQualityIfIsBackstageAndSellLessThanEleven(Item $item): Item
    {
        if ($item->name == self::BACKSTAGE) {
            if ($item->sell_in < 11) {
                $item->quality++;
            }
            if ($item->sell_in < 6) {
                $item->quality++;
            }
        }

        return $item;
    }

    /**
     * modifyQualityByName
     *
     * @param Item $item
     * @return Item
     */
    public function modifyQualityByName(Item $item): Item
    {
        if ($item->name == self::BRIE) {
            if ($item->quality < 50) {
                $item->quality++;
            }
        } else {
            if ($item->name == self::BACKSTAGE) {
                $item->quality = 0;
            } else {
                if ($item->quality > 0 && $item->name != self::SULFURAS) {
                    $item->quality--;
                }
            }
        }

        return $item;
    }

    /**
     * modifyQualityByName
     *
     * @param Item $item
     * @return Item
     */
    public function checkQualityToUpdateIt(Item $item): Item
    {
        if ($item->quality < 50) {
            $item->quality++;
            $item = $this->updateQualityIfIsBackstageAndSellLessThanEleven($item);
        }

        return $item;
    }

    /**
     * checkQualityAndNameToDowngradeQuality
     *
     * @param Item $item
     * @return Item
     */
    public function checkQualityAndNameToDowngradeQuality(Item $item): Item
    {
        if ($item->quality > 0 && $item->name != self::SULFURAS) {
            $item->quality = $item->quality - 1;
        }

        return $item;
    }
}
