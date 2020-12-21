<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
// use Validator;
use Auth;
use DB;

class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTagPost(Request $request)
    {
        $tags = Tag::where('type',1)->paginate(10);
        return view('Admin.Tag.index-post',compact('tags'));
    }
     public function indexTagProduct(Request $request)
    {
        $tags = Tag::where('type',2)->paginate(10);
        return view('Admin.Tag.index-product',compact('tags'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct()
    {
        return view('Admin.Tag.add-product');
    }
     public function createPost()
    {
        return view('Admin.Tag.add-post');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProduct(Request $request)
    {
       $this->validate($request,
          [
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->type = 2;
        $tag->user_id  = Auth::id();
        $tag->save();
        return redirect(route('index.tag.product'))->with('success','Tag đã được thêm');
    }
     public function storePost(Request $request)
    {
       $this->validate($request,
          [
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->type = 1;
        $tag->user_id  = Auth::id();
        $tag->save();
        return redirect(route('index.tag.post'))->with('success','Tag đã được thêm');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostTag  $postTag
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostTag  $postTag
     * @return \Illuminate\Http\Response
     */
    public function editTagProduct(Request $request, $id)
    {
        $tag = Tag::find($id);
         return view('Admin.Tag.edit-product',compact('tag'));
    }
    public function editTagPost(Request $request, $id)
    {

        $tag = Tag::find($id);
         return view('Admin.Tag.edit-post',compact('tag'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostTag  $postTag
     * @return \Illuminate\Http\Response
     */
    public function updateTagProduct(Request $request,$id)
    {
        $this->validate($request,
          [
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->user_id  = Auth::id();
        $tag->save();
        return redirect(route('index.tag.product'))->with('success','Tag đã được sửa');
    }
     public function updateTagPost(Request $request,$id)
    {
       $this->validate($request,
          [
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->user_id  = Auth::id();
        $tag->save();
        return redirect(route('index.tag.post'))->with('success','Tag đã được sửa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostTag  $postTag
     * @return \Illuminate\Http\Response
     */
    public function destroyPost(Request $request, $id)
    {
        $tag = Tag::where('id',$id)->delete();
        return redirect(route('index.tag.post'))->with('success','Tag đã được xóa');
        
    }
     public function destroyProduct(Request $request, $id)
    {
        $tag = Tag::where('id',$id)->delete();
        return redirect(route('index.tag.product'))->with('success','Tag đã được xóa');
        
    }
    public function searchPost(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $tags = DB::table('tag')
                        ->where('type',1)
                        ->where('name', 'LIKE', '%' . $request->search . '%')
                        ->get();
        if($tags){
          $stt = 1;
          foreach ($tags as $key => $tag) {
           // $type = $tag->type == 1 ? "Post":"Product";
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' .  $tag->name . '</th> 
              <th scope="col"><a href='.route('edit.tag.post',['id'=>$tag->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.tag.post',['id'=>$tag->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        }
        return response($output);
      }

    }
     public function searchProduct(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $tags = DB::table('tag')
                        ->where('type',1)
                        ->where('name', 'LIKE', '%' . $request->search . '%')
                        ->get();
        if($tags){
          $stt = 1;
          foreach ($tags as $key => $tag) {
           // $type = $tag->type == 1 ? "Post":"Product";
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' .  $tag->name . '</th> 
              <th scope="col"><a href='.route('edit.tag.product',['id'=>$tag->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.tag.product',['id'=>$tag->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        }
        return response($output);
      }

    }
}
