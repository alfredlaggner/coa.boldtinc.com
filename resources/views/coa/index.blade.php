@extends('layouts.app_org')
@section('title', 'Driver coas')
@section('content')
    <div class="container">
        <div class="text-center">
            <h3>
                COA Administrator
            </h3>
            <div class="row>">
                <div class="col-md-12">
                    <br/>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br/>
                    @endif
                    <div class="form-group row">
                        <div class="col-sm">
                            <input type="text" class="form-control" id="myInput1" onkeyup="myFunction()"
                                   placeholder="Search for names..">
                        </div>
                        <div class="col-sm">
                            <input type="text" class="form-control" id="myInput2" onkeyup="myFunction1()"
                                   placeholder="Search for batches..">
                        </div>
                        <div class="col-sm">

                            <form action="{{url('coas/create')}}" method="get">
                                @csrf
                                <input name="_method" type="hidden" value="CREATE">
                                <button class="btn btn-primary" type="submit">New COA</button>
                            </form>
                        </div>
                    </div>

                    <table id="coa_table" class="table table-hover table-bordered" width="100%">
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
                                       class="btn btn-success">Edit</a>
                                </td>
--}}
                                <td>
                                    <form action="{{route('file.delete', $coa['id'])}}" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn  btn-outline-info" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
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







