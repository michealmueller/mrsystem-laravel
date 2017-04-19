<div class="container-fluid">
    <div class="col-md-12 table-responsive">
        <table class="table table-hover">
            <tr>
                <th>Personel Number</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>LastName</th>
                <th>SSN</th>
                <th>Job Location</th>
                <th>Manager</th>
                <th>HR Rep</th>
                <th>Field Admin</th>
                <th>Drug Pool</th>
                <th>Modify</th>
            </tr>
            @if($members)
                @foreach ($members as $member)
                    <tr>
                        <td>
                            {{ $member->personel_number }}
                        </td>
                        <td>
                            {{  $member->first_name }}
                        </td>
                        <td>
                            {{ $member->middle_name }}
                        </td>
                        <td>
                            {{ $member->last_name }}
                        </td>
                        <td>
                            {{ $member->ssn }}
                        </td>
                        <td>
                            {{ $member->job_location }}
                        </td>
                        <td>
                            {{ $member->manager }}
                        </td>
                        <td>
                            {{ $member->hr_rep }}
                        </td>
                        <td>
                            {{ $member->field_admin }}
                        </td>
                        <td>
                            {{ $member->drug_pool }}
                        </td>
                        <td>
                            <div><a href="members/edit/{{ $member->id }}"><i class="fa fa-edit "></i></a> &nbsp|&nbsp <a href="members/edit/remove/{{ $member->id }}"><i class="fa fa-remove"></i></a></div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td>there are no un selected members currently.</td></tr>
            @endif
        </table>
    </div>
</div>