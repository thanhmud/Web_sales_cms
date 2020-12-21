<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;
use Carbon\Carbon;
use DB;
use App\Charts\UserChart;
use App\Models\Product;
use App\Models\History;
use App\Models\Post;
use App\Models\Media;
use App\Charts\SubcriberChart;
use App\Charts\HistoryForYearChart;
use App\Charts\HistoryChart;

class LoginController extends Controller
{
	//login
    public function index(){
    	return view('Admin.login');
    }
    public function postLogin(Request $request)
    {
    	$message =[
         'required' =>' :attribute không được trống !!!',
          'email' =>' :attribute phải có định dạng email !!!',
	      ];
	      $this->validate($request,
	      [
	         'email'   =>'required|email',
	         'password'=>'required',
	      ],$message);
		$arr= [
		'email'=>$request->email,
		'password'=>$request->password,
		// 'lock' =>1
		];
		if (Auth::attempt($arr)){
		    	return redirect(route('dashboard'));
	    }
	    else{
	    	return redirect()->back()->with('danger','Đăng nhập thất bại... ');
	    }
    }
    public function logOut()
    {
    	Auth::logout();
		return redirect(route('get.login'));
    }

    //register
    public function getRegister()
    {
    	return view('Admin.register');
    }
    public function postRegister(Request $request)
    {
    	 $this->validate($request,
          [
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|min:6|max:30',
            'password_confirmation' =>'required|same:password'
          ],
          [
            'firstname.required'=>'firstname không được trống',
            'firstname.max'=>'firstname không được quá 255 kí tự',
            'lastname.required'=>'lastname không được trống',
            'lastname.max'=>'lastname không được quá 255 kí tự',
            
            'email.max'=>'Email không được quá 255 kí tự',
            'email.required'=>'email không được để trống',
            'email.email'=>'Không phải định dạng của Email',
            'email.unique'=>'Không được trùng email',
            'password.min'=>'Mật khẩu phải trên 6 ký tự',
            'password.max'=>'Mật khẩu không được quá 30 ký tự',
            'password.required'=>'Password không được để trống',
            'password_confirmation.required' => 'Bạn chưa nhập lại mật khẩu',
            'password_confirmation.same' => 'Mật khẩu nhập lại chưa đúng'
          ]);
        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->avatar = 208;
        $user->password  = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success','Đã xác nhận đăng kí tài khoản.');
    }

    //dashboard
    public function dashboard()
    {

        //thống kê tài khoản users
        $users1 = User::count();
        $product = Product::count('id');
        $media = Media::count('id');
        $post = Post::count('id');
        $chart = new UserChart;
        $month = date('m');
        $year = date('Y');

        $users = new User;
        $nownow1 = Carbon::now();
        $nownow2 = Carbon::now();
        $nownow3 = Carbon::now();
        $nownow4 = Carbon::now();
        $nownow5 = Carbon::now();
        $nownow6 = Carbon::now();
        $nownow7 = Carbon::now();
        $nownow8 = Carbon::now();
        $nownow9 = Carbon::now();
        $nownow10 = Carbon::now();
        $nownow11 = Carbon::now();
        // $nownow12 = Carbon::now();

        $now1 =  $nownow1->subMonths(1);//tru 1 thang
        $now2 =  $nownow2->subMonths(2);//tru 2 thang
        $now3 =  $nownow3->subMonths(3);
        $now4 =  $nownow4->subMonths(4);
        $now5 =  $nownow5->subMonths(5);
        $now6 =  $nownow6->subMonths(6);
        $now7 =  $nownow7->subMonths(7);
        $now8 =  $nownow8->subMonths(8);
        $now9 =  $nownow9->subMonths(9);
        $now10 =  $nownow10->subMonths(10);
        $now11 =  $nownow11->subMonths(11);
        // var_dump($now11);
        $user1 =User::whereMonth('created_at','=',$now1)->whereYear('created_at','=',$year)->count();
        $user2 =User::whereMonth('created_at','=',$now2)->whereYear('created_at','=',$year)->count();
        $user3 =User::whereMonth('created_at','=',$now3)->whereYear('created_at','=',$year)->count();
        $user4 =User::whereMonth('created_at','=',$now4)->whereYear('created_at','=',$year)->count();
        $user5 =User::whereMonth('created_at','=',$now5)->whereYear('created_at','=',$year)->count();
        $user6 =User::whereMonth('created_at','=',$now6)->whereYear('created_at','=',$year)->count();
        $user7 =User::whereMonth('created_at','=',$now7)->whereYear('created_at','=',$year)->count();
        $user8 =User::whereMonth('created_at','=',$now8)->whereYear('created_at','=',$year)->count();
        $user9 =User::whereMonth('created_at','=',$now9)->whereYear('created_at','=',$year)->count();
        $user10 =User::whereMonth('created_at','=',$now10)->whereYear('created_at','=',$year)->count();
        $user11 =User::whereMonth('created_at','=',$now11)->whereYear('created_at','=',$year)->count();
        $user12 =User::whereMonth('created_at','=',$month)->whereYear('created_at','=',$year)->count();

        $chart_sub = new SubcriberChart;
        $chart_sub->labels(['tháng 1', 'tháng 2', 'tháng 3','tháng 4', 'tháng 5', 'tháng 6','tháng 7', 'tháng 8', 'tháng 9','tháng 10', 'tháng 11', 'tháng 12']);
        $chart_sub->dataset('Thống kê số người đăng kí từng tháng trong năm '.$year,'bar',[$user11,$user10,$user9,$user8,$user7,$user6,$user5,$user4,$user3,$user2,$user1,$user12])
                    ->color(['#e2c091','#e2bc85','#e5b97b','#e5b470','#e0ac62','#e0a757','#e0a24c','#db993d','#db9432','#db9027','#db8c1e','#d88613'])
                    ->backgroundcolor(['#e0a24c']);

        //thống kê ghi log bài viết, loại bài viết,sản phẩm, loại sản phẩm
        //đếm các bài viết theo tháng
        
        // $post_history = History::where('type',1)->whereMonth('created_at',$month)->count();
        // $product = History::where('type',2)->whereMonth('created_at',$month)->count();

        // $category_product = History::where('type',4)->whereMonth('created_at',$month)->count();
        // $category_post = History::where('type',3)->whereMonth('created_at',$month)->count();
        // $history_for_month = new HistoryChart;
        // $history_for_month->labels(['Bài viết','Sản phẩm','Loại sản phẩm','Loại bài viết']);
        // $history_for_month->dataset('Ghi log người dùng','line',[$post,$product,$category_product,$category_post])
        //                     ->color(['#e5b470','#e0ac62','#e0a757','#e0a24c'])
        //                     ->backgroundcolor(['#e0a24c']);
        
        $post_counts = Post::all();

        $product_counts = Product::all();

        return view('Admin.Dashboard.index', compact('chart','users1','product','post','media','chart_sub','post_counts','product_counts'));
    }
    public function historyView($id){
        $data['history_posts'] = History::join('post','post.id','=','history.link_id')
                                            ->where('link_id',$id)->where('history.type',1)
                                            ->orderBy('history.id','desc')
                                            ->select('history.*','post.title')
                                            ->paginate(5);
        dd($data['history_posts']);
        return view('Admin.Dashboard.detail-history',$data);
    }
    public function historyViewProduct($id){
        $data['history_products'] = History::join('product','product.id','=','history.link_id')
                                            ->where('link_id',$id)->where('history.type',2)
                                            ->orderBy('history.id','desc')
                                            ->select('history.*')
                                            ->paginate(5);
        
        return view('Admin.Dashboard.detail-history-product',$data);
    }

}
