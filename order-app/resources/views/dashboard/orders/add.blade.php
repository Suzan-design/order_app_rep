@extends('dashboard.layouts.dashboard')

@section('body')
<!-- Breadcrumb -->


<div class="container-fluid" >
    <div class="animated fadeIn">
        <form action="{{Route('dashboard.order.store')}}" method="post" >
        @csrf
        @method('POST')
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <strong>Orders</strong>
                </div>

                <div class="card-block" >


                    <div class="form-group col-md-6">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" rows="5" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>Submit</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
