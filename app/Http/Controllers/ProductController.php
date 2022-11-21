<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function view()
    {
        $this->authorize('create', Product::class);

        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function viewCart()
    {

        return view('admin.products.cart');
    }

    public function viewOrder(Order $order)
    {
        $this->authorize('create', Product::class);
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }


    public function create()
    {

        return view('admin.products.create');
    }

    public function edit(Product $product)
    {

        return view('admin.products.edit')->with('product', $product);
    }
    public function show(Product $product)
    {

        return view('admin.products.show', compact('product'));
    }

    public function store(ProductRequest $request)
    {

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;


        $product->price =  $request->price;


        $product->discount_price = $request->discount_price;



        $product->vat = $request->vat;
        if ($request->image) {
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return redirect(route('admin.products.index'))->with('statusCreate', __('Het product: "' . $product->name . '" is toegevoegd!'));
    }


    public function update(Product $product, ProductRequest $request)
    {

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->vat = $request->vat;

        if ($request->image) {
            unlink(public_path('/images/' . $product->image));
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return redirect()->route('admin.products.index')->with('statusUpdate', __('Het product: "' . $product->name . '" is aangepast!'));
    }

    public function destroy(Product $product)
    {


        unlink(public_path('/images/' . $product->image));

        $product->delete();

        return redirect()->route('admin.products.index')->with('statusDelete', 'Het product "' . $product->name . '"  is verwijderd!');
    }
}
