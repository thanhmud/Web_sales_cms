<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Post;
use App\Models\Media;
use App\Models\Category;
use App\Models\CategoryLink;
use App\Models\ProductTag;
use App\Models\ProductMedia;
use App\Models\Tag;
use Str;
use Carbon\Carbon;
use Auth;
use DB;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAjax(){
      $menu = Menu::leftJoin('media','media.id','menu.icon')->select('menu.*','media.url')->get();
      // var_dump($menu);
       // $menu = Menu::all();
      return response()->json([
            'menu' => $menu,
        ]);
    }
   public function index(Request $request)
    {
        $menus = Menu::paginate(10);
        return view('Admin.Menu.index',compact('menus'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $data['all_post'] = Post::orderBy('id','desc')->get();
        $data['all_pro'] = Product::orderBy('id','desc')->get();
        $data['all_post_modals'] = Product::all();
        $data['medias'] = Media::where('type',1)->get();
        $data['category_post'] =Category::where('type',1)->get();
        $data['category_product'] =Category::where('type',2)->get();
        $data['category'] =Category::all();
        $data['menu'] = Menu::all();
        return view('Admin.Menu.add',$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
      Menu::where('type',$request['type'])->where('link_id',$request['link_id'])->delete();
      $this->validate($request,
          [
           
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
        // $link_id = $request['link_id'];
     
      // DB::table('menu')->delete();
      $menu = DB::table('menu')->insertGetId(
          array(
          'name' =>$request['name'],
          'type' =>$request['type'],
          'type_id' =>$request['type_id'],
          'link_id'  => $request['link_id'],
          'icon'  => $request['icon'],
          'parent_id'  => $request['parent_id'],
          'url'  => $request['url'],
          'user_id'  => Auth::id(),
          'created_at' =>Carbon::now()
          )
      );
      $respon['message'] = "success";
      $respon['status'] = true;
      $respon['id'] = $menu;
      $respon['item'] = $request['item'];
      return response()->json($respon);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postmenu  $postmenu
     * @return \Illuminate\Http\Response
     */
    function editMenu(Request $request){
      $this->validate($request,
          [
           
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
      $id = $request['id'];
      if($request->ajax()){ 
          $menu = Menu::where('id',$id)->update(
            array(
            'name' =>$request['name'],
            'url'  => $request['url'],
            'icon'  => $request['icon'],
            )
        );
      }
      $respon['message'] = "success";
      $respon['id'] = $id;
      return response()->json($respon);
    }
    function deleteMenu(Request $request){

      // dd($request->all());
      $id = $request['id'];
      $data = Menu::where('id',$request['id'])->delete();
      $link_id = Menu::where('link_id',$request['id'])->delete();
      $respon['message'] = "success";
      $respon['id'] = $id;
      return response()->json($respon);
    }
    public function searchPost(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $posts = DB::table('post')->where('title', 'LIKE', '%' . $request->search . '%')
                                  ->get();
        if($posts){
          foreach ($posts as $key => $post) {  
            $output .= '<div >
                    <input type="checkbox" id="'.$post->id.'" value="'.$post->id.'" name="post_id" >
                    <input type="hidden" value="'.$post->title.'" id="name_post_'.$post->id.'">'.$post->title.'
             </div>';
          }
          
        }
        return response($output);
      }
    }

     public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $products = DB::table('product')->where('title', 'LIKE', '%' . $request->search . '%')
                                        ->get();
        if($products){
          foreach ($products as $key => $product) {  
            $output .= '<div >
                    <input type="checkbox" id="'.$product->id.'" value="'.$product->id.'" name="product_id"  >
                    <input type="hidden" value="'.$product->title.'" id="name_pro_'.$product->id.'">'.$product->title.'
             </div>';
          }
        }
        return response($output);
      }
    }

    public function searchCategoryPro(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $category = DB::table('category')->where('name', 'LIKE', '%' . $request->search . '%')
                                        // ->where('type',2)
                                        ->get();
        if($category){
          foreach ($category as $key => $category) {  
            $output .= '';
          }
          
        }
        return response($output);
      }
    }
}
