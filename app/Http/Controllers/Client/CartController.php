<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Cart;

class CartController extends Controller
{
    public function save_cart(Request $request){
    	$productId = $request->productid_hidden;
    	$quantity = $request ->quantity;
		$product_info = DB::table('product')->join('media','media.id','=','product.product_media_id')
											->where('product.id',$productId)->first();

		$data['id'] =  $product_info->id;
		$data['qty'] = $quantity;
		$data['name'] =  $product_info->title;
		$data['price'] =  $product_info->price;
		$data['weight'] =  $product_info->price;
		$data['options']['image'] =  $product_info->url;
		Cart::add($data);
		// Cart::destroy();

    	return view('Client.Shop.shopping-cart');
    }

     public function delete($rowId)
    {
       Cart::update($rowId, 0);
       return view('Client.Shop.shopping-cart');
    }
}
