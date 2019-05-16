<div class="row content">
    <div class="col">

        <div class="card">
            <div class="card-header border-bottom-0 d-flex">
                <h4 class="text-center text-md-left"><?php echo ucwords($section); ?> List</h4>
                <a href="<?php echo site_url('user/create'); ?>" class="ml-auto">New User</a>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (!$users): ?>
                        <tr>
                            <td colspan="3">No users in the database.</td>
                        </tr>
<?php else: foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['name'] . ' ' . $user['surname'];?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role_name'] ?></td>
                            <td class="d-flex justify-content-center">
                                <a href="<?php //echo site_url("user/edit/{$user['id']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?php //echo site_url("user/delete/{$user['id']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
<?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
