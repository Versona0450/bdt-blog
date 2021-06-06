@extends('layouts.blog')
@section('titlebar')
    BDT BLOG
@endsection

@section('content')
<div class="container">
  @if(request()->is('/'))
    <div class="row mt-2 mb-2">
        @foreach ($first as $item)
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                  {{$item->title}}
                </div>
                <div class="card-body">
                    <img src="{{asset('articles/posts/'. $item->thumbnail)}}" class="card-img-top img-fluid" style="width: 200px;">
                  <p class="card-text">{{$item->category->name}}</p>
                  <p class="text-muted">
                    @foreach ($item->tags as $tag)
                    <a href=""><span class="badge badge-info">{{$tag->name}}</span></a>
                    @endforeach
                  </p>
                  <a href="{{route('blog.show', $item->id)}}"   class="btn btn-primary">Detail</a>
                </div>
                <div class="card-footer text-muted">
                  {{$item->created_at}}
                </div>
              </div>
              @endforeach
        </div>
    </div>
    @endif
    <div class="row">
        @forelse ($article as $row)
        <div class="col mb-3">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('articles/posts/'.$row->thumbnail)}}" class="card-img-top img-fluid" style="width: 150px;">
                <div class="card-body">
                  <h5 class="card-title">{{$row->title}}</h5>
                  <p class="card-text">{{$row->category->name}}</p>
                  <p class="title-muted">
                    @foreach ($row->tags as $tag)
                    <a href=""><span class="badge badge-info">{{$tag->name}}</span></a>
                    @endforeach
                  </p>
                  <a href="{{route('blog.show', $row->id)}}"   class="btn btn-primary">Detail</a>
                </div>
            </div>  
        </div>
        @empty
        <h1>TIDAK ADA ARTIKEL</h1>
        @endforelse
    </div>
    {{$article->links()}}
</div>
@endsection
