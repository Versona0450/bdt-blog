@extends('layouts.blog')
@section('titlebar')
    {{$article->title}} - BLOG
@endsection

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if (session('draft'))
                <div class="alert alert-secondary">{{ session('draft') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-secondary">{{ session('success') }}</div>
            @endif
        </div>
    </div>
    <div class="row mt-2 mb-2">
        <div class="col">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    <h1 class="card-text text-center">
                        {{$article->title}}
                    </h1>
                </div>
                <div class="card-body">
                    <p>
                        @foreach ($article->tags as $tag)
                            <a href="" style="text-decoration: none;">
                                <span class="badge badge-info">{{$tag->name}}</span>
                            </a>
                        @endforeach
                    </p>
                    {{$article->content}}
                </div>
                <div class="card-footer">
                    <div class="row">
                        <form action="{{route('article.comment', $article->id)}}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                @guest
                                <input type="text" name="comment" class="form-control" disabled placeholder="Login First Before Comment...">
                                @endguest
                                @auth
                                <input type="text" class="form-control" placeholder="Comment here..." name="comment">
                                <button class="btn btn-outline-secondary" type="submit">Send</button>
                                @endauth
                            </div>
                        </form>
                    </div>
                    {{-- COMMENT --}}
                    @foreach ($article->comments->sortByDesc('created_at') as $row)
                        @if (($row->status == 1) || (Gate::check('Publish Comment'))) 
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <b>{{$row->user->name}}</b>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            {{$row->comment}}
                                        </div>

                                        @if(Gate::check('Publish Comment'))

                                        <div class="col-md-1">
                                            <div class="btn-group" role="group">

                                                @if ($row->status == 0)
                                                <a onclick="event.preventDefault();
                                                document.getElementById('update-comment').submit();" class="btn btn-info btn-sm">
                                                    <i class="fa fa-share"></i>
                                                </a>
                                                @endif
                                                <a onclick="event.preventDefault();
                                                document.getElementById('delete').submit();" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <form action="{{ route('comment.publish', $row->id) }}" method="post" id="update-comment">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        
                                        <form action="{{ route('comment.destroy', $row->id) }}" method="post" id="delete-comment">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <sup class="text-muted">{{$row->created_at}}</sup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                            
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
