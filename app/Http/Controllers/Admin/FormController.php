<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request)
    {
        $forms = Form::paginate(10);
        return view('Admin.Form.index',compact('forms'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Form.add');
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
            'value'=>'required',
            'name'=>'required|unique:form',
            'email_to'=>'required|max:255|email',
        ],
        [
            'value.required'=>'Không được để trống',
            'name.required'=>'Không được để trống',
            'name.unique'=>'Tên đã  tồn tại rồi',
            'email_to.required'=>'Không được để trống',
            'email_to.max'=>'Không được quá 255 kí tự',
            'email_to.email'=>'Phải là định dạng kiểu email',
        ]);
        $data = $request->all();
        $form = DB::table('form')->insertGetId(
            array(
            'email_to'=>$request->email_to,
            'name' =>'[form_page_'.$request->name.'_'.rand(0,100000).']',
            'value' =>$request->value,
            // 'source_code' =>'[form_'.rand(0,100).']',
            'user_id'  => Auth::id(),
            'created_at' =>Carbon::now()
            )
        );
        return redirect(route('index.form'))->with('success','Form đã được thêm !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $form = Form::find($id);
        
         return view('Admin.Form.edit',compact('form'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,
        [
            'value'=>'required',
            'name'=>'required',
            'email_to'=>'required|max:255|email',
        ],
        [
            'value.required'=>'Không được để trống',
            'name.required'=>'Không được để trống',
            'name.unique'=>'Tên đã  tồn tại rồi',
            'email_to.required'=>'Không được để trống',
            'email_to.max'=>'Không được quá 255 kí tự',
            'email_to.email'=>'Phải là định dạng kiểu email',
        ]);
        // $data = $request->all();
        $form = Form::find($id);
        $form->email_to = $request->email_to;
        $form->name = $request->name;
        $form->value = $request->value;
        $form->user_id =Auth::id();
        $form->created_at =Carbon::now();
        $form->save();
        return redirect()->back()->with('success','Form đã được sửa !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $form = Form::where('id',$id)->delete();
        return redirect(route('index.form'))->with('success','Form đã được xóa');
        
    }
    // public function search(Request $request)
    // {
    // $slide_img= Media::join('slide','media.id','=','slide.media_id')
    //                 ->select('media.*')
    //                 ->get();
    //   if($request->ajax()){ 
    //     $output ='';
    //     $slides = DB::table('slide')->where('name', 'LIKE', '%' . $request->search . '%')
    //                     ->orWhere('url', 'LIKE', '%' . $request->search . '%')
    //                     ->get();
    //     if($slides){
    //       $stt = 1;
    //       foreach ($slides as $key => $slide) {
    //          $output .= '<tr>
    //           <th><input type="checkbox"  name=""></th>
    //           <th>' . $stt++ . '</th>
    //           <th>' . $slide->url . '</th>
    //           <th>
    //             <img src="../../Media/{{$slide->MediaSlide->url}}" alt="" width="50px" height="50px">
    //           </th>
    //           <th scope="col"><a href='.route('edit.slide',['id'=>$slide->id]).'><i class="fa fa-edit tacvu"></i></a>
    //           <a href="'.route('delete.slide',['id'=>$slide->id]).'" onclick="return confirm(\bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
    //         </tr>';
    //       }
    //     }
    //     return response($output);
    //   }
    // }

}
