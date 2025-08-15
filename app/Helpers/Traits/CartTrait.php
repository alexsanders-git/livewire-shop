<?php

namespace App\Helpers\Traits;

use App\Helpers\Cart\Cart;

trait CartTrait
{

    public int $quantity = 1;

    public function addToCart( int $id, $quantity = false )
    {
        $quantity = $quantity ? $this->quantity : 1;

        $quantity = max( $quantity, 1 );

        $res = Cart::addToCart( $id, $quantity );
    }

}
