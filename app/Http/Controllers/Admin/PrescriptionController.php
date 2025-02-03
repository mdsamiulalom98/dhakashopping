<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Prescription;

class PrescriptionController extends Controller
{


    public function index(Request $request)
    {
        $show_data = Prescription::orderBy('id','DESC')->get();
        return view('backEnd.prescription.index',compact('show_data'));
    }

    public function view($id)
    {
        $view_data = Prescription::find($id);
        return view('backEnd.prescription.view',compact('view_data'));
    }
    public function ajax_view(Request $request)
    {
        $data = Prescription::find($request->id);
        return view('backEnd.prescription.ajax_prescription',compact('data'));
    }

    public function inactive(Request $request)
    {
        $inactive = Prescription::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Prescription::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Prescription::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
