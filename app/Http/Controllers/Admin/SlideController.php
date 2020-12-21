<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\Media;
use Illuminate\Http\Request;
// use App\Http\Requests\SlideRequest;
use Auth;
use Carbon\Carbon;
use DB;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request)
    {
        $slides = Slide::paginate(10);
        $slide_img= Media::join('slide','media.id','=','slide.media_id')
                    ->select('media.*')
                    ->get();
        return view('Admin.Slide.index',compact('slides','slide_img'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media  = Media::where('type',1)->get();
        return view('Admin.Slide.add',compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->url){
            $this->validate($request,
            [
                'url'=>'required',
                'media_id'=>'required'
            ],
            [
                'url.required'=>'Url không được để trống',
                'media_id.required'=>'Ảnh không được để trống' 
            ]);

        }else{
            $this->validate($request,
            [
                'media_id'=>'required'
            ],
            [
                'media_id.required'=>'Ảnh không được để trống' 
            ]);

        }
        
        $data = $request->all();
        $slide_id = DB::table('slide')->insertGetId(
            array(
            'name' =>$request['name'],
            'url' =>$request['url'],
            'user_id'  => Auth::id(),
            'media_id' => $request['media_id'],
            'created_at' =>Carbon::now()
            )
        );
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json();
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
        $slide = Slide::find($id);
        $slide_img= Slide::join('media','media.id','=','slide.media_id')
                    ->select('media.*')
                    ->get();
        $media  = Media::where('type',1)->get();
         return view('Admin.Slide.edit',compact('slide','slide_img','media'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         if($request->url){
            $this->validate($request,
            [
                'url'=>'required',
                'media_id'=>'required'
            ],
            [
                'url.required'=>'Url không được để trống',
                'media_id.required'=>'Ảnh không được để trống' 
            ]);

        }else{
            $this->validate($request,
            [
                'media_id'=>'required'
            ],
            [
                'media_id.required'=>'Ảnh không được để trống' 
            ]);

        }
        $data = $request->all();
        $id = $request['id'];
        $slide_id =Slide::where('id',$id)->update(
            array(
            'name' =>$request['name'],
            'url' =>$request['url'],
            'user_id'  => Auth::id(),
            'media_id' => $request['media_id'],
            'updated_at' =>Carbon::now()
            )
        );
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $slide = Slide::where('id',$id)->delete();
        return redirect(route('index.slide'))->with('success','Slide đã được xóa');
        
    }
    public function search(Request $request)
    {
    $slide_img= Media::join('slide','media.id','=','slide.media_id')
                    ->select('media.*')
                    ->get();
      if($request->ajax()){ 
        $output ='';
        $slides = DB::table('slide')->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('url', 'LIKE', '%' . $request->search . '%')
                        ->get();
        if($slides){
          $stt = 1;
          foreach ($slides as $key => $slide) {
             $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $slide->url . '</th>
              <th>
                <img src="../../Media/{{$slide->MediaSlide->url}}" alt="" width="50px" height="50px">
              </th>
              <th scope="col"><a href='.route('edit.slide',['id'=>$slide->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.slide',['id'=>$slide->id]).'" onclick="return confirm(\bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        }
        return response($output);
      }
    }

}
