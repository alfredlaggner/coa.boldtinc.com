@extends('layouts.app_org')
@section('title', 'Download')
@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <H5>Boldt COA Management</H5>
                <div class="col" style="margin-top: 20px;">

                    <form action="{{url('coas/create')}}" method="get">
                        @csrf
                        <input name="_method" type="hidden" value="CREATE">
                        <button class="btn btn-sm btn-primary" type="submit">Add COA</button>
                    </form>
                </div>

            </div>

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
                </div>
                <table class="table table-bordered" id="coa_table" style="width: 100%">
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
                        @php
                            $id = $coa['id'];
                            @endphp
                        <tr>
                            <td>{{$coa->id}}</td>
                            <td>{{$coa->product_name}}</td>
                            <td>{{$coa->coa_number}}</td>
                            <td>{{$coa->coa_name}}</td>

                            <td aria-colspan="2">
                                <form action="{{route('download', $coa['id'])}}" method="get">
                                    @csrf
                                    <button class="btn btn-sm btn-success" type="submit">Download</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route('file.delete', $id)}}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>

{{--
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#exampleModalLong">
                                    Delete
                                </button>
--}}
                            </td>

                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLongTitle"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Delete
                                            Record {{$id}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                                            Close
                                        </button>
                                        <form action="{{route('file.delete', $id)}}" method="post">
                                            @csrf
                                            <input name="id"  content="{{$id}}">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    </tbody>

                </table>
            </div>
            <div class="card-footer">
                Copyright Oz Distribution &copy;@php   echo date("Y"); @endphp
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





