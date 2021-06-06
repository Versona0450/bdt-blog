@extends('layouts.admin')
@section('titlebar')
    User List
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Admin List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Admin List</li>
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
           <div class="card">
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                <?php $n = 1; ?>
                    @foreach ($user as $row)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->role->name}}</td>
                            <td>
                              <form action="{{ route('user.destroy', $row->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="{{ route('user.edit', $row->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                    <button class="btn btn-danger btn-sm" type="submit">
                                      <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                              </form>
                            </td>
                        </tr>
                    @endforeach
              </table>
            </div>
         </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card">
             <h5>Guest User</h5> 
             <table class="table table-stripped table-bordered">
                 <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Role</th>
                     <th>Action</th>
                 </tr>
                 <?php $n = 1; ?>
                     @foreach ($guest as $row)
                         <tr>
                             <td>{{$n++}}</td>
                             <td>{{$row->name}}</td>
                             <td>{{$row->email}}</td>
                             <td>{{$row->role->name}}</td>
                             <td>
                               <form action="{{ route('user.destroy', $row->id) }}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <div class="btn-group" role="group" aria-label="Basic example">
                                   <a href="{{ route('user.edit', $row->id) }}" class="btn btn-warning btn-sm">
                                     <i class="fa fa-edit"></i>
                                   </a>
                                     <button class="btn btn-danger btn-sm" type="submit">
                                       <i class="fa fa-trash"></i>
                                     </button>
                                 </div>
                               </form>
                             </td>
                         </tr>
                     @endforeach
               </table>
            </div>
          </div>
         </div>
      </div>
    </section>
  </div>

  
  
@endsection