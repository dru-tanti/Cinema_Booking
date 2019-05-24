<?php echo form_open_multipart("booking/create/{$screening['screening_id']}/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <input type="hidden" name="booking-screening" value="<?php echo $screening['screening_id'] ?>">
                <?php echo form_error('booking-email'); ?>
                <?php echo custom_form_input('Email', [
                    'name'          => 'booking-email',
                    'class'         => 'form-control',
                    'placeholder'   => 'example@email.com',
                    'value'         => set_value('booking-email')
                ]); ?>
                <?php echo form_error('booking-seat'); ?>

                <table>
<?php
    $cols = $cinema['capacity'] / $cinema['num_rows'];
    for ($row = 0; $row < $cinema['num_rows']; $row++):
?>
                    <tr>
<?php
    for ($col = 0; $col < $cols; $col++):
        $seat = ($row * $cols) + $col;
?>
                        <td>
                            <input type="checkbox" name="booking-seat[]" class="mx-3 my-2" value="<?php echo $seat; ?>">
                        </td>
<?php endfor; ?>
                    </tr>
<?php endfor; ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
