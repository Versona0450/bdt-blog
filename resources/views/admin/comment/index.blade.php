@extends('layouts.admin')
@section('titlebar')
    All COMMENTS BDT Article
@endsection

@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Comments List</h1><br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Comment</li>
            </ol>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
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
                <table class="table table-striped table-bordered table-hover mt-2" id="table2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Article ID</th>
                            <th>Comment</th>
                            <th>Guest Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @forelse ($comment as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    {{$row->article_id}}
                                </td>
                                <td>
                                    {{$row->comment}}
                                </td>
                                <td>
                                    {{$row->user->name}}
                                </td>
                                <td>
                                    @if($row->status == 0)
                                    <span class="badge badge-secondary">
                                      Draft
                                    </span>
                                    @else
                                    <span class="badge badge-success">
                                      Publish
                                    </span>
                                    @endif
                                </td>
                                <td>
                                  <div class="btn-group">
                                    @if($row->status == 0)
                                    <form action="{{ route('comment.publish', $row->id) }}" method="post" id="update-comment">
                                      @csrf
                                      @method('PUT')  
                                        <button class="btn btn-info btn-sm">
                                            <i class="fa fa-share"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('comment.destroy', $row->id) }}" method="post" id="delete-comment">
                                      @csrf
                                      @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                  </div>
                                </td>

                                
                                

                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada Article</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
             </div>
         </div>
        </div>
    </section>
  </div>
@endsection


@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins')}}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script>
        $(function(){
            $('#table2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>
@endsection