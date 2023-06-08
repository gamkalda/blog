@extends('personal.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Комментарии</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Комментарии</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-9">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Комментарий</th>
                      <th colspan="2" class="text-center">Действие</th>
                      <th>Имя Поста</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i=0;
                    @endphp
                    @foreach($comments as $comment)
                    <tr>
                      <td>{{ $comment->id }}</td>
                      <td>{{ $comment->message }}</td>                    
                      <td class="text-center"><a href="{{ route('personal.comment.edit', $comment->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                      <td class="text-center">
                        <form action="{{ route('personal.comment.delete', $comment->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="border-0 bg-transparent" >
                            <i class="fas fa-trash-alt text-danger" role="button"></i>
                          </button>
                        </form>
                      </td>
                      <td><a href="{{ route('post.show', $comment->post_id) }}">{{ $posts[$i]->title }}</a></td> 
                    </tr>
                    @php
                      $i++;
                    @endphp              
                    @endforeach
                                     
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection