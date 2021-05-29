<?php

namespace Runroom\GildedRose;

class GildedRose
{
    private $items;

    const BRIE      = 'Aged Brie';
    const BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS  = 'Sulfuras, Hand of Ragnaros';

    function __construct($items)
    {
        $this->items = $items;
    }

    function update_quality()
    {
        foreach ($this->items as $item) {
            if ($item->name === self::BRIE || $item->name === self::BACKSTAGE) {
                $item->checkQualityToUpdateIt($item);
            } else {
                $item->checkQualityAndNameToDowngradeQuality($item);
            }

            if ($item->name != self::SULFURAS) {
                $item->sell_in = $item->sell_in - 1;
            }

            if ($item->sell_in < 0) {
                $item->modifyQualityByName($item);
            }
        }
    }
}
