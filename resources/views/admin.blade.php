@extends('layouts.layout')

@section('meta')
    Hi Brain-Admin!
@endsection

@section('content')
    <div class="sm:px-6 w-full">
        <div class="px-4 md:px-10 py-4 md:py-7">
            <div class="flex items-center justify-between">
                <p tabindex="0"
                   class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">
                    Admin Panel</p>
            </div>
        </div>
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <div class="sm:flex items-center justify-between">
                <button
                    class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white"><a href="{{route('admin.create')}}">Add Blogpost </a></p>
                </button>
            </div>

            @if(count($articles))
            <div class="mt-7 overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tbody>
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <th class="">
                            <div class="flex items-center pl-5">
                                <p class="font-bold leading-none text-gray-700 mr-2">TITLE</p>
                            </div>
                        </th>
                        <th class="pl-5">
                            <div class="flex items-center ">
                                <p class="font-boldleading-none text-gray-700 mr-2">EDIT</p>
                            </div>
                        </th>
                        <th class="pl-5">
                            <div class="flex items-center ">
                                <p class="font-bold leading-none text-gray-700 mr-2">DELETE</p>
                            </div>
                        </th>
                        <th class="pl-5">
                            <div class="flex items-center ">
                                <p class="font-bold leading-none text-gray-700 mr-2">VIEW</p>
                            </div>
                        </th>

                    </tr>
                    <tr class="h-3"></tr>
                    @foreach($articles as $article)
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$article->title}}</p>
                            </div>
                        </td>

                        <td class="pl-4">
                            <button
                                class="text-sm leading-none text-gray-600 py-3 px-5 bg-blue-100 rounded hover:bg-blue-300">
                                <a href="{{route('admin.article.edit', ['id' => $article->id])}}">
                                    Edit </a>
                            </button>
                        </td>
                        <td class="pl-4">
                            <button
                                class="text-sm leading-none text-gray-600 py-3 px-5 bg-red-100 rounded hover:bg-red-300 ">
                                <a href="{{route('admin.article.delete', ['id' => $article->id])}}">
                                    Delete </a>
                            </button>
                        </td>
                        <td class="pl-4">
                            <button
                                class="text-sm leading-none text-gray-600 py-3 px-5 bg-yellow-200 rounded hover:bg-yellow-300">
                                <a href="{{route('blog.post',['id' => $article->id])}}">
                                    View </a>
                            </button>
                        </td>
                    </tr>
                    <tr class="h-3"></tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <br/>
                <div class ="alert alert-warning" role ="alert">
                    <p>No Articles found. </p>
                </div>
            @endif
        </div>
    </div>
@endsection
