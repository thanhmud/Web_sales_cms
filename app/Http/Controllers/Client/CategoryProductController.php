<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryLink;
use App\Models\Subscriber;
use App\Models\TagLink;
use Carbon\Carbon;
use Auth;
use DB;
class CategoryProductController extends Controller
{
	public function getListCategoryProduct($id){
		$data['category'] = CategoryLink::find($id);
		$data['menu'] =Menu::find($id); 
		return view('Client.Shop.shop',$data);
	}
	// public function index(){
 //    	return view('Client.Shop.shop');
	// }
	// public function getDetailShop(){
 //    	return view('Client.Shop.detail-shop');
	// }
	// public function getShoppingCart(){
 //    	return view('Client.Shop.shopping-cart');
	// }
	// public function getCheckout(){
 //    	return view('Client.Shop.checkout');
	// }
}
