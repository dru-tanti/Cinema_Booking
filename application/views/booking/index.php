<div class="row content">
    <div class="col">

        <div class="card">
            <div class="card-header border-bottom-0 d-flex">
                <h4 class="text-center text-md-left"><?php echo ucwords($section); ?> List</h4>

                <a href="<?php echo site_url('booking/create'); ?>" class="ml-auto">New booking</a>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="text-left" style="width: 40%">Film</th>
                            <th scope="col">Email</th>
                            <th scope="col">Showing Time</th>
                            <th scope="col">Seat Number</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (!$bookings): ?>
                        <tr>
                            <td colspan="3">No bookings in the database.</td>
                        </tr>
<?php else: foreach ($bookings as $booking): ?>
                        <tr>
                            <td class="text-left"><?php echo $booking['title'];?></td>
                            <td><?php echo $booking['email']; ?></td>
                            <td><?php echo date("d-F-Y h:i A", $booking['time']);?></td>
                            <td><?php echo $booking['seat_no'];?></td>
                            <td class="d-flex justify-content-center">
                                <a href="<?php echo site_url("booking/edit/{$booking['id']}"); ?>" class="d-block mx-2">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?php echo site_url("booking/delete/{$booking['id']}"); ?>" class="d-block mx-2">
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
