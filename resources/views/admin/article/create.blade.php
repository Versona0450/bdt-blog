@extends('layouts.admin')
@section('titlebar')
    Create BDT Article
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create a Article</h1><br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Create Article</li>
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
                <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Title</span>
                                <input type="text" name="title" class="form-control" required placeholder="Title..." aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Author : {{Auth::user()->name}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <textarea id="summernote" required name="content">
                                    Make <em>a</em> <u>Great</u> <strong>Content</strong> Here...
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Category Article</label>
                              <select class="form-control select" required name="category_id" style="width: 100%;">
                                <option>-- Choose --</option>
                                @foreach ($category as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tags Article</label>
                                <div class="select2-primary">
                                    <select class="select2" multiple="multiple" required name="tags[]" data-placeholder="Select Tags" style="width: 100%;">
                                    @foreach ($tag as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <label class="input-group-text" required for="inputFile">Upload a Thumbnail</label>
                                <input type="file" class="form-control" name="thumbnail" id="inputFile">
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
             </div>
         </div>
        </div>
    </section>
  </div>
@endsection