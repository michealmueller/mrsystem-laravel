@extends('master')

@section('content')
<div class="container">
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
    <div class="row">
        <div class="col-md-12">
            <form method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="personel_number">
                        <strong>ID:</strong>
                    </label>
                    <input class="form-control" name="id" type="number" value="{{ $member->id }}" tabindex="1" disabled>
                </div>

                <div class="form-group">
                    <label for="personel_number">
                        <strong>Personel Number:</strong>
                    </label>
                    <input class="form-control" name="personel_number" type="text" value="{{ $member->personel_number }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="first-name">
                        <strong>First Name:</strong>
                    </label>
                    <input class="form-control" name="first_name" type="text" value="{{ $member->first_name }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="middle-name">
                        <strong>Middle Name:</strong>
                    </label>
                    <input class="form-control" name="middle_name" type="text" value="{{ $member->middle_name }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="last_name">
                        <strong>Last Name:</strong>
                    </label>
                    <input class="form-control" name="last_name" type="text" value="{{ $member->last_name }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="ssn">
                        <strong>SSN:</strong>
                    </label>
                    <input class="form-control" name="ssn" type="text" value="{{ $member->ssn }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="job_location">
                        <strong>Job Location:</strong>
                    </label>
                    <input class="form-control" name="job_location" type="text" value="{{ $member->job_location }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="manager">
                        <strong>Manager</strong>:</strong>
                    </label>
                    <input class="form-control" name="manager" type="text" value="{{ $member->manager }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="hr_rep">
                        <strong>HR Rep:</strong>
                    </label>
                    <input class="form-control" name="hr_rep" type="text" value="{{ $member->hr_rep }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="field_admin">
                        <strong>Field Admin:</strong>
                    </label>
                    <input class="form-control" name="field_admin" type="text" value="{{ $member->field_admin }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="drug_pool">
                        <strong>Drug Pool:</strong>
                    </label>
                    <input class="form-control" name="drug_pool" type="text" value="{{ $member->drug_pool }}" tabindex="2">
                </div>

                <div class="form-group">
                    <label for="excluded">
                        <strong>Excluded:</strong>
                    </label>
                    <input class="form-control" name="excluded" type="number" maxlength="1" value="{{ $member->excluded }}" tabindex="2">
                </div>

                <div class="form-group">
                   <label for="role">
                            <strong>Role:</strong>
                    </label>
                    <input class="form-control" name="role" type="number" value="{{ $member->role }}" tabindex="3">
                </div>

                <div class="text-center">
                    <input type="submit" name="update" class="btn btn-success" value="Update" tabindex="8">
                </div>

            </form>
        </div>
    </div>
</div>
@endsection