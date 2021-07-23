@extends('layouts.app_org')
@section('title', 'Driver coas')
@section('content')
    <div class="container mx-auto sm:px-4">
        <div class="text-center">
            <h3>
                COA Administrator
            </h3>
            <div class="flex flex-wrap >">
                <div class="md:w-full pr-4 pl-4">
                    <br/>
                    @if (\Session::has('success'))
                        <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br/>
                    @endif
                    <div class="mb-4 flex flex-wrap ">
                        <div class="relative sm:flex-grow sm:flex-1">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="myInput1" onkeyup="myFunction()"
                                   placeholder="Search for names..">
                        </div>
                        <div class="relative sm:flex-grow sm:flex-1">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" id="myInput2" onkeyup="myFunction1()"
                                   placeholder="Search for batches..">
                        </div>
                        <div class="relative sm:flex-grow sm:flex-1">

                            <form action="{{url('coas/create')}}" method="get">
                                @csrf
                                <input name="_method" type="hidden" value="CREATE">
                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600" type="submit">New COA</button>
                            </form>
                        </div>
                    </div>

                    <table id="coa_table" class="w-full max-w-full mb-4 bg-transparent table-hover table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Batch Number</th>
                            <th>File Name</th>
                            <th>Original Name</th>
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
                                <td>{{$coa->original_name}}</td>

{{--
                                <td><a href="{{action('CoaController@edit', $coa['id'])}}"
                                       class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-green-500 text-white hover:bg-green-600">Edit</a>
                                </td>
--}}
                                <td>
                                    <form action="{{route('file.delete', $coa['id'])}}" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline  text-teal-500 border-teal-500 hover:bg-teal-500 hover:text-white bg-white hover:bg-teal-600" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300">
                Oz Distribution
            </div>
        </div>
    </div>
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

@endsection







