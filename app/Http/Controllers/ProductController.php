<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\ProductAdded;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use File;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
     /**
     * Display all active product
     */
    public function adminAllProduct()
    {
        $all = Product::latest()->get();
        return view('admin.product_manage.all_product', compact('all'));
    }

    /**
     * admin create product
     */
    public function adminAddProduct()
    {
        return view('admin.product_manage.add_product');
    }


    /**
     * admin store product
     */
    public function adminStoreProduct(Request $request)
    {


        $this->validate($request,[

            'category_id' => 'required',
            'product_name' => 'required|string',
            'product_sel_price' => 'required',
            'product_quantity' => 'required',
        ]);

        $slug = Str::slug($request->product_name);

        $id = Product::insertGetId([
            'product_name' => $request->product_name,
            'product_slug' => $slug,
            'category_id' => $request->category_id,
            'product_sel_price' => $request->product_sel_price,
            'product_quantity' => $request->product_quantity,
            'created_at' => Carbon::now(),

        ]);

        if ($request->hasFile('product_thumbnail')) {

            $manager = new ImageManager(new Driver());

            $image = $manager->read($request->file('product_thumbnail'));

            $customeName = "PP".".".rand().time().".".$request->file('product_thumbnail')->getClientOriginalExtension();
            $path = public_path('uploads/product/'.$customeName);
            $image->save($path);

            Product::where('id', $id)->update([
                'product_thumbnail' => $customeName,
            ]);
        }

        // send update all user about new product added by mail
        $all_user = User::all();

        foreach ($all_user as $user) {

           dispatch(new SendEmail($user, $id));
        }


        $notification = array(
            'message' => "Product Added Successfully",
            'alert-type' => "success",
        );

        return redirect()->route('admin.all.product')->with($notification);

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function adminEditProduct(string $slug)
    {
        $data = Product::where('product_slug', $slug)->first();
        return view('admin.product_manage.edit_product', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function adminUpdateProduct(Request $request)
    {

        $this->validate($request,[
            'category_id' => 'required',
            'product_name' => 'required|string',
            'product_sel_price' => 'required',
            'product_quantity' => 'required',
        ]);

        $slug = Str::slug($request->product_name);

        $id = Product::where('product_slug', $request->slug)->update([

            'product_name' => $request->product_name,
            'product_slug' => $slug,
            'product_sel_price' => $request->product_sel_price,
            'product_quantity' => $request->product_quantity,
            'updated_at' => Carbon::now(),

        ]);

        if ($request->hasFile('product_thumbnail')) {

            $old_image = Product::where('product_slug', $request->slug)->value('product_thumbnail');

            // delete old image
            if(File::exists(public_path('uploads/product/'.$old_image))){
                File::delete(public_path('uploads/product/'.$old_image));
            }

            $manager = new ImageManager(new Driver());

            $image = $manager->read($request->file('product_thumbnail'));

            $customeName = "PP".".".rand().time().".".$request->file('product_thumbnail')->getClientOriginalExtension();
            $path = public_path('uploads/product/'.$customeName);
            $image->save($path);

            Product::where('product_slug', $slug)->update([
                'product_thumbnail' => $customeName,
            ]);
        }


        $notification = array(
            'message' => "Product Updated Successfully",
            'alert-type' => "success",
        );

        return redirect()->route('admin.all.product')->with($notification);

    }

    /**
     * Recycle the specified resource from storage.
     */
    public function adminDeleteProduct(string $slug)
    {
        $update = Product::where('product_slug', $slug)->update([
            'deleted_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'product_editor_id' => Auth::user()->user_id,
        ]);

        if($update){
            $notification = array(
                'message' => "Product Move To Trash Successfully",
                'alert-type' => "success",
            );

        }else{
            $notification = array(
                'message' => "Opps, Something is Wrong",
                'alert-type' => "error",
            );
        }
        return back()->with($notification);

    }

    /**
     * Show All Delete or Recycle Item.
     */
    public function recycle()
    {
        $all = Product::whereNotNull('deleted_at')->latest()->get();
        return view('admin.product_manage.all_recycle_product', compact('all'));
    }

    /**
     * Permanently delete from storage.
     */
    public function restore(string $slug)
    {
        $update = Product::where('product_slug', $slug)->update([
            'deleted_at' => null,
            'updated_at' => Carbon::now(),
            'product_editor_id' => Auth::user()->user_id,
        ]);

        if($update){
            $notification = array(
                'message' => "Product Restore Successfully",
                'alert-type' => "success",
            );

        }else{
            $notification = array(
                'message' => "Opps, Something is Wrong",
                'alert-type' => "error",
            );
        }
        return back()->with($notification);

    }

     /**
     * Permanently Delete Item.
     */
    public function permanentlyDelete($slug)
    {

        $product = Product::where('product_slug', $slug)->first();

        // delete thumbnail image folder
        $image = $product->product_thumbnail;
        if(File::exists(public_path('uploads/product/'.$image))){
            File::delete(public_path('uploads/product/'.$image));
        }

        $delete = Product::where('product_slug', $slug)->delete();

        if($delete){
            $notification = array(
                'message' => "Product Permanently Deleted Successfully",
                'alert-type' => "success",
            );

        }else{
            $notification = array(
                'message' => "Opps, Something is Wrong",
                'alert-type' => "error",
            );
        }
        return redirect()->route('admin.all.product')->with($notification);
    }
}
