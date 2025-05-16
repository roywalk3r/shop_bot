<?php
namespace App;

class Cart{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldcart){
        
        if ($oldcart){
            $this->items = $oldcart->items;
            $this->totalQty = $oldcart->totalQty;
            $this->totalPrice = $oldcart->totalPrice;
        }
    }

    public function add($item, $id){
        $storedItem = ['qty' => 0, 'price' => $item->price
        , 'item' => $item];
        if ($this->items){
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
    }
     $storedItem['qty']++;
    $storedItem['price'] = $item->price * $storedItem['qty'];
    $this->items[$id] = $storedItem;
    $this->totalQty++;
    $this->totalPrice += $item->price;
    }
    public function remove($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
    public function clear(){
        $this->items = null;
        $this->totalQty = 0;
        $this->totalPrice = 0;
    }
    public function save(){
        session()->put('cart', $this);
    }
    public static function get(){
        if (session()->has('cart')){
            return session()->get('cart');
        }
        else{
            return new Cart(null);
        }
        }
 
    }