@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-8 col-lg-8">

    </div>
    <div class="col-md-4 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center"> Add Inventory</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" disabled class="form-control" value ="TEST">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Select Color</label>
                        <select name="color_id" class="form-control">
                            <option value=""> Select Color </option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id  }}"> {{ $color->color_name  }} </option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Select Size</label>
                        <select name="size_id" class="form-control">
                            <option value=""> Select Size </option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id  }}"> {{ $size->size_name  }} </option> 
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection