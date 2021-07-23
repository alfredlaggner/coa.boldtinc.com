@extends('coa.resources.views.layouts.app_org')
@section('title', 'Download')
@section('content')
    <div class="container mx-auto sm:px-4">
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 text-center">
            <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                <b>Certificates of Analysis Document Download</b>
            </div>


            <br/>
            @if (\Session::has('success'))
                <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800">
                    <p>{{ \Session::get('success') }}</p>
                </div><br/>
            @endif
            <table class="w-full max-w-full mb-4 bg-transparent table-striped" id="coa_table">
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
            <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300">
                Copyright Oz Distribution &copy;@php   echo date("Y"); @endphp
            </div>
        </div>
    </div>
@endsection





