<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Auth;
use DB;
use Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPost()
    {
        $category_post = Category::where('type',1)->paginate(10);
        // dd($category_post);
        return view('Admin.Category.index_post',compact('category_post'));
    }   
    public function indexProduct()
    {
        $category_product = Category::where('type',2)->paginate(10);
        // dd($category_product);
        return view('Admin.Category.index_product',compact('category_product'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPost()
    {
        $category = Category::where('type',1)->get();
        return view('Admin.Category.add-post',compact('category'));
    }
    public function createProduct()
    {
        $category = Category::where('type',2)->get();
        return view('Admin.Category.add-product',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $category_post = new Category;
        $category_post->name = $request->name;
        $category_post->desc = $request->desc;
        $category_post->parent_id = $request->parent_id;
        $category_post->media_id  = 1;
        $category_post->type =1;
        $category_post->user_id = Auth::id();
        $category_post->save();
        return redirect(route('index.post.category'))->with('success','Loại danh mục đã được thêm');
    }
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
        $category_product = new Category;
        $category_product->name = $request->name;
        $category_product->desc = $request->desc;
        $category_product->parent_id  = $request->parent_id;
        $category_product->media_id  = 1;
        $category_product->type = 2;
        $category_product->user_id = Auth::id();
        $category_product->save();
        return redirect(route('index.product.category'))->with('success','Loại danh mục đã được thêm');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\category  $category
     * @return \Illuminate\Http\Response
     */
    public function editPost($id)
    {
        $category = Category::find($id);
        $category_id = Category::where('type',1)->get();
        return view('Admin.Category.edit-post',compact('category','category_id'));
    }
    public function editProduct($id)
    {
        $category = Category::find($id);
        $category_id = Category::where('type',2)->get();
        return view('Admin.Category.edit-product',compact('category','category_id'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\category  $category
     * @return \Illuminate\Http\Response
     */
    public function updatePost(Request $request, $id)
    {
        $this->validate($request,
          [
           
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->media_id =1;
        $category->type =1;
        $category->user_id = Auth::id();
        $category->save();

        // $product_id = Category::where('id',$id)->update(
        //     array(
        //         'name'=>$request->name,
        //         'desc'=>$request->desc,
        //         'parent_id'=>$request->parent_id,
        //         'media_id'=>1,
        //         'type'=>1,
        //         'user_id'=>Auth::id(),
        //     )
        // );
        return redirect(route('index.post.category'))->with('success','Loại danh mục đã được sửa');
    }

    public function updateProduct(Request $request, $id)
    {
       $this->validate($request,
          [
           
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->media_id =1;
        $category->type =2;
        $category->user_id = Auth::id();
        $category->save();
            // $product_id = Category::where('id',$id)->update(
            //     array(
            //         'name'=>$request->name,
            //         'desc'=>$request->desc,
            //         'parent_id'=>$request->parent_id,
            //         'media_id'=>1,
            //         'type'=>2,
            //         'user_id'=>Auth::id(),
            //     )
            // );
        return redirect(route('index.product.category'))->with('success','Loại danh mục đã được sửa');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroyPost($id)
    {
       DB::table('category')->where('id',$id)->delete();
       DB::table('category')->where('parent_id',$id)->delete();
       return redirect(route('index.post.category'))->with('success','Danh mục đã được xóa');
    }
    public function destroyProduct($id)
    {
      DB::table('category')->where('id',$id)->delete();
      DB::table('category')->where('parent_id',$id)->delete();
       return redirect(route('index.product.category'))->with('success','Danh mục đã được xóa');
    }

    public function searchPost(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $cate_post = DB::table('category')
                        ->where('type',1)
                        ->where('desc', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                        // ->Join('media','category.media_id', '=', 'media.id')
                        ->get();
        // <th scope="col"><img src="../../Media/'.$cate_post->url.'" alt="" width="50px" height="50px"></th>

        if($cate_post){
          $stt = 1;
          foreach ($cate_post as $key => $cate_post) {
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $cate_post->name . '</th>
              <th>' . $cate_post->desc . '</th>
              <th>' . $cate_post->parent_id . '</th>

              <th scope="col"><a href='.route('edit.category.post',['id'=>$cate_post->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.category.post',['id'=>$cate_post->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>

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
        $cate_product = DB::table('category')
                        ->where('type',2)
                        ->where('desc', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                        // ->leftJoin('media','category.media_id', '=','media.id')
                        ->get();
        // <th scope="col"><img src="../../Media/'.$cate_pro->url.'" alt="" width="50px" height="50px"></th>
        if($cate_product){
          $stt = 1;
          foreach ($cate_product as $key => $cate_pro) {
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $cate_pro->name . '</th>
              <th>' . $cate_pro->desc . '</th>
              <th>' . $cate_pro->parent_id . '</th>

              <th scope="col"><a href='.route('edit.category.product',['id'=>$cate_pro->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.category.product',['id'=>$cate_pro->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>

            </tr>';
          }
        }
        return response($output);
      }
    }
}
