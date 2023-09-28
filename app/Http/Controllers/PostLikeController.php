<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::check()){

            $this->validate($request, [
                'article_id' =>'required',
            ]);

            $like = new Like();
            $like->user_id = \auth()->id();
            $like->article_id = $request->input('article_id');
            $like->save();

            return redirect()->back()->with('message','Liked.');
        }
        else{
            return redirect()->back()->with('error','You need to login first to like.');
        }
    }

    public function delete(int $id)
    {
        try{
            $like = Like::findOrFail($id);
            $like->delete();

        }
        catch(ModelNotFoundException $e)
        {
            return redirect()->back();
        }
        return redirect()->back();
    }



}
