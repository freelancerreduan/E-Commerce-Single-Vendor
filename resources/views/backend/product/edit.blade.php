@extends('layouts.admin')

@section('content')
    {{-- {{ print_r($product->product_name)  }}; --}}

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Product Details Edite </h3>
                </div>
                <div class="card-body">
                   <form action=" {{ route('product.update') }} " method="POST" enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <label for="" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" value=" {{ $product->product_name }} ">
                            <input type="hidden" name="product_id" class="form-control" value=" {{ $product->id }} ">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Product Price</label>
                            <input type="text" name="price" class="form-control" value =" {{ $product->price }} ">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Product Discount</label>
                            <input type="text" name="discount" class="form-control" value =" {{ $product->discount }} ">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Product Preview</label>
                            <div class="w-25">
                                <input type="file" name="previous" class="form-control">
                                <img src="{{ asset('uploads/products/previews') }}/{{ $product->previous }}" alt="" class="w-25">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-danger">Update Product Details</button>
                            <a href="{{ route('product.list')}}" class="btn btn-primary">Back Product List</a>
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