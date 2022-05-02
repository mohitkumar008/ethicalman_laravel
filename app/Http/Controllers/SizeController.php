<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data'] = Size::all();
        return view('admin/size', $result);
    }


    public function add(Request $request)
    {
        $request->validate([
            'size' => 'required|unique:sizes,size',
        ]);

        $model = new Size();
        $model->size = $request->post('size');
        $model->status = '1';
        $model->save();
        return redirect('admin/product/size')->with('add_size_msg', "Size added successfully:)");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/manage_size');
    }

    public function edit(Request $request, $id)
    {
        $result['data'] = Size::where(['id' => $id])->get();
        return view('admin/manage_size', $result);
        // echo '<pre>';
        // print_r($result['data'][0]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'size' => 'required|unique:sizes,size,' . $request->post('sizeid'),
        ]);

        $model = Size::find($request->post('sizeid'));
        $model->size = $request->post('size');
        $model->save();
        return redirect('admin/product/size')->with('update_size_msg', "Size updated successfully:)");
    }


    public function delete(Request $request, $id)
    {
        $model = Size::find($id);
        $model->delete();
        return redirect('admin/product/size')->with('delete_size_msg', "Size deleted successfully!");
    }

    public function status(Request $request, $type, $id)
    {
        if ($type == 'activate') {
            $model = Size::find($id);
            $model->status = '1';
            $model->save();
            return redirect('admin/product/size')->with('activate_msg', "Size activated successfully!");
        } elseif ($type == 'deactivate') {
            $model = Size::find($id);
            $model->status = '0';
            $model->save();
            return redirect('admin/product/size')->with('deactivate_msg', "Size deactivated successfully!");
        }
    }
}
