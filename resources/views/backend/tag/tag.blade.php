@extends('layouts.admin')

@section('content')
<div class="container my-5">
  <div class="row g-4">
    <!-- Left Side: Sub Category Table -->
    <div class="col-md-8 col-lg-8">
      <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header text-white text-center py-3 rounded-top-4"
             style="background: linear-gradient(90deg, #007bff, #00b4d8);">
          <h3 class="mb-0 fw-bold">Tag List</h3>
        </div>

        <div class="card-body p-4 rounded-bottom-4">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0 border border-2">
              <thead class="table-primary text-center">
                <tr>
                  <th width="5%" style="font-size:15px">SL</th>
                  <th width="30%" style="font-size:15px">Tag Name</th>
                  <th width="65%" style="font-size:15px">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tag_list as $index => $tag)
                <tr class="align-middle">
                    <td class="text-center fw-semibold" style="width:1%; font-size:15px;"> {{ $index+1 }} </td>
                    <td class="fw-bold text-primary" style="width:94%; font-size:15px;"> {{ $tag->tag_name }} </td>
                    <td class="text-end" style="width:5%;"> 
                        <a data-link="{{ route('tag.delete',$tag->id) }}" class="btn btn-sm btn-danger shadow-sm px-3 delelete"> Delete </a> 
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
             style="background: linear-gradient(45deg, #d4d4d4, #7c19b878);">
          <h3 class="text-center">Add Tag</h3>
        </div>  

        <div class="card-body p-4 rounded-bottom-4">
          <form action="{{  route('store.tag') }}" method="POST">
            @csrf
            
            <div class="mb-3">
              <label class="form-label fw-semibold" style="font-size:15px">Tag Name</label>
              <input type="text" class="form-control shadow-sm border-0 rounded-3"
                     placeholder="Enter Tag Name" name="tag_name">
            </div>

            <div class="text-center">
              <button type="submit"
                      class="btn w-100 py-2 rounded-3 shadow-sm fw-semibold"
                      style="background: linear-gradient(90deg, #007bff, #00b4d8); color:white;">
                <i class="bi bi-plus-circle"></i> Add Tag
              </button>
            </div>
          </form>
        </div>
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


{{-- Tag Deleted Alert --}}
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
{{-- deleted Success alert --}}
@if (session('delete'))
    <script>
        Swal.fire({
        title: "Deleted!",
        text: "Your Tag has been deleted.",
        icon: "success"
        });
    </script>
@endif
@endsection