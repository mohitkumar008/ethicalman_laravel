<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data'] = Color::all();
        return view('admin/color', $result);
    }


    public function add(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'color_slug' => 'required|unique:colors,slug',
        ]);

        $model = new Color();
        $model->color = $request->post('color');
        $model->slug = $request->post('color_slug');
        $model->status = '1';
        $model->save();
        return redirect('admin/product/color')->with('add_color_msg', "Color added successfully:)");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/manage_color');
    }

    public function edit(Request $request, $id)
    {
        $result['data'] = Color::where(['id' => $id])->get();
        return view('admin/manage_color', $result);
        // echo '<pre>';
        // print_r($result['data'][0]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'color_slug' => 'required|unique:colors,slug,' . $request->post('colorid'),
        ]);

        $model = Color::find($request->post('colorid'));
        $model->color = $request->post('color');
        $model->slug = $request->post('color_slug');
        $model->save();
        return redirect('admin/product/color')->with('update_color_msg', "Color updated successfully:)");
    }


    public function delete(Request $request, $id)
    {
        $model = Color::find($id);
        $model->delete();
        return redirect('admin/product/color')->with('delete_color_msg', "Color deleted successfully!");
    }

    public function status(Request $request, $type, $id)
    {
        if ($type == 'activate') {
            $model = Color::find($id);
            $model->status = '1';
            $model->save();
            return redirect('admin/product/color')->with('activate_msg', "Color activated successfully!");
        } elseif ($type == 'deactivate') {
            $model = Color::find($id);
            $model->status = '0';
            $model->save();
            return redirect('admin/product/color')->with('deactivate_msg', "Color deactivated successfully!");
        }
    }
}
