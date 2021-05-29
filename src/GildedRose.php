<?php

namespace Runroom\GildedRose;

class GildedRose
{
    private $items;

    function __construct($items)
    {
        $this->items = $items;
    }

    function update_quality()
    {
        foreach ($this->items as $item) {
            $item->updateItem();
        }
    }
}
