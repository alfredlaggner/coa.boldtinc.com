@extends('layouts.app_org')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New COA</div>

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


                        <form method="post" action="{{route('file.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" value="">
                            </div>
                            <div class="form-group">
                                <label for="coaNumber">Batch Number</label>
                                <input type="text" class="form-control" name="coa_number" id="coa_number" value="">
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control-file" name="fileToUpload" aria-describedby="fileHelp" id="coa_name" enctype="multipart/form-data">
                            </div>
                            <button class="btn btn-primary" type="submit">Beam me up</button>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm" role="button"
                               aria-pressed="true">Home</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection







