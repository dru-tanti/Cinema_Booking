<div class="row content">
    <div class="col">

        <div class="card">
            <div class="card-header border-bottom-0 d-flex">
                <a href="<?php echo site_url('cinema/create'); ?>" class="ml-auto">New film</a>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="text-left" style="width: 60%">Cinema Name</th>
                            <th scope="col">Capacity</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (!$cinemas): ?>
                        <tr>
                            <td colspan="3">No Cinemas in the database.</td>
                        </tr>
<?php else: foreach ($cinemas as $cinema): ?>
                        <tr>
                            <td class="text-left"><?php echo $cinema['name']; ?></td>
                            <td><?php echo $cinema['capacity'];?></td>
                            <td class="d-flex justify-content-center">
                                <a href="<?php echo site_url("cinema/edit/{$cinema['id']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?php echo site_url("cinema/delete/{$cinema['id']}"); ?>" class="d-block mx-2">
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
