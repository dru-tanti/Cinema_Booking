<?php echo form_open_multipart("home/booking/{$screening['screening_id']}/submit", ['class' => 'row content']); ?>
<div class="container-fluid" id="content">
    <div class="row">
        <main class="col-10 my-4">
            <div class="card">

            <input type="hidden" name="booking-screening" value="<?php echo $screening['screening_id'] ?>">
            <div class="row d-flex justify-content-center">
                    <img src="<?php echo base_url().'/images/screen.png' ?>" alt="Screen" style="width: 50%; height: 50%">
               <table>
<?php echo form_error('booking-seat'); ?>
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
            <div class="mx-4 my-5">
                <?php echo form_error('booking-email'); ?>
                <?php echo custom_form_input('Email', [
                    'name'          => 'booking-email',
                    'class'         => 'form-control',
                    'placeholder'   => 'example@email.com',
                    'value'         => set_value('booking-email')
                ]); ?>
            </div>
            <div>
                <button type="submit" class="btn btn-lg btn-secondary w-100">Submit</button>
            </div>
        </div>
        </main>
    </div>
</div>
<?php echo form_close(); ?>
