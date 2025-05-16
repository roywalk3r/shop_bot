<?php
namespace App\Http\Controllers;

use App\Models\Shop\Product;
use Illuminate\Http\Request;
 use Session;
 use App\Models\Cart;
class ProductController extends Controller
{
    public $products;

public function all(){
       $products = Product::with('media')->get();
    return view('frontend.all-products', compact('products') );
}
 
public function details($id)
{
    $product = Product::findOrFail($id);
    return response()->json($product);
}

public function getAddToCart(Request $request, $id)
{
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->add($product, $product->id);

    $request->session()->put('cart', $cart);
    return redirect()->route('cart.index');
}

public function getCart()
{
    $cart = Cart::get();
    return view('frontend.cart', ['cart' => $cart]);
}

// public function removeFromCart($id)
// {
//     $cart = Cart::get();
//     $cart->remove($id);
//     $cart->save();
//     return redirect()->route('cart.index');
// }
public function addToCart($id) {
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->add($product, $product->id);

    Session::put('cart', $cart);
    return redirect()->back();
}

public function removeFromCart($id) {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);

    if (isset($cart->items[$id])) {
        $cart->items[$id]['qty']--;
        $cart->items[$id]['price'] -= $cart->items[$id]['item']->price;
        $cart->totalQty--;
        $cart->totalPrice -= $cart->items[$id]['item']->price;

        if ($cart->items[$id]['qty'] <= 0) {
            unset($cart->items[$id]);
        }

        Session::put('cart', $cart);
    }

    return redirect()->back();
}

//clear single product from cart
public function clearProductFromCart($id) {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    if (isset($cart->items[$id])) {
        unset($cart->items[$id]);
        Session::put('cart', $cart);
    }

    return redirect()->back();
}
public function clearCart()
{
    $cart = Cart::get();
    $cart->clear();
    $cart->save();
    return redirect()->route('cart.index');
}
public function updateCart(Request $request, $id) {
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);

    $quantity = $request->input('quantity');
    if ($quantity > 0) {
        $cart->items[$id]['qty'] = $quantity;
        $cart->items[$id]['price'] = $product->price * $quantity;
        $cart->totalQty = array_sum(array_column($cart->items, 'qty'));
        $cart->totalPrice = array_sum(array_column($cart->items, 'price'));

        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Cart updated successfully.']);
    } else {
        return response()->json(['message' => 'Invalid quantity.'], 400);
    }
}
 
}