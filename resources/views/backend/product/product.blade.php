@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center mt-3">Add Product Details</h3>
            </div>
            <div class="card-body">
                <form action=" {{ route('store.product') }} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <label for="" class="for-label">Select Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value=""> Select Category </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->category_name }} </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div> 
                        <div class="col-md-4 col-lg-4">
                            <label for="" class="form-label">Select Sub Category</label>
                            <select name="subcategory_id" id="" class="form-control">
                                <option value=""> Select Sub Category </option>
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}"> {{ $sub_category->subcategory_name }} </option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <label for="" class="form-label">Select Tag </label>
                            <select id="select-gear" name="tag_id[]" class="demo-default" multiple placeholder="Select Tag...">
                            <option value="">Select Tag...</option>
                            <optgroup label="Category Tags">
                                @foreach ($tags as $tag)
                                    <option value=" {{ $tag->id }} "> {{ $tag->tag_name }} </option>
                                @endforeach
                            </optgroup>
                            </select>
                            @error('tag_id')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>

                        {{-- Product Name --}}
                        <div class="col-md-4 col-lg-4 mt-3">
                            <label for="" class="form-label">Product Name</label>
                            <input type="text" class="form-control border border-primary" name="product_name">
                            @error('product_name')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>

                        {{-- Product Price --}}
                        <div class="col-md-4 col-lg-4 mt-3">
                            <label for="" class="form-label">Product Price</label>
                            <input type="text" class="form-control border border-primary" name="price">
                            @error('price')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>
                        {{-- Product Discount --}}
                        <div class="col-md-4 col-lg-4 mt-3">
                            <label for="" class="form-label">Product Discount</label>
                            <input type="text" class="form-control border border-primary" name="discount">
                            @error('discount')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>
                        {{-- Product Short Des --}}
                        <div class="col-md-12 col-lg-12 mt-3">
                            <label for="" class="form-label">Product Short Des</label>
                            <input type="text" class="form-control border border-primary" name="short_des">
                            @error('short_des')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>

                        {{-- Product Short Des --}}
                        <div class="col-md-12 col-lg-12 mt-3">
                            <label for="" class="form-label">Product Logn Des</label>
                            <textarea name="long_des" id="summernote" cols="30" rows="10" class="form-control border border-primary"></textarea>
                            @error('long_des')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>

                        {{-- Product Previous --}}
                        <div class="col-md-4 col-lg-4 mt-3">
                            <label for="" class="form-label">Product Previous</label>
                            <input type="file" class="form-control border border-primary" name="Previous">
                            @error('previous')
                                <strong class="text-danger"> {{ $message }} </strong>
                            @enderror
                        </div>

                        {{-- Product gallary --}}
                        <div class="col-md-4 col-lg-4 mt-3">
                            <label for="" class="form-label">Product Gallary</label>
                            <input type="file" class="form-control border border-primary" name="gallary[]" multiple>
                        </div>

                        {{-- Product Add --}}
                        <div class="col-md-12 col-lg-12 mt-3">
                            <div class="mt-3">
                                <button class="btn btn-primary form-control" type="submit">Add Product</button>
                            </div>
                        </div>
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


     <script>
        $('#select-gear').selectize({ sortField: 'text' })
        $('#summernote').summernote();
     </script>
@endsection