@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="">Inventory Items</h5>
                <h4 class="text-muted">Porduct Name: {{ $product ->product_name }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($inventories as $index => $inventory)
                        <tr>
                            <td> {{ $index+1 }} </td>
                            <td> {{ $inventory->rel_to_color->color_name }} </td>
                            <td> {{ $inventory->rel_to_size->size_name }} </td>
                            <td> {{ $inventory->price }} </td>
                            <td> {{ $inventory->discount_price }} </td>
                            <td> {{ $inventory->quantity }} </td>
                            <td> 
                                <a href=" {{ route('inventory.delete', $inventory->id) }} " class="btn btn-primary">Delete</a>    
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center"> Add Inventory</h4>
            </div>
            <div class="card-body">
                <form action=" {{ route('add.inventory') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="form-label" class="">Product Name </label>
                        <input type="text" disabled class="form-control" value =" {{ $product->product_name }} ">
                        <input type="hidden" name="product_id" class="f" value =" {{ $product->id }} ">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label"> Product Discount </label>
                        <input type="text" disabled class="form-control" value =" {{ $product->discount }} % ">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Select Color</label>
                        <select name="color_id" class="form-control">
                            <option value=""> Select Color </option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id  }}"> {{ $color->color_name  }} </option> 
                            @endforeach
                        </select>
                        @error('color_id')
                            <strong class="text-danger"> {{ $message }} </strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Select Size</label>
                        <select name="size_id" class="form-control">
                            <option value=""> Select Size </option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id  }}"> {{ $size->size_name  }} </option> 
                            @endforeach
                        </select>
                        @error('size_id')
                            <strong class="text-danger"> {{ $message }} </strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control">
                        @error('price')
                            <strong class="text-danger"> {{ $message }} </strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Quantity</label>
                        <input type="text" name="quantity" class="form-control">
                        @error('quantity')
                            <strong class="text-danger"> {{ $message }} </strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary form-control" type="submit"">Inventory Added</button>
                    </div>
                </form>
                <a href=" {{ route('product.list') }} " class="btn btn-danger form-control"> Back Product List</a>
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