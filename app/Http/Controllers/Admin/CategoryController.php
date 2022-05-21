<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $result['data'] = Category::all()->sortDesc();
        return view('admin/category', $result);
    }


    public function add(Request $request)
    {
        $request->validate([
            'catname' => 'required',
            'catslug' => 'required|unique:categories,category_slug',
        ]);

        $model = new Category();
        $model->category_name = $request->post('catname');
        $model->category_slug = $request->post('catslug');
        $model->save();
        return redirect('admin/category')->with('add_cat_msg', "Category added successfully:)");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/manage_category');
    }

    public function edit(Request $request, $id)
    {
        $result['data'] = Category::where(['id' => $id])->get();
        return view('admin/manage_category', $result);
        // echo '<pre>';
        // print_r($result['data'][0]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'catname' => 'required',
            'catslug' => 'required|unique:categories,category_slug,' . $request->post('catid'),
        ]);

        $model = Category::find($request->post('catid'));
        $model->category_name = $request->post('catname');
        $model->category_slug = $request->post('catslug');
        $model->save();
        return redirect('admin/category')->with('update_cat_msg', "Category updated successfully:)");
    }


    public function delete(Request $request, $id)
    {
        $model = Category::find($id);
        $model->delete();
        return redirect('admin/category')->with('delete_cat_msg', "Category deleted successfully!");
    }

    public function status(Request $request, $type, $id)
    {
        if ($type == 'activate') {
            $model = Category::find($id);
            $model->status = '1';
            $model->save();
            return redirect('admin/category')->with('activate_msg', "Category activated successfully!");
        } elseif ($type == 'deactivate') {
            $model = Category::find($id);
            $model->status = '0';
            $model->save();
            return redirect('admin/category')->with('deactivate_msg', "Category deactivated successfully!");
        }
    }
}
