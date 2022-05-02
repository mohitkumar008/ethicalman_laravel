<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = Product::all();
        return view('admin/product', $result);
    }


    public function add(Request $request)
    {
        // echo '<pre>';
        // print_r($request->post());
        // die();
        $request->validate([
            'product_name' => 'required',
            'slug' => 'required|unique:products,slug',
            'mrp' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'cid' => 'required',
            'stock' => 'required',
            'featured' => 'required',
            'sku' => 'required',
            'image' => 'required|mimes:jped,jpg,png',
            'gallery_img' => 'required',
            'short_desc' => 'required',
            'desc' => 'required',
            'keywords' => 'required',
        ]);

        $model = new Product();
        $model->name = $request->post('product_name');
        $model->slug = $request->post('slug');
        $model->mrp = $request->post('mrp');
        $model->price = $request->post('price');
        $model->quantity = $request->post('quantity');
        $model->cid = $request->post('cid');
        $model->stock = $request->post('stock');
        $model->featured = $request->post('featured');
        $model->sku = $request->post('sku');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $request->post('slug') . '.' . $ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }

        $model->image_gallery = $request->file('gallery_img');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->status = '1';
        $model->save();
        return redirect('admin/product/product-list')->with('add_msg', "Product added successfully:)");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result['category'] = DB::table('categories')->where(['status' => 1])->get();
        $result['color'] = DB::table('colors')->where(['status' => 1])->get();
        $result['size'] = DB::table('sizes')->where(['status' => 1])->get();
        return view('admin/manage_product', $result);
    }

    public function edit(Request $request, $slug)
    {
        $result['data'] = Product::where(['slug' => $slug])->get();
        $result['category'] = DB::table('categories')->where(['status' => 1])->get();
        return view('admin/manage_product', $result);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'slug' => 'required|unique:products,slug,' . $request->post('pid'),
            'mrp' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'cid' => 'required',
            'stock' => 'required',
            'featured' => 'required',
            'sku' => 'required',
            'image' => 'mimes:jped,jpg,png',
            'gallery_img' => 'mimes:jped,jpg,png',
            'short_desc' => 'required',
            'desc' => 'required',
            'keywords' => 'required',
        ]);

        $model = Product::find($request->post('pid'));

        $model->name = $request->post('product_name');
        $model->slug = $request->post('slug');
        $model->mrp = $request->post('mrp');
        $model->price = $request->post('price');
        $model->quantity = $request->post('quantity');
        $model->cid = $request->post('cid');
        $model->stock = $request->post('stock');
        $model->featured = $request->post('featured');
        $model->sku = $request->post('sku');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $request->post('slug') . '.' . $ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }

        if ($request->hasFile('gallery_img')) {
            $model->image_gallery = $request->file('gallery_img');
        }

        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->status = '1';
        $model->save();
        return redirect('admin/product/product-list')->with('update_msg', "Product updated successfully:)");
    }


    public function delete(Request $request, $id)
    {
        $model = Product::find($id);
        $model->delete();
        return redirect('admin/category')->with('delete_cat_msg', "Category deleted successfully!");
    }

    public function status(Request $request, $type, $id)
    {
        if ($type == 'activate') {
            $model = Product::find($id);
            $model->status = '1';
            $model->save();
            return redirect('admin/category')->with('activate_msg', "Category activated successfully!");
        } elseif ($type == 'deactivate') {
            $model = Product::find($id);
            $model->status = '0';
            $model->save();
            return redirect('admin/category')->with('deactivate_msg', "Category deactivated successfully!");
        }
    }
}
