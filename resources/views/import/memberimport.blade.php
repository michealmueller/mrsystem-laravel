
@extends('master')

@section('content')

    <div class="container-fluid">
        @if($errors->any())
            <div>
            <span class="alert-danger">
                @if($errors->has('import'))
                    {{ $errors->import->first() }}
                @endif
                {{ $errors->all() }}
            </span>
            </div>
        @elseif(isset($success) && $success == true)
            <div class="alert-success">
            <span class="text-center">
                File Imported Successfully!
            </span>
            </div>
        @endif
        <div class="col-md-6">
            <p><h3>Welcome <!-- //$user->name }}-->, You Are Now Logged In.</h3></p>
        </div>
    </div>
    <div class="col-md-12 form-group">
        {{ Form::open(['method'=>'post','files'=>'true', 'class'=>'form-inline form']) }}
        <div class="form-group">
            {{ Form::label('import', 'CSV Member List', ['class'=>'form-label']) }}
            <input type="file" name="File" class="form-control">
            {{ Form::checkbox('deleteall','1', true, ['class'=>'form-control']) }}Delete All Records.
            {{ Form::submit('Import Members', ['class'=>'btn btn-primary'])}}
        </div>
        {{ Form::close() }}
    </div>

@endsection