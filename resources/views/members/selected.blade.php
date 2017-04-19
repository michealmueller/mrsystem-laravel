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
        @endif
        <div class="col-md-12">
            &nbsp;
        </div>
        @include('members.membersTable')
    </div>
@endsection