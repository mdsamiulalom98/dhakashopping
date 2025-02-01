<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Brian2694\Toastr\Facades\Toastr;
class BlogCategoryController extends Controller
{
    function __construct()
    {
         // $this->middleware('permission:banner-category-list|banner-category-create|banner-category-edit|banner-category-delete', ['only' => ['index','store']]);
         // $this->middleware('permission:banner-category-create', ['only' => ['create','store']]);
         // $this->middleware('permission:banner-category-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:banner-category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = BlogCategory::orderBy('id','DESC')->get();
        return view('backEnd.blog.category.index',compact('data'));
    }
    public function create()
    {
        $categories = BlogCategory::orderBy('id','DESC')->select('id','name')->get();
        return view('backEnd.blog.category.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        BlogCategory::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('blog_category.index');
    }

    public function edit($id)
    {
        $edit_data = BlogCategory::find($id);
        return view('backEnd.blog.category.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $update_data = BlogCategory::find($request->id);
        $input = $request->all();
        $input['status'] = $request->status?1:0;
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('blog_category.index');
    }

    public function inactive(Request $request)
    {
        $inactive = BlogCategory::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = BlogCategory::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = BlogCategory::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
