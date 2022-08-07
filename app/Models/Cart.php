<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    public $products = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;
    protected $fillable = [
        'product_id', 'user_id', 'quantity', 
    ];
    
    // public function __construct($cart)
    // {
    //     if ($cart) {
    //         $this->products = $cart->products;
    //         $this->totalPrice = $cart->totalPrice;
    //         $this->totalQuantity = $cart->totalQuantity;
    //     }
    // }

    // public function AddCart($product, $id)
    // {
    //     $newProduct = ['quantity' => 0, 'price' => 0, 'productInfo' => $product];
    //     if ($this->products) {
    //         if (array_key_exists($id, $this->products)) {
    //             $newProduct = $this->products[$id];
    //         }
    //     }
    //     $newProduct['quantity']++;
    //     $newProduct['price'] = $newProduct['quantity'] * $product->price;
    //     $this->products[$id] = $newProduct;
    //     $this->totalPrice += $product->price;
    //     $this->totalQuantity++;
    // }
}
