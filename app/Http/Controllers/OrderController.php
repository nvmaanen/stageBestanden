<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\offerte;
use App\Mail\invoice;
use App\Mail\confirmation;



use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function edit(Order $order, ProductOrder $productOrder)
    {

        $productOrder = ProductOrder::all();
        return view('admin.orders.edit', compact('productOrder'))->with('order', $order);
    }
    public function show(Order $order, ProductOrder $productOrder)
    {

        $productOrder = ProductOrder::all();
        $pdf = Pdf::loadView('pdf.invoice', ['order' => $order, 'productOrder' => $productOrder]);
        return $pdf->stream();
    }

    public function view(Order $order, Product $products, ProductOrder $productOrder)
    {
        $this->authorize('create', Product::class);
        $products = Product::all();
        $this->calculate($order, $productOrder);
        return view('admin.orders.order', compact('order', 'products', 'productOrder'));
    }

    public function viewCreate(Product $products)
    {
        $products = Product::all();
        return view('admin.orders.create', compact('products'));
    }

    public function create(Order $order, ProductOrder $products, Request $request, Product $product)
    {
        $this->authorize('create', Product::class);
        $product = Product::findOrFail($request->product_id);
        $order = new Order;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->zipcode = $request->zipcode;
        $order->residence = $request->residence;
        $order->total_price_excl = $product->price;
        $order->total_vat = $product->vat;
        $order->total_price = ($product->price * ($product->vat / 100)) + $product->price;
        $order->status = 0;

        $order->save();

        $products = new ProductOrder;
        $products->order_id = $order->id;
        $products->product_id = $request->product_id;
        $products->name = $request->name;
        $products->price = $product->price;
        $products->discount_price = $product->discount_price;
        $products->vat = $product->vat;
        $products->quantity = 1;

        $products->save();


        // Mail::to($order['email'])->send(new offerte($order, $products));
        return redirect()->route('admin.orders.view', compact('order'));
    }

    public function offerte(Order $order, ProductOrder $products)
    {
        $this->authorize('create', Product::class);
        Mail::to($order['email'])->send(new offerte($order, $products));
        return redirect()->route('admin.orders.view', compact('order'));
    }


    public function destroy(Order $order)
    {
        $this->authorize('create', Product::class);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('statusDelete', 'De bestelling is verwijderd!');
    }


    public function deleteProduct(Order $order, ProductOrder $productOrder, Product $product)
    {
        $this->authorize('create', Product::class);

        $productOrder = ProductOrder::where('product_id', $product->id);
        $productOrder->delete();
        $productOrders = ProductOrder::where('order_id', $order->id)->get();
        // dd($productOrders);
        if (count($productOrders) == 0) {
            $order->delete();
            return redirect()->route('admin.orders.index')->with('orderDelete', 'De bestelling is verwijderd omdat het laatste product is verwijderd.');
        }
        $this->calculate($order, $productOrder);
        // $order->save();

        return redirect()->route('admin.orders.view', compact('order'))->with('message', 'Product verwijdered');
    }


    public function update(Order $order, Request $request)
    {
        $this->authorize('create', Product::class);
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->zipcode = $request->zipcode;
        $order->residence = $request->residence;

        $order->save();

        return redirect()->route('admin.orders.view', $order)->with('statusUpdate', 'De bestelling is aangepast!');
    }

    public function quantityUpdate(Order $order, ProductOrder $productOrder, Product $product, OrderRequest $request)
    {
        $this->authorize('create', Product::class);
        // $product = Product::findOrFail($request->product_id);
        $productOrder->quantity = $request->quantity;
        $productOrder->save();

        $this->calculate($order, $productOrder);

        return redirect()->route('admin.orders.view', compact('order'))->with('quantityUpdate', 'Het aantal is aangepast!');
    }


    public function updatePrice(Order $order, ProductOrder $productOrder, Product $product, OrderRequest $request)
    {

        $this->authorize('create', Product::class);
        $product = Product::findOrFail($request->product_id);
        $productOrder->discount_price = $request->discount_price;
        $productOrder->save();


        $this->calculate($order, $productOrder);


        return redirect(route('admin.orders.view', compact('order')))->with('message', 'De prijs is bijgewerkt');
    }

    public function calculate(Order $order)
    {
        $total = 0;
        $total_vat = 0;
        $total_price_excl = 0;
        $productOrders = ProductOrder::where('order_id', $order->id)->get();
        foreach ($productOrders as $productOrder) {
            if ($productOrder->discount_price) {
                $total += $productOrder->discount_price * $productOrder->quantity * ($productOrder->vat / 100) + $productOrder->discount_price * $productOrder->quantity;
                $total_price_excl += $productOrder->discount_price * $productOrder->quantity;
                $total_vat += $productOrder->discount_price * $productOrder->quantity * ($productOrder->vat / 100);
            } else {
                $total += $productOrder->price * $productOrder->quantity * ($productOrder->vat / 100) + $productOrder->price * $productOrder->quantity;
                $total_price_excl = $productOrder->price * $productOrder->quantity;
                $total_vat += $productOrder->price * $productOrder->quantity * ($productOrder->vat / 100);
            }
        }

        $order->total_price_excl = $total_price_excl;
        $order->total_vat = $total_vat;
        $order->total_price = $total;
        $order->save();
    }


    public function addProduct(Request $request, Order $order, Product $product)
    {
        $this->authorize('create', Product::class);
        $product = Product::findOrFail($request->product_id);
        if ($productOrder = ProductOrder::where('product_id', $request->product_id)->first()) {
            $productOrder->increment('quantity', 1);
            return redirect()->back()->with('quantityUpdate', 'Het aantal is aangepast!');
        } else {

            $productOrder = new ProductOrder();
            $productOrder->order_id = $order->id;
            $productOrder->product_id = $request->product_id;


            $productOrder->name = $request->order->name;
            $productOrder->price = $productOrder['product']->price;
            $productOrder->discount_price = $productOrder['product']->discount_price;
            $productOrder->vat = $productOrder['product']->vat;
            $productOrder->quantity = 1;
        }



        $productOrder->save();

        $this->calculate($order);

        return redirect()->route('admin.orders.view', compact('order'));
    }


    public function change(Request $request, Order $order, ProductOrder $products)
    {
        $this->authorize('create', Product::class);

        $order->status = $request->status;

        $order->save();

        Mail::to($order['email'])->send(new invoice($order, $products));
        return redirect()->route('admin.orders.view', compact('order'));
    }
    public function changeBack(Request $request, Order $order, ProductOrder $products)
    {
        $this->authorize('create', Product::class);

        $order->status = $request->status;

        $order->save();


        return redirect()->route('admin.orders.view', compact('order'));
    }

    public function orderProduct(Request $request)
    {

        $total = 0;
        $total_vat = 0;
        $total_price_excl = 0;
        $total_discount = 0;
        $cartItems = session()->get('products', []);

        $customer = session()->get('customer', []);
        foreach ($cartItems  as $cartItem) {
            if ($cartItem['product']->discount_price) {
                $total += $cartItem['product']->discount_price * $cartItem["quantity"] * ($cartItem["product"]->vat / 100) + $cartItem['product']->discount_price * $cartItem["quantity"];
                $total_price_excl += $cartItem['product']->discount_price * $cartItem["quantity"];
                $total_vat += $cartItem['product']->discount_price * $cartItem["quantity"] * ($cartItem["product"]->vat / 100);
                $total_discount += ($cartItem["product"]->price * $cartItem["quantity"]) - ($cartItem['product']->discount_price * $cartItem["quantity"]);
            } else {
                $total += $cartItem["product"]->price * $cartItem["quantity"] * ($cartItem["product"]->vat / 100) + $cartItem["product"]->price * $cartItem["quantity"];
                $total_price_excl += $cartItem["product"]->price * $cartItem["quantity"];
                $total_vat += $cartItem["product"]->price * $cartItem["quantity"] * ($cartItem["product"]->vat / 100);
            }





            $order = new Order;
            $order->name = $customer['name'];
            $order->address = $customer['address'];
            $order->zipcode = $customer['zipcode'];
            $order->residence = $customer['residence'];
            $order->email = $customer['email'];
            $order->total_price_excl = $total_price_excl;

            $order->total_vat = $total_vat;
            $order->total_price = $total;
            $order->status = 1;
            $order->save();

            foreach ($cartItems  as $cartItem) {
                $order_products = new ProductOrder;
                $order_products->order_id = $order->id;
                $order_products->product_id = $cartItem['product']->id;
                $order_products->name = $customer['name'];
                $order_products->quantity = $cartItem['quantity'];
                $order_products->price = $cartItem['product']->price;
                $order_products->discount_price = $cartItem['product']->discount_price;
                $order_products->vat = $cartItem['product']->vat;
                $order_products->save();
            }


            Mail::to($customer['email'])->send(new confirmation($cartItems, $customer, $order));

            $request->session()->forget(['customer', 'products']);
            return redirect()->route('products')->with('statusOrder', 'Bestelling geplaatst');
        }
    }
}
