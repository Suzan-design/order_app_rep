@extends('dashboard.layouts.dashboard')

@section('body')
<!-- Breadcrumb -->


<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Striped Table
            </div>
            <div class="card-block">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



@push('javascripts')

<script type="text/javascript">
$(function () {
    var table = $('#table').DataTable({
        processing: true,
        serverside: true,
        order: [
            [0, "desc"]
        ],
        ajax: "{{ Route('dashboard.users.all') }}",
        columns: [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'role',
            name: 'role'
        },
    ]
    })
})
</script>
@endpush
