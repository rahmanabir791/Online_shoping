<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    public function addProduct()
    {
        return view('admin.product.add');
    }

    public function newProduct(Request $request)
    {
        Product::newProduct($request);
        return redirect()->back()->with('message', 'Product created successfully.');
    }

    public function manageProduct()
    {
        return view('admin.product.manage', [
            'products' => Product::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function editProduct($id)
    {
        return view('admin.product.edit', [
            'product'   => Product::find($id),
        ]);
    }
    public function deleteProduct($id)
    {
        $this->product = Product::find($id);
        if (file_exists($this->product->image))
        {
            unlink($this->product->image);
        }
        $this->product->delete();
        return redirect()->back()->with('message', 'product deleted successfully');
    }

    public function updateProduct (Request $request, $id)
    {
        Product::updateProduct($request, $id);
        return redirect('/manage-product')->with('message', 'product updated successfully');
    }
}
