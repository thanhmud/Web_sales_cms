<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function penddingIndex()
    {
        $comment = Comment::join('post','post.id','=','comment.post_id')->select('post.title','comment.*')
            ->where('status',1)
            ->get();
        return view('Admin.Comment.pendding_index',compact('comment'));
    }
     public function successIndex()
    {
         $comment = Comment::join('post','post.id','=','comment.post_id')->select('post.title','comment.*')
            ->where('status',2)
            ->get();
        return view('Admin.Comment.success_index',compact('comment'));
    }
     public function successComment($id)
    {
        $comment =Comment::find($id);
        $comment->status = 2;
        $comment->save();
        return redirect()->back()->with('success','Bình luận đã được duyệt !!!');
    }
     public function deleteComment($id)
    {
        $comment =Comment::where('id',$id)->delete();
        return redirect()->back()->with('danger','Bình luận đã được xóa !!!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
