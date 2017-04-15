@extends('master')


@section('content')
<div class="container-fluid">
    <div class="col-md-4 " align="center">
        <p>Select Random Users</p>
        <form role="form" action="randomSelection.php" method="post" autocomplete="off" class="form-inline">
            <label for="rand-num" >Select</label>
            <input type="number" id="rand-num" name="rand-num" class="form-control" value="4">
            <label for="rand-num" >Users.</label>
            <input type="submit" name="selectRandom" class="btn btn-primary" value="Select Random Users">
            <input type="hidden" id="rand-form" name="formtype" value="rand-form">
        </form>
    </div>
    <form method="post" action="route.php">
        <select name="pool">
            <option value="all">All</option>
            <?php
            $pools = $mrs->GetPools();

            foreach ($pools as $pool) {
                echo '<option value="'.$pool['drug_pool'].'">'.$pool['drug_pool'].'</option>';
            }
            ?>
        </select>
        <input id="change_pool" type="submit" name="change_pool" value="Change Pool"> <!-- do some JS to refresh the page with the format of /index?pool=$_POST['pool']-->
        <input type="hidden" name="formtype" value="changepool">
    </form>
    <div class="col-md-4 pull-right">
        <ul class="pagination">
            <?php
            $pagination = $mrs->Pagination();
            ?>
            <a href="viewselected.php"><button class="btn btn-primary">Export Selected Members</button></a>
        </ul>
    </div>
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
            <?php
            if(isset($_GET['viewSelected']) && $_GET['viewSelected'] == 1){
                $members = $mrs->ViewSelected();
            }else{
                if(isset($_GET['pool'])){
                    $pool = $_GET['pool'];
                }else{
                    $pool = 'all';
                }
                $members = $mrs->GetMembers($pagination['perpage'], $pool);
            }
            if($members) {
                foreach ($members as $member) {
                    echo '<tr>';
                    echo '<td>';
                    echo $member['personel_number'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['first_name'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['middle_name'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['last_name'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['ssn'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['job_location'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['manager'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['hr_rep'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['field_admin'];
                    echo '</td>';
                    echo '<td>';
                    echo $member['drug_pool'];
                    echo '</td>';
                    echo '<td>';
                    echo '<div><a href="edit.php?user_id=' . $member['id'] . '"><div class="glyphicon glyphicon-edit"></div></a> &nbsp;|&nbsp; <a href="route.php?deluser=1&user_id=' . $member['id'] . '"><div class="glyphicon glyphicon-remove"></div></a></div>';
                    echo '</td>';
                    echo '</tr>';
                }
            }else{
                echo 'there are no un selected members currently.';
            }
            ?>
        </table>
    </div>
</div>

@stop
