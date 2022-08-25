<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        

        $keyword="";
        if (isset($_POST['search'])) {
            $keyword = $_POST['search'];
        }
        $conn = mysqli_connect("localhost", "id19457281_admin", "172B0S5G|Bo[c4]{", "id19457281_mydb");

        $query = mysqli_query($conn,"SELECT * FROM users WHERE username LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' ORDER BY id DESC");
        $hitung_data = mysqli_num_rows($query);
        if ($hitung_data > 0) {
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['level']; ?></td>
                </tr>
            <?php } } else { ?> 
                <tr>
                    <td colspan='4' class="text-center">Tidak ada data ditemukan</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>