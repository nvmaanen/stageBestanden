<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Mail\confirmation;

use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    public function view()
    {
        $cartItems = session()->get('products');
        return view('cart.index', compact('cartItems'));
    }

    public function viewCreate()
    {
        $cartItems = session()->get('products');
        $customerData = session()->get('customer');
        return view('cart.create', compact('cartItems', 'customerData'));
    }

    public function viewOverview()
    {
        $cartItems = session()->get('products');
        $customerData = session()->get('customer');
        return view('cart.overview', compact('cartItems', 'customerData'));
    }


    public function add(Request $request, Product $product)
    {

        $items = $request->session()->get('products', []);

        if ($items) {
            foreach ($items as $item => $key) {

                if ($key["product"]->is($product)) {

                    $items[$item] = ['product' => $product, 'quantity' => $key["quantity"] + 1];
                }
            }
            if ($items == $request->session()->get('products')) {

                $items[] = ['product' => $product, 'quantity' => 1];
            }
        } else {
            $items[] = ['product' => $product, 'quantity' => 1];
        }
        $request->session()->pull('products', []);
        $request->session()->put('products', $items);
        return redirect(route('cart.index'))->with('status', 'Product toegevoegd aan winkelmandje');
    }

    public function delete(Request $request, Product $product)
    {
        $items = $request->session()->get('products', []);



        foreach ($items as $item => $key) {

            if ($key["product"]->is($product)) {

                unset($items[$item]);
            }
        }
        $request->session()->forget('products');
        $request->session()->put('products', $items);

        return redirect(route('cart.index'))->with('statusDelete', 'Het product is verwijderd');
    }



    public function update(CartRequest $request, Product $product)
    {
        $items = $request->session()->get('products', []);



        foreach ($items as $item => $key) {
            if ($key["product"]->is($product)) {
                $items[$item] = ['product' => $product, 'quantity' => $request->quantity];
            }
        }
        $request->session()->pull('products', []);
        $request->session()->put('products', $items);
        return redirect()->back()->with('statusQuantity', 'Het aantal is aangepast');
    }



    public function order(Request $request)
    {


        $customerData = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'residence' => $request->residence,
            'telephone' => $request->telephone,
            'total_price' => 1,


        ];

        session()->put('customer', $customerData);
        return redirect()->route('cart.overview');
    }
}
