<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

      /**
     * find product details
     */
    public function productDetails($slug)
    {

       $product = Product::where('product_slug', $slug)->first();

       return view('product_details', compact('product'));
    }

}
