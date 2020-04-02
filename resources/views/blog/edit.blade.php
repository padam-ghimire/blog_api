@extends('layout')


@section('dashboard-content')
<div class="container mt-10">
    <h2>Update blog</h2>

    @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success')}}</div>  
    @endif
    @if (Session::get('err'))
        <div class="alert alert-danger">{{ Session::get('err')}}</div>  
    @endif




<form action="{{ URL::to('update-blog-post')}}/{{$blog->id}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
        <input type="text" value="{{$blog->title}}" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title">
        </div>
       
        <div class="form-group">
            <label for="exampleInputEmail1">Details</label>
        <textarea class="form-control" name="blogDetails" id="editor1">{{ $blog->details}}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input class="form-control" type="file" name="featuredPhoto" onchange="loadPhoto(event);">
          </div>
          <div>
              @if ($blog->featured_image_url)
                  
              <img src="{{$blog->featured_image_url}}" id="photo" height="100" width="100">
              @endif
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Catgory</label>
           <select name="category" id="" class="form-control">
                @foreach ($categories as $category)
           <option value="{{ $category->id}}"  @if($category->id == $blog->category_id) selected @endif)     >{{ $category->name}}</option>
                @endforeach
           </select>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>

<script>
    function loadPhoto(event){
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('photo');
            output.src= reader.result;
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>


@endsection