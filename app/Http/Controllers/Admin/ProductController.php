<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = Product::all()->sortDesc();
        return view('admin/product', $result);
    }


    public function add(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
            'slug' => 'required|unique:products,slug',
            'cid' => 'required',
            'stock' => 'required',
            'featured' => 'required',
            'image' => 'required|mimes:jped,jpg,png',
            'short_desc' => 'required',
            'desc' => 'required',
            'keywords' => 'required',
        ]);
        DB::beginTransaction();
        $model = new Product();
        $model->name = $request->post('product_name');
        $model->slug = $request->post('slug');
        $model->cid = $request->post('cid');
        $model->stock = $request->post('stock');
        $model->featured = $request->post('featured');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $request->post('slug') . '.' . $ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }

        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->status = '1';
        $model->save();
        $pid = $model->id;


        // Product Attribute start
        $skuArr = $request->post('sku');
        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('quantity');
        $sizeArr = $request->post('size');
        $colorArr = $request->post('color');

        foreach ($skuArr as $key => $val) {
            $productAttrArr['pid'] = $pid;
            $productAttrArr['sku'] = $skuArr[$key];
            // $productAttrArr['attr_img'] = 'test';
            $productAttrArr['mrp'] = $mrpArr[$key];
            $productAttrArr['price'] = $priceArr[$key];
            $productAttrArr['qty'] = $qtyArr[$key];
            $productAttrArr['size_id'] = $sizeArr[$key];
            $productAttrArr['color_id'] = $colorArr[$key];

            if ($request->hasFile("attrimg." . $key)) {
                // die('ss');
                $rand = rand('111111111', '999999999');
                $attrimage = $request->file("attrimg." . $key);
                $ext = $attrimage->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("attrimg." . $key)->storeAs('/public/media', $image_name);
                $productAttrArr['attr_img'] = $image_name;
            } else {
                $productAttrArr['attr_img'] = '';
            }

            DB::table('product_attr')->insert($productAttrArr);
        }
        // Product Attribute ends


        // Product images start
        $piidArr = $request->post('piid');
        foreach ($piidArr as $key => $val) {
            $productImgAttrArr['pid'] = $pid;
            if ($request->hasFile("productimg." . $key)) {
                $attrimage = $request->file("productimg." . $key);
                $ext = $attrimage->extension();
                $image_name = time() . '.' . $ext;
                $request->file("productimg." . $key)->storeAs('/public/media', $image_name);
                $productImgAttrArr['images'] = $image_name;
            }
            DB::table('product_images')->insert($productImgAttrArr);
        }
        // Product images ends
        DB::commit();
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
        $result['productAttrArr'] = '';
        $result['productImageArr'] = '';
        return view('admin/manage_product', $result);
    }

    public function edit(Request $request, $slug)
    {
        $result['data'] = Product::where(['slug' => $slug])->get();
        $result['category'] = DB::table('categories')->where(['status' => 1])->get();
        $result['color'] = DB::table('colors')->where(['status' => 1])->get();
        $result['size'] = DB::table('sizes')->where(['status' => 1])->get();
        $product = DB::table('products')->where(['slug' => $slug])->get();
        $result['productAttrArr'] = DB::table('product_attr')->where(['pid' => $product[0]->id])->get();
        $result['productImageArr'] = DB::table('product_images')->where(['pid' => $product[0]->id])->get();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('admin/manage_product', $result);
    }

    public function update(Request $request)
    {

        // echo "<pre>";
        // print_r($_FILES);
        // prx($_POST);
        $request->validate([
            'product_name' => 'required',
            'slug' => 'required|unique:products,slug,' . $request->post('pid'),
            'cid' => 'required',
            'stock' => 'required',
            'featured' => 'required',
            'image' => 'mimes:jped,jpg,png',
            'short_desc' => 'required',
            'desc' => 'required',
            'keywords' => 'required',
        ]);

        $model = Product::find($request->post('pid'));

        $model->name = $request->post('product_name');
        $model->slug = $request->post('slug');
        $model->cid = $request->post('cid');
        $model->stock = $request->post('stock');
        $model->featured = $request->post('featured');

        if ($request->hasFile('image')) {
            if (Storage::exists('public/media/' . $model->image)) {
                Storage::delete('public/media/' . $model->image);
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = $request->post('slug') . '.' . $ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }

        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->status = '1';
        $model->save();

        // Product Attribute start
        $paidArr = $request->post('paid');
        $skuArr = $request->post('sku');
        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('quantity');
        $sizeArr = $request->post('size');
        $colorArr = $request->post('color');
        foreach ($skuArr as $key => $val) {
            $productAttrArr['pid'] = $request->post('pid');
            $productAttrArr['sku'] = $skuArr[$key];
            $productAttrArr['mrp'] = $mrpArr[$key];
            $productAttrArr['price'] = $priceArr[$key];
            $productAttrArr['qty'] = $qtyArr[$key];
            $productAttrArr['size_id'] = $sizeArr[$key];
            $productAttrArr['color_id'] = $colorArr[$key];
            // echo '<pre>';
            // print_r($productAttrArr);
            // die();

            if ($request->hasFile("attrimg." . $key)) {
                $rand = rand(1111111111, 9999999999);
                $attrimage = $request->file("attrimg." . $key);
                $ext = $attrimage->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("attrimg." . $key)->storeAs('/public/media', $image_name);
                $productAttrArr['attr_img'] = $image_name;
            }

            if ($paidArr[$key] != "") {
                // die('ss');
                DB::table('product_attr')->where(['id' => $paidArr[$key]])->update($productAttrArr);
            } else {
                DB::table('product_attr')->insert($productAttrArr);
            }
        }
        // Product Attribute ends


        // Product images start
        $piidArr = $request->post('piid');
        foreach ($piidArr as $key => $val) {
            $productImgArr['pid'] = $request->post('pid');
            if ($request->hasFile("productimg." . $key)) {
                $rand = rand(1111111111, 9999999999);
                $attrimage = $request->file("productimg." . $key);
                $ext = $attrimage->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("productimg." . $key)->storeAs('/public/media', $image_name);
                $productImgArr['images'] = $image_name;
            }
            if ($piidArr[$key] != "") {
                DB::table('product_images')->where(['id' => $piidArr[$key]])->update($productImgArr);
            } else {
                DB::table('product_images')->insert($productImgArr);
            }
        }
        // Product images ends



        return redirect('admin/product/product-list')->with('update_msg', "Product updated successfully:)");
    }


    public function deleteAttr(Request $request, $id, $slug)
    {
        $removeImg = DB::table('product_attr')->where(['id' => $id])->get();
        if (Storage::exists('public/media/' . $removeImg[0]->attr_img)) {
            Storage::delete('public/media/' . $removeImg[0]->attr_img);
        }
        DB::table('product_attr')->where(['id' => $id])->delete();
        return redirect('admin/product/edit-product/' . $slug);
    }


    public function deleteimage(Request $request, $id, $slug)
    {
        $removeImg = DB::table('product_images')->where(['id' => $id])->get();
        if (Storage::exists('public/media/' . $removeImg[0]->images)) {
            Storage::delete('public/media/' . $removeImg[0]->images);
        }
        DB::table('product_images')->where(['id' => $id])->delete();
        return redirect('admin/product/edit-product/' . $slug);
    }

    public function delete(Request $request, $id)
    {
        $model = Product::find($id);
        DB::table('product_attr')->where(['pid' => $id])->delete();
        DB::table('product_images')->where(['pid' => $id])->delete();
        if (Storage::exists('public/media/' . $model->image)) {
            Storage::delete('public/media/' . $model->image);
        }
        $removeattrImg = DB::table('product_attr')->where(['id' => $id])->get();
        if (Storage::exists('public/media/' . $removeattrImg[0]->attr_img)) {
            Storage::delete('public/media/' . $removeattrImg[0]->attr_img);
        }
        $removeImg = DB::table('product_images')->where(['id' => $id])->get();
        if (Storage::exists('public/media/' . $removeImg[0]->images)) {
            Storage::delete('public/media/' . $removeImg[0]->images);
        }
        $model->delete();
        return redirect('admin/product/product-list')->with('delete_msg', "Product deleted successfully!");
    }

    public function status(Request $request, $type, $id)
    {
        if ($type == 'activate') {
            $model = Product::find($id);
            $model->status = '1';
            $model->save();
            return redirect('admin/product/product-list')->with('activate_msg', "Product activated successfully!");
        } elseif ($type == 'deactivate') {
            $model = Product::find($id);
            $model->status = '0';
            $model->save();
            return redirect('admin/product/product-list')->with('deactivate_msg', "Product deactivated successfully!");
        }
    }
}
