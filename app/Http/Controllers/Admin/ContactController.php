<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
// use Validator;
use Auth;
use DB;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        $contacts = Contact::where('status',1)->paginate(10);
        return view('Admin.Contact.list-contact-pendding',compact('contacts'));
    }
     public function getProcessed(Request $request)
    {
         $contacts = Contact::where('status',2)->paginate(10);
        return view('Admin.Contact.list-contact-success',compact('contacts'));
    }
     public function getXuly(Request $request,$id)
    {
         $contact = Contact::find($id);
         $contact->status = 2;
         $contact->save();
        return redirect(route('list.contact'))->with('success','Liên hệ đã được xử lý !!! ');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function destroy(Request $request, $id)
    {
        $contact = Contact::where('id',$id)->delete();
        return redirect(route('list.contact'))->with('success','Thông tin đã được xóa');
        
    }
    
    public function searchPendding(Request $request)
    {
        if($request->ajax()){ 
            $output ='';
            $contacts = DB::table('contact')->where('status','=',1)
                            ->where('name', 'LIKE', '%' . $request->search . '%' )
                            ->orWhere('email', 'LIKE', '%' . $request->search . '%' )
                            ->orWhere('address', 'LIKE', '%' . $request->search . '%' )
                            ->orWhere('phone', 'LIKE', '%' . $request->search . '%' )
                            ->orderBy('status', 'desc')
                            ->get();
            if($contacts){
              $stt = 1;
              foreach ($contacts as $key => $contact) {
                $status = $contact->status=1 ? "chưa xử lý" : "đã xử lý";
                $output .= '<tr>
                  <th><input type="checkbox" name=""></th>
                  <th>' . $stt++ . '</th>
                  <th>' .  $contact->name . '</th>
                  <th>' .  $contact->email . '</th> 
                  <th>' .  $contact->address . '</th> 
                  <th>' .  $contact->phone . '</th> 
                  <th>' .  $contact->content . '</th>
                  <th>' .  $status . '</th>
                  <th scope="col">
                    <a href="'.route('delete.contact',['id'=>$contact->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
                </tr>';
              }
            }
            return response($output);
        }
    }


    public function searchSuccess(Request $request)
    {
        if($request->ajax()){ 
            $output ='';
            $contacts = DB::table('contact')->where('status','=',2)
                            ->where('name', 'LIKE', '%' . $request->search . '%' )
                            ->orWhere('email', 'LIKE', '%' . $request->search . '%' )
                            ->orWhere('address', 'LIKE', '%' . $request->search . '%' )
                            ->orWhere('phone', 'LIKE', '%' . $request->search . '%' )
                            ->orderBy('status', 'desc')
                            ->get();
            if($contacts){
              $stt = 1;
              foreach ($contacts as $key => $contact) {
                $status = $contact->status == 1 ? "chưa xử lý" : "đã xử lý";
                $output .= '<tr>
                  <th><input type="checkbox" name=""></th>
                  <th>' . $stt++ . '</th>
                  <th>' .  $contact->name . '</th>
                  <th>' .  $contact->email . '</th> 
                  <th>' .  $contact->address . '</th> 
                  <th>' .  $contact->phone . '</th> 
                  <th>' .  $contact->content . '</th>
                  <th>' .  $status . '</th>
                  <th scope="col">
                    <a href="'.route('delete.contact',['id'=>$contact->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
                </tr>';
              }
            }
            return response($output);
        }

    }

}
