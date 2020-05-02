<div class="container-fluid">
    <table class="table">
        <thead>
            <th>nama</th>
            <th>alamat</th>
            <th>penghuni</th>
        </thead>
        <tbody>
            <?php foreach($user as $u):?>
            <tr>
                <td><?php echo $u->nama?></td>
                <td><?php echo $u->alamat?></td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>