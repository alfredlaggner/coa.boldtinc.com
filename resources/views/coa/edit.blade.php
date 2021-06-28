@extends('coa.resources.views.layouts.app_org')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit COA</div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))

                            <div class="alert alert-success alert-block">

                                <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong>{{ $message }}</strong>

                            </div>

                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form method="post" action="{{action('CoaController@update', $id)}}" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">

                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" value="{{$coa->product_name}}">
                            </div>
                            <div class="form-group">
                                <label for="coaNumber">Number</label>
                                <input type="text" class="form-control" name="coa_number" id="coa_number" value="{{$coa->coa_number}}">
                            </div>
                            <div class="form-group">
                                <label for="coaNumber">File Name</label>
                                <input type="text" class="form-control" readonly name="coa_name" id="coa_name" value="{{$coa->coa_name}}">
                            </div>
                            <div class="form-group">
                                <label for="coaNumber">Original Name</label>
                                <input type="text" class="form-control" readonly name="original_name" id="original_name" value="{{$coa->original_name}}">
                            </div>
                            <div class="form-group">
                                <label for="coa-file">Get COA file</label>
                                <input type="file" class="form-control-file" name="fileToUpload" aria-describedby="fileHelp" id="coa_name">
                            </div>
                            <p><b>You must re-upload the file after each edit! </b></p>
                            <button class="btn btn-primary" type="submit">Fix me</button>

                            <a href="{{ route('go-home') }}" class="btn btn-outline-primary btn-sm" role="button"
                               aria-pressed="true">Home</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection







