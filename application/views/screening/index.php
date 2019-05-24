<div class="row content">
    <div class="col">

        <div class="card">
            <div class="card-header border-bottom-0 d-flex">
                <h4 class="text-center text-md-left"><?php echo ucwords($section); ?> List</h4>
                <a href="<?php echo site_url('screening/create'); ?>" class="ml-auto">New screening</a>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="text-left" style="width: 60%">Title</th>
                            <th scope="col">Cinema</th>
                            <th scope="col">Time</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (!$screenings): ?>
                        <tr>
                            <td colspan="3">No screenings in the database.</td>
                        </tr>
<?php else: foreach ($screenings as $screening): ?>
                        <tr>
                            <td class="text-left"><?php echo $screening['title']; ?></td>
                            <td><?php echo $screening['name'];?></td>
                            <td><?php echo date("d F Y h:i A", $screening['time']);?></td>
                            <td class="d-flex justify-content-center">
                                <a href="<?php echo site_url("booking/create/{$screening['screening_id']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-plus"></i>
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
