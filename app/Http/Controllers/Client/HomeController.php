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
use App\Models\Slide;
use Carbon\Carbon;
use Auth;
use DB;

class HomeController extends Controller
{
	public function index(){
		$data['menu'] = Menu::all();
		$data['slide'] = Slide::all();
    	return view('Client.Page.index',$data);
	}
	// public function getDetailPost($id){
	// 	$data['post_pre'] = Post::where('id','<>',$id)->inRandomOrder()->limit(1)->get();
	// 	$data['post_next'] = Post::where('id','<>',$id)->inRandomOrder()->limit(1)->get();
	// 	$data['post_related'] = Post::where('id','<>',$id)->inRandomOrder()->limit(2)->get();
	// 	$data['post_laster'] = Post::orderBy('id','desc')->limit(3)->get();
	// 	$data['post'] = Post::find($id);	
	// 	$data['menu'] =Menu::find($id);

	// 	$data['tags'] = TagLink::join('post','post.id','=','tag_link.post_id')
	// 				->join('tag','tag.id','=','tag_link.link_id')
	// 				->where('tag_link.post_id',$id)
	// 				->select('tag.*','tag_link.*')
	// 				->get();

	// 	$data['list_tag'] = TagLink::join('post','post.id','=','tag_link.post_id')
	// 				->join('tag','tag.id','=','tag_link.link_id')
	// 				->where('tag_link.post_id',$id)
	// 				->select('tag.*','tag_link.*')
	// 				->get();


	// 	$data['comments'] = Comment::join('post','post.id','=','comment.post_id')
	// 						->join('users','users.id','=','comment.user_id')
	// 						->join('media','users.avatar','=','media.id')
	// 						->where('comment.post_id',$id)
	// 						->select('comment.*','media.url')
	// 						->paginate(5);

	// 	$data['history'] = Post::orderBy('id','desc')->limit(3)->get();
	// 	return view('Client.Blog.detail-blog',$data);
	// }
	// //list post
	// public function getListPost(Request $request,$id){
	// 	$data['list_post_with_tag'] =TagLink::join('post','post.id','=','tag_link.post_id')
	// 				->where('post.id',$id)
	// 				->get();
	// 	return view('Client.Blog.list-blog',$data);
	// }

	
	
	
	public function getListUrl($id){
		$data['menu'] =Menu::find($id); 
		return view('Client.Blog.detail-blog',$data);
	}
	// //subcriber
	// public function postSubcriberPost(Request $request){
	// 	$this->validate($request,
	//       [
	//         'email'=>'required|max:100',
	//       ],
	//       [
	//        'email.required'=>'Không được trống !!!',
	//        'email.max'=>'Nhập tối đa 100 kí tự !!!',
	//       ]);
	// 	$subcriber = new Subscriber();
	// 	$subcriber->email = $request->email;
	// 	$subcriber->save();
	// 	return redirect()->back()->with('success','Đã đăng kí nhận bản tin');
	// }
	// //add comment
	// public function postAddComment(Request $request){
	// 	// dd(Auth::check());
	// 	if(Auth::check() == null){
	// 		return 0;
	// 	}else{
	// 		$this->validate($request,
	// 	      [
	// 	        'email'=>'required|max:100',
	// 	        'firstname'=>'required|max:255',
	// 	        'lastname'=>'required|max:255',
	// 	        'message'=>'required',
	// 	      ],
	// 	      [
	// 	       'email.required'=>'Không được trống !!!',
	// 	       'email.max'=>'Nhập tối đa 100 kí tự !!!',
	// 	       'firstname.required'=>'Không được trống !!!',
	// 	       'firstname.max'=>'Nhập tối đa 255 kí tự !!!',
	// 	       'lastname.required'=>'Không được trống !!!',
	// 	       'lastname.max'=>'Nhập tối đa 255 kí tự !!!',
	// 	       'message.required'=>'Không được trống !!!',
	// 	      ]);
	// 		$data = $request->all();
	//         $comment = DB::table('comment')->insert(
	//             array(
	//             'content'  => $request['message'],
	//             'status'  => 1,
	//             'title'  => 'post_comment',
	//             'post_id'  => $request['post_id'],
	//             'user_id'  => Auth::id(),
	//             'created_at' =>Carbon::now()
	//             )
	//         );
	//         // $comment_post = DB::table('comment_post')->insertGetId(
	//         //     array(
	//         //     'comment_id'  => $comment,
	//         //     'post_id'  => $request['post_id'],
	//         //     'created_at' =>Carbon::now()
	//         //     )
	//         // );
	//         $respon['message'] = "success";
	//         $respon['status'] = true;
	//         $respon['data'] = $data;
	//         return response()->json($respon);
	// 	}
	// }
}
