<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
// use Validate;
use DB;
class ProfileController extends Controller
{
     public function index($id)
    {
        $data['profile'] = User::find($id);
        $data['media'] = Media::all();
        // dd($data['profile']);
        return view('Admin.Profile.index',$data);
    }
    public function editProfile(Request $request)
    {
        $this->validate($request,
          [
            'firstname' =>'required|max:255',
            'lastname' =>'required|max:255',
            'avatar' =>'required',
            // 'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|min:6|max:65',
            'repassword' =>'required|same:password'
          ],
          [
            'firstname.required'=>'firstname không được trống',
            'firstname.max'=>'firstname không được quá 255 kí tự',

            'lastname.required'=>'lastname không được trống',
            'lastname.max'=>'lastname không được quá 255 kí tự',

            // 'name.required'=>'Tên không được trống',
            // 'name.max'=>'Tên không được quá 255 kí tự',

            'avatar.required'=>'avatar không được trống',

            'email.max'=>'Email không được quá 255 kí tự',
            'email.required'=>'email không được để trống',
            'email.email'=>'Không phải định dạng của Email',
            'email.unique'=>'Không được trùng email',
            'password.min'=>'Mật khẩu phải trên 6 ký tự',
            'password.max'=>'Mật khẩu không được quá 65 ký tự',
            'password.required'=>'Password không được để trống',
            'repassword.required' => 'Bạn chưa nhập lại mật khẩu',
            'repassword.same' => 'Mật khẩu nhập lại chưa đúng'
            
        ]);
        $id = $request['id'];
        $data = $request->all();
        $product_id = User::where('id',$id)->update(
            array(
            'firstname' =>$request['firstname'],
            'lastname' =>$request['lastname'],
            'avatar'  => $request['avatar'],
            'email'  => $request['email'],
            'password'  => bcrypt($request['password']),
            'created_at' =>Carbon::now()
            )
        );
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
    }
    // }
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
              <th>' . $user->name . '</th> 
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
