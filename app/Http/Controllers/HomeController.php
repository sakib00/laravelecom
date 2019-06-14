<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ProductRating;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(){

     	// $user = Auth::user();
     	// dd($user);

    	$products = DB::table('products')->get();
        return view('home', ['products' => $products]);
    }

	public function productDetails($productid){
		$data = DB::table('products')->where('product_row_id', $productid)->first();
		$product_ratings = ProductRating::all();
		return view('product_detail', ['data'=>$data, 'product_ratings'=>$product_ratings]);
	}
	public function submitRating(Request $request){
		//dd($request);

    	$rating_data = $request->all();

		$productRating_model = new ProductRating();

		$pid = $request->product_id;
		$productRating_model->user_id = 0;
		$productRating_model->product_id = $request->product_id;
		$productRating_model->name = $request->name;
		$productRating_model->email = $request->email;
		$productRating_model->rating = $request->rating;
		$productRating_model->reviews = $request->comment;

		if($productRating_model->save() == true){
			$insertedId = $productRating_model->id;
			return view('show_review_ajax',['product_ratings'=> $rating_data, 'insertedId'=>$insertedId]);
		}
	}
}
