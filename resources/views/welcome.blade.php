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

    <div class="col-md-4 form-group">
            {{ Form::open(['method'=>'post', 'class'=>'form form-horizontal']) }}
                <select name="pool" class="form-control">
                    <option value="all" selected>All</option>
                    @foreach ($pools as $pool)
                        <option value="{{ $pool->drug_pool }}">{{ $pool->drug_pool }}</option>
                    @endforeach
                </select>
                {{ Form::submit('Change Drug Pool',['class'=>'btn btn-primary']) }}
            {{ Form::close() }}
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <ul class="pagination">
            <?php
            //$pagination = $mrs->Pagination();
            ?>
            <a href="viewselected.php"><button class="btn btn-primary">Export Selected Members</button></a>
        </ul>
    </div>
    @include('members.membersTable')

</div>

@stop
