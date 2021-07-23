<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
<div class="container mx-auto sm:px-4">
    <div class="relative flex flex-col max-w-lg rounded break-words border bg-white border-1 border-gray-300 text-center">
        <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
            <b>Boldt COA Management</b>
            <div class="relative flex-grow max-w-full flex-1 px-4" style="margin-top: 20px;">

                <form action="{{url('coas/create')}}" method="get">
                    @csrf
                    <input name="_method" type="hidden" value="CREATE">
                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-blue-600 text-white hover:bg-blue-600"
                            type="submit">Add COA
                    </button>
                </form>
            </div>

        </div>

        <div class="md:w-full pr-4 pl-4">

            @if (\Session::has('success'))
                <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800">
                    <p>{{ \Session::get('success') }}</p>
                </div><br/>
            @endif
            <table class="w-full max-w-full mb-4 bg-transparent border" id="coa_table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Strain</th>
                    <th>Batch Number</th>
                    <th>Document Name</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($coas as $coa)
                    <tr>
                        <td>{{$coa->id}}</td>
                        <td>{{$coa->product_name}}</td>
                        <td>{{$coa->coa_number}}</td>
                        <td>{{$coa->coa_name}}</td>

                        <td aria-colspan="2">
                            <form action="{{route('download', $coa['id'])}}" method="get">
                                @csrf
                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-green-500 text-white hover:bg-green-600"
                                        type="submit">Download
                                </button>
                            </form>
                        </td>
                        <td>
                            <button type="button"
                                    class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-red-600 text-white hover:bg-red-700"
                                    data-toggle="modal"
                                    data-target="#exampleModalLong">
                                Delete
                            </button>
                        </td>

                    </tr>
                    <!-- Modal -->
                    <div class="modal opacity-0" id="exampleModalLong" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLongTitle"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete
                                        Record {{$coa['id']}}</h5>
                                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                            data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure?
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                            class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-gray-600 text-white hover:bg-gray-700"
                                            data-dismiss="modal">
                                        Close
                                    </button>
                                    <form action="{{route('file.delete', $coa['id'])}}" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  bg-red-600 text-white hover:bg-red-700"
                                                type="submit">Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                </tbody>
            </table>
            <div class="mb-4 flex flex-wrap ">
                <div class="relative sm:flex-grow sm:flex-1">
                    <input type="text"
                           class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                           id="myInput1" onkeyup="myFunction()"
                           placeholder="Search for names..">
                </div>
                <div class="relative sm:flex-grow sm:flex-1">
                    <input type="text"
                           class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                           id="myInput2" onkeyup="myFunction1()"
                           placeholder="Search for batches..">
                </div>
            </div>

        </div>
        <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300">
            Copyright Oz Distribution &copy;@php   echo date("Y"); @endphp
        </div>

    </div>
</div>
</body>
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput1");
        filter = input.value.toUpperCase();
        table = document.getElementById("coa_table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function myFunction1() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        table = document.getElementById("coa_table");
        tr = table.getElementsByTagName("tr");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>





