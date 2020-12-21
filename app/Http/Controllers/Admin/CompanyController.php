<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Media;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $company = Company::all();
    //     return view('Admin.Company.index',compact('company'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     // $media =Media::all(); 
    //     return view('Admin.Company.add');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $company = new Company;
    //     $company->name = $request->name;
    //     $company->address = $request->address;
    //      if ($request->hasFile('favicon')) {
    //        $file = $request->file('favicon');
    //        $duoi = $file->getClientOriginalExtension();
    //        if ($duoi !='jpg'&&$duoi !='png'&&$duoi !='jpeg' &&$duoi !='gif') {
    //           return redirect(route('create.company'))->with('danger','Không đúng định dạng');
    //        }
    //        $name = $file->getClientOriginalName();
    //        $image = $name;
    //        while(file_exists("Media".$image)){
    //           $image = $name;
    //        }
    //        $file->move("Media",$image);
    //        $company->favicon = $image;
    //     }
    //      if ($request->hasFile('share_icon')) {
    //        $file = $request->file('share_icon');
    //        $duoi = $file->getClientOriginalExtension();
    //        if ($duoi !='jpg'&&$duoi !='png'&&$duoi !='jpeg' &&$duoi !='gif') {
    //           return redirect(route('create.company'))->with('danger','Không đúng định dạng');
    //        }
    //        $name = $file->getClientOriginalName();
    //        $image = $name;
    //        while(file_exists("Media".$image)){
    //           $image = $name;
    //        }
    //        $file->move("Media",$image);
    //        $company->share_icon = $image;
    //     }
    //     $company->hotline = $request->hotline;
    //     $company->email = $request->email;
    //     $company->copyright  = $request->copyright;
    //     $company->facebook  = $request->facebook;
    //     $company->twitter = $request->twitter;
    //     $company->google = $request->google;
    //     $company->youtube  = $request->youtube;
    //     $company->pinterest  = $request->pinterest;
    //     $company->instagram = $request->instagram;
    //     $company->iframe_map = $request->iframe_map;
    //     $company->user_id  = Auth::id();
    //     // dd( $company->user_id );
    //     $company->save();
    //     return redirect(route('index.company'))->with('success','Thông tin đã được thêm');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $company = Company::all();
        $media = Media::where('type',1)->get();
        $media_share = Media::where('type',1)->get();
        $pro_media_fa = Media::join('company','company.favicon', '=', 'media.id')
            ->select('media.url')->get();
        $pro_media_share = Media::join('company','company.share_icon', '=', 'media.id')
            ->select('media.url')->get();    
        return view('Admin.Company.edit',compact('company','media','media_share','pro_media_fa','pro_media_share'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,
      [
        'name'=>'required',
        'address'=>'required',
        'hotline'=>'required|numeric|max:999999999999999',
        'email'=>'required|email|max:255',
        'copyright'=>'required',
        'facebook'=>'required',
        'twitter'=>'required',
        'google'=>'required',
        'youtube'=>'required',
        'pinterest'=>'required',
        'instagram'=>'required',
        'iframe_map'=>'required',
      ],
      [
       'name.required'=>'Tên không được trống',
       'address.required'=>'Địa chỉ không được trống',
       'hotline.required'=>'Số điện thoại không được trống',
       'email.email'=>'Phải định dạng email',
       'email.max'=>'Tối đa 255 kí tự',
       'email.required'=>'email không được trống',
       'hotline.numeric'=>'Phải là kiểu số',
       'hotline.max'=>'Không được quá 15 kí tự số',
       'copyright.required'=>'copyright không được trống',
       'facebook.required'=>'facebook không được trống',
       'twitter.required'=>'twitter không được trống',
       'google.required'=>'google không được trống',
       'youtube.required'=>'youtube không được trống',
       'pinterest.required'=>'pinterest không được trống',
       'instagram.required'=>'instagram không được trống',
       'iframe_map.required'=>'Địa chỉ map không được trống'
      ]);
        $data = $request->all();
        $id = $request['id'];
        $company = Company::where('id',$id)->update(
            array(
            'name' =>$request['name'],
            'address' =>$request['address'],
            'favicon'  => $request['favicon'],
            'share_icon'  => $request['share_icon'],
            'hotline'  => $request['hotline'],
            'email' =>$request['email'],
            'facebook'  => $request['facebook'],
            'copyright' =>$request['copyright'],
            'twitter'  => $request['twitter'],
            'google'  => $request['google'],
            'youtube' =>$request['youtube'],
            'pinterest' =>$request['pinterest'],
            'instagram'  => $request['instagram'],
            'iframe_map'  => $request['iframe_map'],
            'user_id'  => Auth::id(),
            'created_at' =>Carbon::now()
            )
        );
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\company  $company
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $company = Company::where('id',$id)->delete();
    //     Session::put('success',' đã được xóa !');
    //     return redirect(route('index.company'));
    // }
}
