@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Product List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Discounts</th>
                                <th>Previews</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr>
                                <th> {{ $index+1 }} </th>
                                <th> {{ Str::limit($product->product_name,40,'....MORE') }}  </th>
                                <th> &#2547 {{ $product->price }} </th>
                                <th> {{ $product->discount }}% </th>
                                <th style="width:5%"> 
                                    <img src=" {{ asset('uploads/products/previews') }}/{{ $product->previous }}" alt="" class="w-100">
                                </th>
                                <th>
                                   <a href="{{ route('edit.product', $product->id) }}" class="btn btn-primary">Edit</a>
                                    <a href=" {{ route('product.delete',$product->id) }} " class="btn btn-danger"> Delete </a>
                                    <a href=" {{ route('product.inventory',$product->id) }} " class="btn btn-danger"> Inventory </a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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