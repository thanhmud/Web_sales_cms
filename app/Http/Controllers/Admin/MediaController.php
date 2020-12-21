<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Auth;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $index_media = Media::where('type',1)->get();
        return view('Admin.Media.index_image',compact('index_media'));
    }
    public function indexVideo()
    {
        $video = Media::where('type',2)->get();
        return view('Admin.Media.index_video',compact('video'));
    }
    public function delete(Request $request)
    {
        if($filename = $request->input('name'))
        {
            $url = $request->input('url');
            // dd($url);
            $path=public_path().'/Media/'.$url;
            // dd($path);
            if (file_exists($path)) {
                unlink($path);
            }
            $data = Media::where('id',$request->input('name'))->delete();
            $respon['message'] = "success";
            return response()->json($respon);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileStore(Request $request)
    {
        $this->validate($request,
          [
            'dropzone'=>'image|mimes:jpg,jpeg,png,gif|max:2048',
          ],
          [
           'dropzone.mimes'=>'Phải đúng định dạng: jpg,jpeg,png,gif !!!',
           'dropzone.max'=>'Nhập tối đa 2 MB!!!',
           'dropzone.image'=>'Phải là ảnh !!!',
          ]);
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('/Media'),$imageName);
        $imageUpload = new Media();
        $imageUpload->url = $imageName;
        $imageUpload->type = 1;
        $imageUpload->user_id = Auth::id();
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }
    public function fileStoreVideo(Request $request)
    {
         $this->validate($request,
          [
            'file'=>'required|mimes:3gb,mp3,mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|max:20480',
          ],
          [
           'file.mimes'=>'Phải đúng định dạng video !!!',
           'file.max'=>'Nhập tối đa 20MB!!!',
          ]);
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('/Media'),$imageName);
        $imageUpload = new Media();
        $imageUpload->url = $imageName;
        $imageUpload->type = 2;
        $imageUpload->user_id = Auth::id();
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $path=public_path().'/Media/'.$filename;
        var_dump($path);
        if(file_exists($path)) {
            unlink($path);
        }
        Media::where('url',$filename)->delete();
        // $media->delete();
        return $filename;  
    }

}
