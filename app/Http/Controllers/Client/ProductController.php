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
use App\Models\History;
use App\Helper\Helper;

class ProductController extends Controller
{
	public function getDetailProduct(Request $request, $id){
		$data['product'] = Product::find($id);
		$data['product_image'] = Product::join('product_media','product.id','=','product_media.product_id')
								->join('media','media.id','=','product_media.media_id')
								->where('product.id','=',$id)
								->select('media.url','product.*')
								->get();
		// dd($data['product_image']);
		$data['product_image1'] = Product::join('product_media','product.id','=','product_media.product_id')
								->join('media','media.id','=','product_media.media_id')
								->where('product.id','=',$id)
								->select('media.url','product.*','product_media.*')
								->get();
		$data['product_category'] = Product::join('category_link','product.id','=','category_link.link_id')
								->join('category','category_link.category_id','=','category.id')
								->where('category_link.type','=',2)
								->where('product.id',$id)
								->select('category.name','category_link.*')
								->get();
		$data['menu'] =Menu::find($id);
		$data['related'] = Product::where('id','<>',$id)->limit(6)->get();
		// $data['related_rating'] = Comment::join('product','product.id','=','comment.product_id')
  //           ->avg('comment.member_rate'); // lấy trung bình sao
  //           // echo $rating;
  //           $data['related_rating']  = round($data['related_rating']); 
        // dd($data['related_rating']);
        
		//đánh giá sao
    $data['rating'] =Comment::where('product_id',$id)->where('status',2)
    ->avg('member_rate'); // lấy trung bình sao
    // echo $rating;
    $data['rating']  = round($data['rating']); //round(): làm tròn giá trị
    // dd($data['rating']);
    //nguoi dung danh gia
    $data['user_comment'] = Comment::where('product_id',$id)->where('status',2)->get();

    //get log page
    $api_history = Helper::GetApi('https://www.iplocate.io/api/lookup/');

    $history_array = json_decode($api_history, true); //json_decode: chuyen doi chuoi json sang array
  
    $data['history'] = new History();
    $data['history']->link_id = $request->id;
    $data['history']->type = 2;
    $data['history']->location =$history_array['city'].','.$history_array['country'];
    $data['history']->ip = $history_array['ip'];
    $data['history']->save();

    $data['product-count'] = Product::find($id);
    $data['product-count']->count += 1;
    $data['product-count']->save();
		return view('Client.Shop.detail-shop',$data);
	}
	public function getListProduct(Request $request,$id){
		$data['list_product_with_category'] = Product::join('category_link','product.id','=','category_link.link_id')
					->where('category_link.category_id',$id)
					->get();
		// dd($data['list_product_with_category']);
		$data['count_product'] = Product::join('category_link','product.id','=','category_link.link_id')
					->where('category_link.category_id',$id)
					->count();
		$data['post_recent'] = Post::orderBy('id','desc')->limit(3)->get();
    $api_history = Helper::GetApi('https://www.iplocate.io/api/lookup/');
    $history_array = json_decode($api_history, true); //json_decode: chuyen doi chuoi json sang array
  
    $data['history'] = new History();
    $data['history']->link_id = $request->id;
    $data['history']->type = 4;
    $data['history']->location =$history_array['city'].','.$history_array['country'];
    $data['history']->ip = $history_array['ip'];
    $data['history']->save();


		return view('Client.Shop.shop',$data);
	}
	//đánh giá sao
	public function postInserRating(Request $req){
		$this->validate($req,
          [
           
            // 'index'=>'required',
            'lastname'=>'required|max:255',
            'firstname'=>'required|max:255',
            'email'=>'required|max:100',
          ],
          [
           // 'index.required'=>'Mời nhập thông tin bên dưới !!!',
           'lastname.required'=>'Không được trống !!!',
           'lastname.max'=>'Nhập tối đa 255 kí tự !!!',
           'firstname.required'=>'Không được trống !!!',
           'firstname.max'=>'Nhập tối đa 255 kí tự !!!',
           'email.required'=>'Không được trống !!!',
           'email.max'=>'Nhập tối đa 255 kí tự !!!',
          ]);
        $data = $req->all();
        // dd($data);
         $rating = DB::table('comment')->insertGetId(
            array(
            	'product_id' => $req->product_id,
            	'status'=>1,
            	'member_rate' => $req['index'],
            	'content' => $req['message'],
            	'lastname' => $req['lastname'],
            	'firstname' => $req['firstname'],
            	'email' => $req['email'],
            	'created_at' => Carbon::now(),
            )
        );

        // $rating = new Comment();
        // $rating->product_id = $req->product_id;
        // $rating->status =1;
        // $rating->member_rate =$req['index'];
        // $rating->content =$req['message'];
        // $rating->created_at = Carbon::now();
        // $rating->save();
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['rating'] = $rating;
        return response()->json($respon);
        // }
    }
	public function getShoppingCart(Request $request){
		
		return view('Client.Shop.shopping-cart');
	}
	public function getCheckout(Request $request){
		
		return view('Client.Shop.checkout');
	}
}
