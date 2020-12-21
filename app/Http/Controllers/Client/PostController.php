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
use App\Models\Contact;
use App\Models\Form;
use App\Models\History;
use Carbon\Carbon;
use Auth;
use DB;
use App\Helper\Helper;
use Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
	 use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function getDetailPost(Request $request, $id){
		$data['post_related'] = Post::join('category_link','category_link.link_id','=','post.id')
							->where('category_link.type',1)
							->where('post.type',0)
							->where('post.id','<>',$id)
							->inRandomOrder()
							->limit(2)->get();

		$data['post'] = Post::find($id);

		$data['form'] = Form::all();

		$data['menu'] =Menu::find($id);
		//lấy bài viết theo tag
		$data['tags'] = TagLink::join('post','post.id','=','tag_link.post_id')
					->join('tag','tag.id','=','tag_link.link_id')
					->where('tag_link.post_id',$id)
					->select('tag.*','tag_link.*')
					->get();

		
		$data['comments'] = Comment::join('post','post.id','=','comment.post_id')
							->where('comment.post_id',$id)
							->where('comment.status',2)
							->where('post.allow_comment',1)
							->select('comment.*')
							->paginate(5);
		//get log page
		$api_history = Helper::GetApi('https://www.iplocate.io/api/lookup/');

		$history_array = json_decode($api_history, true); //json_decode: chuyen doi chuoi json sang array
	
		$data['history'] = new History();
		$data['history']->link_id = $request->id;
		$data['history']->type = 1;
		$data['history']->location =$history_array['city'].','.$history_array['country'];
		$data['history']->ip = $history_array['ip'];
		$data['history']->save();

		//đếm số lượng người xem từng post
		$data['count_post'] = Post::find($id);
		$data['count_post']->count += 1;
		$data['count_post']->save();
		return view('Client.Blog.detail-blog',$data);
	}

	public function getDetailPage($id){
		$data['post'] = Post::find($id);
		$data['form'] = Form::all();
		$data['form1'] = Form::all();
		$data['menu'] =Menu::find($id);
		
		return view('Client.Blog.detail-page',$data);
	}
	public function postContactPage(Request $request){
	  	$mailto = $request['email_to'];
	  	$email = $request['email'];
		$data = [
			'name'  => $request['name'],
            'email'  => $request['email'],
            'address'  => $request['address'],
            'phone'  => $request['phone'],
            'content' => $request['message'],
        	'status' => 1,
            'created_at' =>Carbon::now()
		];
		DB::table('contact')->insert($data);
		Mail::send('Client.Email.email-contact',$data,function($message) use ($email,$mailto) {
			$message->from($email,'Người gửi');
			$message->to($mailto,'Người nhận');
			$message->subject('Thông tin khách hàng liên hệ');
		});
	        $respon['message'] = "success";
	        $respon['status'] = true;
	        $respon['data'] = $data;
	        return response()->json($respon);
	}
	//list post
	public function getListPost(Request $request,$id){
		$data['list_post_with_tag'] = Post::join('tag_link','post.id','=','tag_link.post_id')
					->where('tag_link.link_id',$id)
					->get();
		return view('Client.Blog.list-blog',$data);
	}
	

	//subcriber
	public function postSubcriberPost(Request $request){
		$this->validate($request,
	      [
	        'email'=>'required|max:100',
	      ],
	      [
	       'email.required'=>'Không được trống !!!',
	       'email.max'=>'Nhập tối đa 100 kí tự !!!',
	      ]);
		$subcriber = new Subscriber();
		$subcriber->email = $request->email;
		$subcriber->save();
		return redirect()->back()->with('success','Đã đăng kí nhận bản tin');
	}
	//add comment
	public function postAddComment(Request $request){
		// if(Auth::check() == null){
		// 	return 0;
		// }else{
			$this->validate($request,
		      [
		        'email'=>'required|max:100',
		        'firstname'=>'required|max:255',
		        'lastname'=>'required|max:255',
		        'message'=>'required|max:500',
		      ],
		      [
		       'email.required'=>'Không được trống !!!',
		       'email.max'=>'Nhập tối đa 100 kí tự !!!',
		       'firstname.required'=>'Không được trống !!!',
		       'firstname.max'=>'Nhập tối đa 255 kí tự !!!',
		       'lastname.required'=>'Không được trống !!!',
		       'lastname.max'=>'Nhập tối đa 255 kí tự !!!',
		       'message.max'=>'Nhập tối đa 500 kí tự !!!',
		       'message.required'=>'Không được trống !!!',
		      ]);
			$data = $request->all();
	        $comment = DB::table('comment')->insert(
	            array(
	            'content'  => $request['message'],
	            'status'  => 1,
	            'title'  => 'post_comment',
	            'post_id'  => $request['post_id'],
	            'lastname' => $request['lastname'],
            	'firstname' => $request['firstname'],
            	'email' => $request['email'],
	            // 'user_id'  => Auth::id(),
	            'created_at' =>Carbon::now()
	            )
	        );
	        $respon['message'] = "success";
	        $respon['status'] = true;
	        $respon['data'] = $data;
	        return response()->json($respon);
		// }
	}
}
