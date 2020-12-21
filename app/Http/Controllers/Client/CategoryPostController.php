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

class CategoryPostController extends Controller
{
	public function getListCategoryPost(Request $request, $id){
		
		$data['list_post_with_category'] = Post::join('category_link','post.id','=','category_link.link_id')
										->join('category','category.id','=','category_link.link_id')
										->join('media','post.media_id','=','media.id')
					->where('category_link.category_id',$id)
					->get();

		// dd($data['list_post_with_category']);
		// $data['list_post_with_img'] = Post::join('media','post.media_id','=','media.id')
									
		// 							->get();
		// // dd($data['list_post_with_img']);
		$data['list_post_with_user'] = Post::join('users','post.user_id','=','users.id')->get();
		//get log page
    	$api_history = Helper::GetApi('https://www.iplocate.io/api/lookup/');

    	$history_array = json_decode($api_history, true);
		$data['history'] = new History();
	    $data['history']->link_id = $request->id;
	    $data['history']->type = 3;
	    $data['history']->location =$history_array['city'].','.$history_array['country'];
	    $data['history']->ip = $history_array['ip'];
	    $data['history']->save();

		return view('Client.Blog.list-blog-category',$data);
	}
	
}
