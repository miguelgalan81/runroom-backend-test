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

    function __construct($name, $sell_in, $quality)
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
}
