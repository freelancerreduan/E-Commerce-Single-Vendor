@extends('layouts.admin')

@section('content')
<div class="row g-4">
    <!-- Left Side: Sub Category Table -->
    <div class="col-md-8 col-lg-8">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white text-center py-3 rounded-top-4"
                style="background: linear-gradient(90deg, #007bff, #00b4d8);">
                <h3 class="mb-0 fw-bold">Sub Category List</h3>
            </div>

            <div class="card-body p-4 rounded-bottom-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0 border border-2">
                        <thead class="table-primary text-center" style="font-size:25px;">
                            <tr style="font-size:25px;">
                                <th width="5%" style="font-size:20px;">SL</th>
                                <th width="30%" style="font-size:20px;">Main Category</th>
                                <th width="65%" style="font-size:20px;">Sub Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                            <tr>
                                <td class="text-center fw-semibold">{{ $index+1 }}</td>
                                <td class="fw-bold text-primary" style="font-size: 18px;">{{ $category->category_name }}</td>
                                <td>
                                    @if ($category->rel_to_subCategory->count() > 0)
                                    <table class="table mb-0 border-0" >
                                        @foreach ($category->rel_to_subCategory as $subCategory)
                                        <tr class="d-flex justify-content-between align-items-center border-0 inner-row">
                                            <td class="flex-grow-1 border-0" style="font-size: 15px;">{{ $subCategory->subcategory_name }}</td>
                                            <td class="border-0 text-end" style="white-space: nowrap;">
                                                <a data-link="{{ route('subcategory.delete',$subCategory->id) }}" class="btn btn-sm btn-danger shadow-sm px-3 delelete">
                                                    <i class="bi bi-trash3"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    @else
                                    <span class="text-muted fst-italic ps-2">No Subcategory Found</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Add Form -->
    <div class="col-md-4 col-lg-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white text-center py-3 rounded-top-4"
                style="background: linear-gradient(90deg, #198754, #00c46a);">
                <h3 class="mb-0 fw-bold">Add Sub Category</h3>
            </div>
            <div class="card-body p-4 rounded-bottom-4">
                <form action="{{ route('store.subcategory') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 18px;">Select Main Category</label>
                        <select name="category_id" class="form-select shadow-sm border-0 rounded-3">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 18px;">Sub Category Name</label>
                        <input type="text" name="subcategory_name"
                            class="form-control shadow-sm border-0 rounded-3"
                            placeholder="Enter Subcategory Name" style="font-size: 18px;">
                    </div>

                    <div class="text-center">
                        <button class="btn w-100 py-2 rounded-3 shadow-sm fw-semibold"
                            style="background: linear-gradient(90deg, #007bff, #00b4d8); color:white; font-size:18px; border:none;">
                            <i class="bi bi-plus-circle"></i> Add Category
                        </button>
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


    {{-- Sub Category Click Alert --}}
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
