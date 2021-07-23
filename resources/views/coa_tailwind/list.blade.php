@extends('layouts.app_org')
@section('title', 'Download')
@section('content')
    <div class="container mx-auto sm:px-4">
            <h5 class="text-center">
                <b>Certificates of Analysis Database Search</b>
            </h5>
<h6>How to find a COA: </h6>
        <p>Enter either the product name or batch number in the search field. Press or click the download button once you see the desired COA.</p>
            <table class="w-full max-w-full mb-4 bg-transparent table-hover" width="100%" id="coa_table">
                <thead>
                <tr>
                    <th>Batch</th>
                    <th>Batch Number</th>
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
                                    {name: 'action', orderable: false, searchable: false}
                                ],
                            });
                        });
                    </script>
                @endpush
                </tbody>
            </table>
            <div class="text-center">
                Copyright Oz Distribution &copy;@php   echo date("Y"); @endphp
            </div>
    </div>
@endsection





