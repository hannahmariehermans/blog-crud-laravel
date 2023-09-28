<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::check()){
            /**
             * @throws ValidationException
             */
            $this->validate($request, [
                'comment' =>'required',
            ]);

            $comment = new Comment();
            $comment->article_id = $request->input('article_id');
            $comment->user_id = \auth()->id();
            $comment->comment = $request->input('comment');
            $comment->save();

            return redirect()->back()->with('message','Thanks for the feedback.');
        }
        else{
            return redirect()->back()->with('error','Login first to comment.');
        }
    }


    public function delete(int $id)
    {
        try{
            $comment = Comment::findOrFail($id);
            $comment->delete();

        }
        catch(ModelNotFoundException $e)
        {
            return redirect()->back();
        }
        return redirect()->back();
    }
}
