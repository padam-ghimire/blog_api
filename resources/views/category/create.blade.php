@extends('layout')


@section('dashboard-content')
<div class="container mt-10">
    <h2>Create new Category</h2>

    @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success')}}</div>  
    @endif
    @if (Session::get('err'))
        <div class="alert alert-danger">{{ Session::get('err')}}</div>  
    @endif




<form action="{{ URL::to('post-category-form')}}" method="post">
    @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Category</label>
          <input type="text" name="categoryName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>

@endsection