<div class="container-fluid" id="content">
    <div class="row">
        <main class="col-10 my-4">
            <div class="row d-flex justify-content-center">
                    <img src="<?php echo base_url().'/images/screen.png' ?>" alt="Screen" style="width: 50%; height: 50%">
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
            <div class="mt-5">
                <button type="submit" class="btn btn-lg btn-secondary w-100">Submit</button>
            </div>
        </main>
    </div>
</div>
