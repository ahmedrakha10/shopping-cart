<?php

namespace App;


class Cart
{
    public $items = [];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart = null)
    {
        if ($cart) {
            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    // add to cart function
    public function add($product = null)
    {
        $item = [
            'id'    => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'qty'   => 0,
            'image' => $product->image
        ];
        if (!array_key_exists($product->id, $this->items)) {
            $this->items[$product->id] = $item;
            $this->totalQty += 1;
            $this->totalPrice += $product->price;
        } else {

            $this->totalQty += 1;
            $this->totalPrice += $product->price;
        }
        $this->items[$product->id]['qty'] += 1;

    }

    public function remove($id)
    {
        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }

    public function updateQty($id, $qty)
    {
        // reset quantity and price in the cart
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty'];

        //add items with new quantity
        $this->items[$id]['qty'] = $qty;
        //total price and quantity in the cart
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price']  * $qty;
    }

}
