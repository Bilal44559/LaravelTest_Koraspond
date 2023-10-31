<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use function apiResponse;

class ProductController extends Controller
{
    function index()
    {
        return $response = apiResponse('success', 'Product found', 200,  Product::all());
    }
    function get($id)
    {
        return $response = apiResponse('success', 'Product found', 200,  Product::find($id));
    }
    function save(Request $request)
    {
        $request->validate(['name' => 'required', 'arabic_name' => 'required', 'price' => 'required', 'stock' => 'required']);
        $product = new Product();
        $product->name = $request->name;
        $product->arabic_name = $request->arabic_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return $response = apiResponse('success', 'Product Saved Successfully', 200,  $product);
    }
    function update(Request $request)
    {
        $request->validate(['name' => 'required', 'arabic_name' => 'required', 'price' => 'required', 'stock' => 'required']);
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->arabic_name = $request->arabic_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return $response = apiResponse('success', 'Product Updated Successfully', 200,  $product);
    }
    function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $response = apiResponse('success', 'Product deleted successfully', 200);
    }


    function saveOrder(Request $request)
    {
        try {
            //code...
            $grandTotal = $request->grandTotal;
            $ordertosave = $request->order;

            $order = new Order();
            $order->number = Order::count() + 1;
            $order->total = $grandTotal;
            $order->save();

            foreach ($ordertosave as $key => $item) {
                $orderProduct = new OrderProduct();
                $orderProduct->product_id = $item['product_id'];
                $orderProduct->order_id = $order['id'];
                $orderProduct->qty = $item['qty'];
                $orderProduct->price = $item['price'];
                $orderProduct->save();
            }
            return $response = apiResponse('success', 'Order Saved Successfully', 200);
        } catch (Exception $e) {
            return $response = apiResponse('success', $e->getMessage(), 200);
        }
    }
}
