@extends('master')

@section('content')
    <div class="container">
        @if(isset($custErrors))
            <div>
                <span class="alert-danger">
                    {{ $custErrors }}
                </span>
            </div>
        @endif
            <div class="col-md-4"></div>
            <div class="col-md-4 form-group" align="center">
                <p>Select Random Users</p>
                <form method="post">
                    {{ csrf_field() }}
                    <label for="rand-num" class="form-label" >Select # Users</label>
                    <input type="number" id="rand-num" name="rand_num" class="form-control" value="4">
                    <label for="pool" class="form-label">From This Pool</label>
                    <select name="pool" class="form-control">
                        <option value="all" selected>All</option>
                        @foreach ($pools as $pool)
                            <option value="{{ $pool->drug_pool }}">{{ $pool->drug_pool }}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="selectRandom" class="btn btn-primary" value="Select Random Users">
                </form>
            </div>
        </div>
        @if(isset($members))
            <div class="col-md-12" align="center">
                <a href="{{ route('export') }}"><button class="btn btn-primary">Select & Export</button></a>
            </div>
            @include('members.membersTable')


        @endif
    @endsection