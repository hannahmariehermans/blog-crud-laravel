@extends('layouts.layout')

@section('meta')
    {{$article->slug}}
@endsection

@section('content')
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{session('error')}}</strong>
        </div>
    @endif
    <br>
    @if(session('message'))
        <div class="bg-amber-100 border border-amber-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{session('message')}}</strong>
        </div>

    @endif
    <br>

    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <img  src="{{asset('/storage/images/' .$article->image)}}"
                    alt="Blog Post illustration" class="rounded-xl">

                <p class="mt-4 block text-gray-400 text-xs">
                    Published
                    <time>{{$article->updated_at}}</time>
                </p>

                <div class="flex items-center lg:justify-center text-sm mt-4">
                    <h5 class="font-bold">{{$article->user->firstname}} {{$article->user->lastname}}</h5>
                </div>
            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="{{route('home')}}"
                       class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path class="fill-current"
                                      d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                </path>
                            </g>
                        </svg>

                        Back to Posts
                    </a>


                </div>

                <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                    {{$article->title}}
                </h1>
                    <form action="{{route('blog.like',  $article->id)}}" method="post">
                        @csrf
                        <label  for="article_id" ><input type="hidden" name="article_id" value='{{$article->id}}'></label>
                        <button class="px-5 py-2.5  text-center font-bold text-black bg-gray-200 hover:bg-red-200 hover:text-pink-700 rounded-lg" type="submit">
                            like
                        </button>
                    </form>


                    <button
                        class="px-5 py-2.5  text-center font-bold text-black bg-gray-200 hover:bg-red-200 hover:text-pink-700 rounded-lg">
                        <a href="{{route('like.delete',  ['id' => $article->id])}}">
                            Unlike </a>
                    </button>

                <p><strong>{{$article->likes->count('article_id')}} Likes</strong></p>
                <div class="space-y-4 lg:text-lg leading-loose mt-10">
                    {!! nl2br($article->content) !!}

                </div>
            </div>
        </article>
    </main>
@endsection

@section('comments')
            <section class="bg-white dark:bg-gray-900 py-8 lg:py-16">
                <div class="max-w-2xl mx-auto px-4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments</h2>
                    </div>
                    <form class="mb-6" method="post" action="{{route('blog.comment',['id' => $article->id])}}">
                        @csrf
                        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">

                            <label for="comment" class="sr-only">
                                <input type="hidden" name="article_id" value='{{$article->id}}'>
             php                    Your comment
                            </label>
                            <textarea id="comment" rows="6" name="comment"
                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                      placeholder="Write a comment..." required></textarea>
                        </div>
                        <button type="submit"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-black bg-gray-400 rounded-lg hover:bg-gray-200">
                            Post comment
                        </button>
                    </form>

                @forelse($article->comments as $comment)
                    <article class="p-6 text-base bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 text-black">
                                        {{$comment->user->firstname}} {{$comment->user->lastname}}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{$comment->updated_at->format('d-m-Y')}}</p>
                            </div>

                             @if(Auth::check() && Auth::id() == $comment->user_id)
                                <button
                                    class="text-sm leading-none text-gray-600 py-3 px-5 bg-red-100 rounded hover:bg-red-300">
                                    <a href="{{route('comment.delete', ['id' => $comment->id])}}">
                                        Delete </a>
                                </button>
                            @endif
                        </footer>
                        <p class="text-gray-500 dark:text-gray-400">{{$comment->comment}}</p>
                    </article>
                    @empty <h6>No Comments Yet. </h6>
                    @endforelse
                </div>
            </section>
@endsection
