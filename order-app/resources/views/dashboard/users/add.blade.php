@extends('dashboard.layouts.dashboard')

@section('body')
<!-- Breadcrumb -->


<div class="container-fluid">
    <div class="animated fadeIn">
        <form action="{{Route('dashboard.user.store')}}" method="post">
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
                    <strong>Users</strong>
                </div>

                <div class="card-block">


                    <div class="form-group col-md-6">
                        <label>ُEmail</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="User name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="supervisor">Supervisor</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="password">
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
