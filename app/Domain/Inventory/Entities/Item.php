<?php

namespace App\Domain\Inventory\Entities;

use App\Domain\Inventory\ValueObjects\ItemCode;
use App\Domain\Inventory\ValueObjects\ItemId;
use App\Domain\Inventory\ValueObjects\ItemName;

final class Item
{
    public function __construct(
        private ?ItemId $id,
        private ItemCode $code,
        private ItemName $name,
        private ItemDescription $description,
    ) {}
}
