@extends('dashboard.layouts.dashboard')

@section('body')
    <!-- Breadcrumb -->


    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ Route('dashboard.order.updateToAccept', $order) }}" method="post">
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

                        <div class="card-block">
                            <div class="form-group col-md-6" >
                                <label>Status</label>
                                <select name="status" id="" style="margin-right: 70px">
                                    <option value="accepted">Accept</option>
                                </select>
                                <label>Supervisor</label>
                                <select name="supervisor_id" id="">
                                    @foreach ( $users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <textarea name="message" id="" cols="58" rows="3" placeholder="write reasons here"></textarea>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fa fa-dot-circle-o"></i>Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
