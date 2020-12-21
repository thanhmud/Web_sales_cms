<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Media;
use App\Models\CategoryLink;
use App\Models\Form;
use App\Models\TagLink; 
use App\Models\Tag;
use Illuminate\Http\Request;
use Str;
use Auth;
use DB;
use Session;
use Carbon\Carbon;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('type','desc')->paginate(10);
        $img = Post::join('media','post.media_id', '=', 'media.id')
                        ->select('media.url')
                        ->get();
        return view('Admin.Post.index',compact('posts','img'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = Category::where('type',1)->get();
        $category_add = Category::where('type',1)->get();
        $tag = Tag::where('type',1)->get();
        $media  = Media::where('type',1)->get();
        $form  = Form::all();
         return view('Admin.Post.add',compact('media','category','category_add','tag','form'));
    }
    //-------- page ------------------//
    // public function createPage()
    // {
    //      return view('Admin.Post.add-page');
    // }
    //  public function storePage(Request $request)
    // {
    //    $this->validate($request,
    //         [
    //             'title'=>'required|max:255',
    //         ],
    //         [
    //             'title.required'=>'Tiêu đề không được trống',
    //             'title.max'=>'không được vượt quá 255 kí tự',
    //       ]);
    //     $page = DB::table('post')->insertGetId(
    //         array(
    //         'title' =>$request['title'],
    //         'content'  => $request['content'],
    //         'type'  => 1,
    //         'user_id'  => Auth::id(),
    //         'slug' => Str::slug($request->title,'-'),
    //         'created_at' =>Carbon::now()
    //         )
    //     );
    //     return redirect(route('index.post'))->with('success','Trang đã được thêm');
      
    // }
    //-------- page ------------------//

    public function lockPost($id)
    {
        $lockPost =Post::find($id);
        $lockPost->allow_comment = 2;
        $lockPost->save();
        return redirect()->back();
    }
    public function unlockPost($id)
    {
        $unlockPost =Post::find($id);
        $unlockPost->allow_comment = 1;
        $unlockPost->save();
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function addCategoryPost(Request $request)
    {
        $this->validate($request,
          [
           
            'name'=>'required|max:255|unique:category',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!',
           'name.unique'=>'Tên đã tồn tại !!!',
          ]);
        $user_id = Auth::id();
        $id = DB::table('category')->insertGetId(
            array('name' => $request["name"],'desc'=>'add_pro','parent_id' => $request['parent_id'], 'user_id' => $user_id, 'media_id' => 1,'type'=>1)
        );
        $respon['success'] = "Đã thêm loại bài viết";
        $respon['status'] = true;
        $respon['id'] = $id;
        return response()->json($respon);
    }
    public function store(Request $request)
    {
       $this->validate($request,
            [
                'title'=>'required|max:255',
            ],
            [
                'title.required'=>'Tên bài viết không được trống',
                'title.max'=>'không được vượt quá 255 kí tự',
          ]);
        $data = $request->all();
        $post_id = DB::table('post')->insertGetId(
            array(
            'title' =>$request['title'],
            'content'  => $request['content'],
            'user_id'  => Auth::id(),
            'media_id' => $request['media_id'],
            'type' => $request['type'],
            'length_expect'=>substr($request['content'],0,80),
            'allow_comment'=>$request['allow_comment'],
            'slug' => Str::slug($request->title,'-'),
            'created_at' =>Carbon::now()
            )
        );
        //add cate
        if( $request['category'] !=0){
             $categorylist = $request['category'];
            foreach ($categorylist as $row) {
                $charges[] = [
                    'category_id' => $row,
                    'link_id' => $post_id,
                    'type' => 1,
                    'created_at' =>Carbon::now()

                ];
            }
            CategoryLink::insert($charges);
        }
        //add tag
        if($request['tag'] !=0){
            $tagList = $request['tag'];
            foreach ($tagList as $row) {
                $charges1[] = [
                    'post_id' => $post_id,
                    'link_id' => $row,
                    'type' => 1,
                    'created_at' =>Carbon::now()
                ];
            }
            TagLink::insert($charges1);
        }
        $response['success'] = "Bài viết đã được thêm";
        $response['status'] = true;
        $response['data'] = $data;
        return response()->json($response);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data['tag'] = Tag::where('type',1)->get();
        $data['link'] = TagLink::find($id);
        $data['post'] = Post::find($id);
        $data['tag_link'] = TagLink::join('post','post.id', '=', 'tag_link.post_id')
            ->where('post.id', $id)->where('tag_link.type','=',1)
            ->select('tag_link.link_id')->get();

         $data['category_old'] = CategoryLink::join('post','post.id', '=', 'category_link.link_id')
            ->where('post.id', $id)->where('category_link.type','=',1)
            ->select('category_link.category_id')->get();

        $data['post_img'] = Media::join('post','post.media_id', '=', 'media.id')
            ->where('post.id', $id)
            ->select('media.url')->get();

        
        $data['category'] = Category::where('type',1)->get();
        $data['category_add'] = Category::all();
        $data['media']  = Media::where('type',1)->get();

        return view('Admin.Post.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,
            [
                'title'=>'required|max:255',
            ],
            [
                'title.required'=>'Tên bài viết không được trống',
                'title.max'=>'không được vượt quá 255 kí tự',
          ]);
        $id = $request['id'];
        $data = $request->all();
        $post_id = Post::where('id',$id)->update(
            array(
            'title' =>$request['title'],
            'content'  => $request['content'],
            'user_id'  => Auth::id(),
            'media_id' => $request['media_id'],
            'type' => $request['type'],
            'length_expect'=>substr($request['content'],0,80),
            'allow_comment'=>$request['allow_comment'],
            'slug' => Str::slug($request->title,'-'),
            'created_at' =>Carbon::now()
            )
        );
        CategoryLink::where('link_id', $id)->delete();
        TagLink::where('post_id', $id)->delete();

        //add cate
        if($request['category'] != 0){
            $categorylist = $request['category'];
            foreach ($categorylist as $row) {
                $charges[] = [
                    'category_id' => $row,
                    'link_id' => $id,
                    'type' => 1,
                    'created_at' =>Carbon::now()
                ];
            }
            CategoryLink::insert($charges);
        }
       
        //add tag
        if($request['tag'] != 0){
            $tagList = $request['tag'];
            foreach ($tagList as $row) {
                $charges1[] = [
                    'post_id' => $id,
                    'link_id' => $row,
                    'type' => 1,
                    'created_at' =>Carbon::now()
                ];
            }
            TagLink::insert($charges1);
        }
        
        $respon['success'] = "Bài viết đã được sửa";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::where('id',$id)->delete();
        $category_link = CategoryLink::where('link_id',$id)->delete();
        $tag_link = TagLink::where('post_id',$id)->delete();
        return redirect(route('index.post'))->with('success','Bài viết or trang đã được xoá!!');
    }

     public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $posts = DB::table('post')->where('title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('content', 'LIKE', '%' . $request->search . '%')
                        ->Join('media','post.media_id', '=', 'media.id')
                        ->get();
        if($posts){
          $stt = 1;
          foreach ($posts as $key => $post) {
            $img = $post->media_id == false ?  : "<img src='../../Media/".$post->url."' width='50px' height='50px'>" ;
            // dd($img);
            $comment = $post->allow_comment == true ? "<span style='color: green'>Được bình luận</span>" : "<span style='color: red'>Khóa bình luận</span>";
            $output .= '<tr>
              <th><input type="checkbox" name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $post->title . '</th>
              <th>' . $post->content . '</th>
              <th scope="col">'.$img.'</th>
              <th>' . $comment . '</th>
              <th scope="col"><a href='.route('edit.post',['id'=>$post->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.post',['id'=>$post->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>'; 
          }
        }
        return response($output);
      }
    }
  }