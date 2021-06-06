@extends('layouts.admin')
@section('titlebar')
    Tag BDT Article
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Tag</h1><br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Tag</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col">
             <div class="card container">
               <div class="row">
                <div class="col text-center">
                    <div class="card">
                        <form action="{{route('tag.update', $tag->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="d-grid gap-1">
                                <input type="text" class="form-control" name="name" value="{{$tag->name}}">
                                <button class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
             </div>
          </div>
        </div>
    </section>
  </div>


@endsection

