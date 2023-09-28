@extends('layouts.layout')

@section('meta')
    Hi Braindumpers!
@endsection

@section('header')
    <!-- Page header with logo and tagline -->
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Braindump</span> Blogposts
        </h1>

        <p class="text-sm mt-7">
            A lot of blablabla but that's makes it soooo fun. Fun Ready! Live Laugh and Learn.
        </p>
    </header>
@endsection

@section('content')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @foreach($articles as $article)
        <article
            class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
            <div class="py-6 px-5 lg:flex">
                <div class="flex-1 lg:mr-8 ">
                    <img
                        src="{{asset('/storage/images/' .$article->image)}}"
                        alt="Blog Post illustration" class="rounded-xl max-w-sm	max-h-48">
                </div>
                <div class="flex-1 flex flex-col justify-between">
                    <header class="mt-8 lg:mt-0">
                        <div class="mt-4">
                            <h1 class="text-3xl">
                                {{$article->title}}
                            </h1>

                            <span class="mt-2 block text-gray-400 text-xs">
                                        Published <time>{{$article->updated_at}}</time>
                                    </span>
                        </div>
                    </header>

                    <div class="text-sm mt-2">
                        <p>
                        {!! substr(nl2br($article->content),0,100) !!}...  
        
                        </p>
                    </div>

                    <footer class="flex justify-between items-center mt-8">
                        <div class="flex items-center text-sm">
                            <div>
                                <h5 class="font-bold">{{$article->user->firstname}} {{$article->user->lastname}}</h5>
                            </div>
                        </div>

                        <div class="hidden lg:block">
                            <a href="{{route('blog.post',['id' => $article->id])}}"
                               class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                            >Read More</a>
                        </div>
                    </footer>
                </div>
            </div>
        </article>
        @endforeach

        <div class="row">
            {{$articles->links()}}
        </div>
    </main>
@endsection
