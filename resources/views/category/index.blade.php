@extends('layout')

@section('dashboard-content')

@if (Session::get('success'))
<div class="alert alert-success">{{ Session::get('success')}}</div>  
@endif
@if (Session::get('err'))
<div class="alert alert-danger">{{ Session::get('err')}}</div>  
@endif

<div class="card mb-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Category Name</th>
                        <th>Actions</th>
                        
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($categories as $category)
                        
                    <tr>
                         <td>{{ $category->name }}</td>
                        <td>
                             <a href="{{ URL::to('edit-category')}}/{{ $category->id }}" class="btn btn-outline-primary btn-sm">Edit</a>
                            |
                            <a  href="{{ URL::to('delete-category')}}/{{ $category->id}}" onclick="checkDelete()" class="btn btn-outline-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function checkDelete(){
       var check= confirm("Are you sure to delete??");

       if(check){
           return true;
       }
       return false;
    }

</script>

@endsection