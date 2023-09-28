<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function admin()
    {
        $user = Auth::user();
        // show all blog posts
        $articles = Article::where('user_id',$user->id)->orderBy('id','desc')->get();
        return view('admin', ['articles' => $articles]);
    }

    public function create()
    {
        //show form to create a blog post
        return view('article.create');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required',
            'content' =>'required',
            'image'=>'required',
        ]);

        if($request->hasFile('image'))
        {
            $destiantion_path='public/images';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destiantion_path,$image_name);

            $article['image'] = $image_name;
        }

        $article = new Article;
        $article->user_id = \auth()->id();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->image = $image_name;
        $article->save();



        return redirect('admin')->with('message','Article was created!');
    }

    public function edit(int $id)
    {
        //show form to edit the post
        try {
            $article = Article::findOrFail($id);
        }
        catch(ModelNotFoundException $e)
        {
            return redirect('admin')->with('error','Article not found!');
        }

        return view('article.edit', ['article' => $article]);
    }


    public function update(Request $request, int $id)
    {
        //save the edited post
        $this->validate($request, [
            'title'=> 'required',
            'content' =>'required',
        ]);

        try{
            $article = Article::findOrFail($id);

            $article->title = $request->input('title');
            $article->content = $request->input('content');
            $article->save();

        }
        catch(ModelNotFoundException $e)
        {
            return redirect('admin')->with('error','Article not found!');
        }

        return redirect()->route('admin')->with('message','Article was updated!');
    }


    public function delete(int $id)
    {
        //delete a post
        try{
            $article = Article::findOrFail($id);
            $article->delete();

        }
        catch(ModelNotFoundException $e)
        {
            return redirect('admin')->with('error','Article not found!');
        }

        return redirect()->route('admin')->with('message','Article was deleted!');
    }
}
