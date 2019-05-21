<div class="container-fluid" id="content">
    <div class="row">
        <main class="col-12 col-md-8 my-4">
            <div class="page-header">
                <h1>Main Content</h1>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <form id="reservation" action="" method="post">
                     <section id="seats" class="seats">
                        <?php
                        $row = 0;
                        print "<table>";
                        while ($row < 8){
                           print "<tr>";
                           $row++;
                           $col = 0;
                           while ($col < 8){
                            print "<td>";
                            print '<input type="checkbox" name="battle" value="ships">';
                            print "</td>";
                            $col++;
                           }
                           print "</tr>";
                        }
                        print "</table>";
                         ?>
                     </section>
                  </form>

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
