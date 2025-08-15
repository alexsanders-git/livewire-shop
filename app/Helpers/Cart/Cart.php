<?php

namespace App\Helpers\Cart;

use App\Models\Product;

class Cart
{
    public static function addToCart( int $id, int $quantity = 1 ): bool
    {
        $added = false;

        if ( self::hasProductInCart( $id ) ) {
            session( [ "cart.{$id}.quantity" => session( "cart.{$id}.quantity" ) + $quantity ] );
            $added = true;
        } else {
            $product = Product::find( $id );

            if ( $product ) {
                $new_product = [
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];

                session( [ "cart.{$id}" => $new_product ] );
                $added = true;
            }
        }

        return $added;
    }

    public static function getCart( int $id = null ): array
    {
        return session( 'cart' ) ?: [];
    }

    public static function hasProductInCart( int $id ): bool
    {
        return session()->has( "cart.{$id}" );
    }
}
