<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
// use Validate;
use DB;
class UserController extends Controller
{
     public function index()
    {
        $users = User::orderBy('id','asc')->paginate(10);
        // $user=$user->paginate(10)
        return view('Admin.User.index',compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $media =Media::all(); 
        return view('Admin.User.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,
          [
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|min:6|max:30'
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
            
          ]);
        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->avatar = 208;
        $user->password  = bcrypt($request->password);
        $user->save();
        return redirect(route('index.user'))->with('success','Thông tin người dùng đã được thêm');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('Admin.user.edit',compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request,
          [
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|min:6|max:65',
            'passwordAgain' =>'required|same:password'
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
            'password.max'=>'Mật khẩu không được quá 65 ký tự',
            'password.required'=>'Password không được để trống',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa đúng'
            
          ]);

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect(route('index.user'))->with('success','Thông tin người dùng đã được sửa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();
        Session::put('success','Thông tin người dùng đã được xóa !');
        return redirect(route('index.user'));
    }
    public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $users = DB::table('users')->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                        ->get();
        if($users){
          $stt = 1;
          foreach ($users as $key => $user) {  
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $user->firstname . '</th> 
              <th>' . $user->lastname . '</th> 
              <th>' . $user->email . '</th>
              <th scope="col"><a href='.route('edit.user',['id'=>$user->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.user',['id'=>$user->id]).'" onclick="return confirm(\bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        }
        return response($output);
      }
    }
}
