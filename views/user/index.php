<?php
require_once './views/layout/header.php';
$role = [
    0 => 'user',
    1 => 'admin'
    ]
?>
<div class="container">
    <h2 class="text-center text-uppercase my-3 text-primary">Danh sách người dùng</h2>

    <a class="btn btn-primary mb-3" href="/User/Create">Thêm bài viết</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php 
                $i = 1;
                foreach ($users as $user): 
            ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $user->getUsername() ?></td>
                    <td><?= $role[$user->getRole()] ?></td>
                    <td>
                        <form method="GET" action="User/Update">
                            <input type="hidden" name="id" value=<?= $user->getId() ?> />
                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value=<?= $user->getId() ?> />
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>                    
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<?php
    require_once './views/layout/footer.php';
?>