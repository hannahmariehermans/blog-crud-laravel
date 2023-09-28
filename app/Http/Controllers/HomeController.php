<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        // show all blog posts
        $articles = Article::paginate(5);
        return view('home', ['articles' => $articles]);
    }


    public function show($id)
    {
        $article = Article::find($id);
        //show a blog post
        return view('post')->with('article',$article);
    }


}
