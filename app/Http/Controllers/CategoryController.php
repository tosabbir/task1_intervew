<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Category::latest()->get();
        return view('admin.category.all_category', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|string|max:50|unique:categories',
        ]);

        $slug = Str::slug($request->category_name);

        $insert = category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'created_at' => Carbon::now(),

        ]);

        if ($insert) {
            $notification = array(
                'message' => "Category Added Successfully",
                'alert-type' => "success",
            );
        } else {
            $notification = array(
                'message' => "Opps, Something is Wrong",
                'alert-type' => "error",
            );
        }

        return redirect()->route('admin.all.category')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $data = Category::where('category_slug', $slug)->firstOrFail();
        return view('admin.category.edit_category', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'category_name' => 'required|string|max:50|unique:categories,category_name,' . $id . ',category_id',
        ]);



        $slug = Str::slug($request->category_name);

        $update = Category::where('category_id', $id)->update([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'updated_at' => Carbon::now(),

        ]);

        if ($update) {
            $notification = array(
                'message' => "Category Updated Successfully",
                'alert-type' => "success",
            );
        } else {
            $notification = array(
                'message' => "Opps, Something is Wrong",
                'alert-type' => "error",
            );
        }
        return redirect()->route('admin.all.category')->with($notification);

    }


    /**
     * Permanently Delete Item.
     */
    public function permanentlyDelete($slug)
    {

        $delete = Category::where('category_slug', $slug)->delete();

        if ($delete) {

            $notification = array(
                'message' => "Category Permanently Deleted With Subcategory Successfully",
                'alert-type' => "success",
            );
        } else {
            $notification = array(
                'message' => "Opps, Something is Wrong",
                'alert-type' => "error",
            );
        }
        return redirect()->route('admin.all.category')->with($notification);
    }
}
