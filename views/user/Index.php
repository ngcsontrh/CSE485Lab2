<?php
    require_once './views/layout/header.php';
?>
<div class="container">
    <h2 class="text-center text-uppercase my-3 text-primary">Danh sách người dùng</h2>

    <a class="btn btn-primary mb-3" href="">Thêm bài viết</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php 
                $i = 1;
                foreach ($users as $user): 
            ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><a class="text-primary" href=""><i class="bi bi-eye-fill"></i></a></td>
                    <td><a class="text-primary" href=""><i class="bi bi-pencil-fill"></i></a></td>
                    <td><a class="text-primary" href=""><i class="bi bi-trash-fill"></i></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<?php
    require_once './views/layout/footer.php';
?>