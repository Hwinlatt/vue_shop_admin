<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function index()
    {

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'productId'=>'required',
            'comment'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }
        Comment::create([
            'user_id'=>$request->user()->id,
            'product_id'=>$request->productId,
            'comment'=>$request->comment,
            'rating'=>$request->rating ? $request->rating : 0,
        ]);
        return response()->json(['success'=>'Commented'], 200);
    }

    public function show($id,Request $request)
    {
        $limit = $request->limit;
        $comments = Comment::select('comments.*','users.name','users.profile_photo_path')
        ->join('users','comments.user_id','users.id')->where('comments.product_id',$id)->orderBy('comments.created_at','desc')
        ->limit($limit)->get();
        $comments_count = Comment::where('product_id',$id)->count();
        $total_rating = Comment::where('product_id',$id)->groupBy('product_id')->sum('rating');
        $data = [
            'comments'=>$comments,
            'comment_count'=>$comments_count,
            'rating'=>$total_rating,
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $comment = Comment::find($id);
        if ($comment->user_id == $request->user()->id) {
            $comment->delete();
            return response()->json(['success'=>'Comment Deleted!'], 200);
        }
        return response()->json(['error'=>'Unauthorized'],200);
    }
}
