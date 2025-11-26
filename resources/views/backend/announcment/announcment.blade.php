@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-8 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <h4 class="text-center">Add Announsment</h4>
                </div>
                <div class="card-body">
                    <form action=" {{ route('store.announsment') }} " method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Enter Announsment</label>

                            <textarea name="announsment" id="" cols="30" rows="10" class="form-control border border-danger" placeholder="Enter your message here..."">  {{ $announsment->announsment }} </textarea>
                            @error('announsment')
                                <p class="text-danger"> {{ $message  }} </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="status" id="" class="border border-danger">
                                <option value="1" {{ $announsment->status == 1 ? 'selected' : '' }}> Active </option>
                                <option value="0" {{  $announsment->status == 0 ? 'selected' : ''}}  > Disabled </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit""> Update </button>
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

@endsection