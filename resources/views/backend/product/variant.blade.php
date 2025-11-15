@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-8">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Color List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                           <thead>
                             <tr>
                                <th class="">SL</th>
                                <th class="">Color Name</th>
                                <th class="">Color Code</th>
                                <th class="">Actions</th>
                            </tr>
                           </thead>
                            <tbody>
                                @foreach ($color_list as $index => $color)
                                <tr>
                                    <td class="">{{ $index+1 }}</td>
                                    <td class=""> {{ $color->color_name }}</td>
                                    <td class=""> {{ $color->color_code }}</td>
                                    <td class="">
                                        <a href="{{ route('color.delete', $color->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 

            {{-- Size Deleted --}}
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Size List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                           <thead>
                             <tr>
                                <th class="">SL</th>
                                <th class="">Size Name</th>
                                <th class="">Actions</th>
                            </tr>
                           </thead>
                            <tbody>
                                @foreach ($size_list as $index => $size)
                                <tr>
                                    <td class="">{{ $index+1 }}</td>
                                    <td class=""> {{ $size->size_name }}</td>
                                    <td class="">
                                        <a href="{{ route('size.delete', $size->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Add Color</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.color') }}" method="post">
                        @csrf
                        <div class="form-gorup">
                            <label for="" class="form-label">Color Name</label>
                            <input type="text" name="color_name" class="form-control">
                        </div>
                        <div class="form-gorup mt-4">
                            <label for="" class="form-label">Color HTML Code</label>
                            <input type="text" name="color_code" class="form-control">
                        </div>
                        <div class="form-gorup mt-4">
                            <input type="submit" name="submit" class="form-control btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Size Add --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="text-center">Add Size</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.size') }}" method="post">
                        @csrf
                        <div class="form-gorup">
                            <label for="" class="form-label">Size Name</label>
                            <input type="text" name="size_name" class="form-control">
                        </div>
                        <div class="form-gorup mt-4">
                            <input type="submit" name="submit" class="form-control btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('footer_script')
    @if(session('success'))
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
@endsection