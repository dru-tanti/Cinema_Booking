<div class="row content">
    <div class="col">

        <div class="card">
            <div class="card-header border-bottom-0 d-flex">
                <h4 class="text-center text-md-left"><?php echo ucwords($section); ?> List</h4>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="text-left" style="width: 60%">Title</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (!$films): ?>
                        <tr>
                            <td colspan="3">No films in the database.</td>
                        </tr>
<?php else: foreach ($films as $film): ?>
                        <tr>
                            <td class="text-left"><?php echo $film['title']; ?></td>
                            <td><?php echo  date("d-M-Y h:i:s A", $film['release']);?></td>
                            <td class="d-flex justify-content-center">
                                <a href="<?php echo site_url("film/edit/{$film['slug']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?php echo site_url("film/delete/{$film['slug']}"); ?>" class="d-block mx-2">
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
