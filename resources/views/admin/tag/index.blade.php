@extends('layouts.admin')
@section('titlebar')
    Category BDT Article
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Category</h1><br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">List Category</li>
            </ol>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              @if (session('success'))
                  <div class="alert alert-secondary">{{ session('success') }}</div>
              @endif
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
                 <div class="col">
                  <form action="{{route('tag.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="cat">New Tag</label>
                      <input type="text" name="name" class="form-control mb-3" id="cat" placeholder="Enter Tag">
                      <input type="submit" value="Create" class="btn btn-primary">
                    </div>
                  </form>
                </div>
               </div>
             </div>
             <div class="card container">
               <div class="row">
                <div class="col">
                    @csrf
                  <table class="table table-striped table-bordered" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>id</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $no = 1; ?>
                          @forelse ($tag as $row)
                              <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$row->name}}</td>
                                  <td>
                                    <form action="{{ route('tag.destroy', $row->id) }}" method="post">
	                                    @csrf
	                                    @method('DELETE')
	                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('tag.edit', $row->id) }}" class="btn btn-warning btn-sm">
                                          <i class="fa fa-edit"></i>
                                        </a>
	                                    		<button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-trash"></i>
                                          </button>
	                                    </div>
	                                  </form>
                                  </td>
                              </tr>
                              @empty
                              <tr>
                                <td colspan="3">Tidak Ada Tags</td>
                              </tr>
                          @endforelse
                      </tbody>
                  </table>
                </div>
              </div>
             </div>
          </div>
        </div>
    </section>
  </div>
@endsection

