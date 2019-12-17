@extends('layouts.master')
@section('content')
 <table class="table table-bordered" id="job-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Status</th>
            <th>Budget</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
@endsection
@push('script')
    <script>
        $(function() {
            $('#job-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('client.order.list.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'order_status', name: 'status' },
                    { data: 'job_detail.budget', name: 'budget' },
                    { data: 'job_detail.title', name: 'title' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });
        });
    </script>
@endpush