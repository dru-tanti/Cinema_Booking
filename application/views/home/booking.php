<div class="container-fluid" id="content">
    <div class="row">
        <main class="col-12 col-md-8 my-4">
            <div class="page-header">
                <h1>Main Content</h1>
            </div>
            <div class="row">
               <div class="col-md-6">
                   <table align="center">
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
        </main>
        <aside class="sidebar col-12 col-md-2 d-block m-4">
            <div class="page-header">
                <h1>Sidebar</h1>
            </div>

        </aside>
    </div>
</div>
