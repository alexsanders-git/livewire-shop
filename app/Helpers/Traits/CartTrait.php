<?php

namespace App\Helpers\Traits;

use App\Helpers\Cart\Cart;

trait CartTrait
{

    public int $quantity = 1;

    public function addToCart(int $id, $quantity = false)
    {
        $quantity = $quantity ? $this->quantity : 1;

        $quantity = max($quantity, 1);

        if (Cart::addToCart($id, $quantity)) {
            $this->js("toastr.success('Product added to cart')");
            $this->dispatch('cart-updated');
        } else {
            $this->js("toastr.error('Opps! Something went wrong')");
        }
    }

    public function removeFromCart(int $id)
    {
        if (Cart::removeFromCart($id)) {
            $this->js("toastr.success('Product removed from cart')");
            $this->dispatch('cart-updated');
        } else {
            $this->js("toastr.error('Opps! Something went wrong')");
        }
    }
}
