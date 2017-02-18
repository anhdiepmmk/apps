<table class="table table-bordered table-referral">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Last login</th>
            <th>Register Time</th>
        </tr>
        <?php foreach($referralList as $row) { ?>
        <tr>
            <td>{{$row->name}}</td>
            <td>{{$row->email}}</td>
            <td>{{date('Y-m-d H:i:s', $row->last_login)}}</td>
            <td>{{$row->created_at->toDateTimeString()}}</td>
        </tr>
        <?php } ?>
</table>
