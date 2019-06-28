<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Models\Product;
use App\Models\Common;

use Session;
use DB;
use Excel;
use Illuminate\Support\Facades\Input;

use Validator;


class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin-auth');
    }

	public function index()
    {             		 
		
	     $data['products_list'] = \App\Models\Product::with('category_info')->get();
      $common_model = new Common();                         
      $data['categories_list'] = $common_model->allCategories(); 
                                   
	  return view('admin.product.index', ['data'=>$data]);
        //   
    }
	
	function create() {
      $common_model = new Common();                         
      $data['categories_list'] = $common_model->allCategories();       
	  return view('admin.product.create', ['data'=>$data]);	   
	}
}
