@extends('coa.resources.views.layouts.app_org')
@section('title', 'Download')
@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <b>Certificates of Analysis Document Download</b>
            </div>


            <br/>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div><br/>
            @endif
            <table class="table table-striped" id="coa_table">
                <thead>
                <tr>
                    <th>Batch</th>
                    <th>Batch Number</th>
                    <th>COA Document</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @push('scripts')
                    <script>
                        $(document).ready(function () {
                            $('#coa_table').DataTable({
                                serverSide: true,
                                processing: true,
                                responsive: true,
                                ajax: "{{ route('get_extra_data_datatables_attributes_data') }}",
                                columns: [
                                    {name: 'product_name'},
                                    {name: 'coa_number'},
                                    {name: 'coa_name'},
                                    {name: 'action', orderable: false, searchable: false}
                                ],
                            });
                        });
                    </script>
                @endpush
                </tbody>

            </table>
            <div class="card-footer">
                Copyright Oz Distribution &copy;@php   echo date("Y"); @endphp
            </div>
        </div>
    </div>
@endsection





