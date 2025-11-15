@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3> Category List - </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category</th>
                            <th>Img</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($categories as $index => $category )       
                            <tr>
                                <th> {{ $index+1 }} </th>
                                <th> {{ $category->category_name }} </th>
                                <th> <img src=" {{ asset('uploads/category') }}/{{ $category->category_img }}" alt="" class="w-25"> </th>
                                <th> 
                                    <a href="" class="btn btn-primary">Edit</a>
                                    <a  data-link="{{ route('category.delete', $category->id) }}" class="btn btn-danger delelete">Delete</a>
                                </th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h1 class= "text-center"> Add Category </h1>
                </div>
                <div class="card-body">
                  
                    <form action="{{ route('store.category') }}" method="post" enctype="multipart/form-data"">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name">
                        </div>
                            @error('category_name')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Img</label>
                            <input type="file" class="form-control" name="category_img">
                        </div>
                        @error('category_img')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary"> Add Category </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_script')
    @if (session('success'))
        <script>
         const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
        icon: "success",
        title: '{{ session('success') }}'
        });
        </script>

  


    @endif

    {{-- delete alert --}}
    <script>
       $('.delelete').click(function(){
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                let link = $(this).attr('data-link')
                window.location.href  = link
            }
            });
       });

</script>

    @if (session('delete'))
        <script>
           Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
            });
        </script>
    @endif
@endsection