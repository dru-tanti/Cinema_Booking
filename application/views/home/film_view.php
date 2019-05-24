<div class="container-fluid" id="content">
    <div class="row">
        <main class="col-12 col-md-8 my-4">
            <div class="page-header">
                <h1><?php echo $film['title'] ?></h1>
            </div>
        <div class="film-listing">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="<?php echo base_url($film['image']); ?>" class="card-img" alt="<?php echo $film['title']; ?>">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="card-text col-2"><small class="text-muted">Rating: E</small></p>
                                <p class="card-text col-3"><small class="text-muted">Release Date: <?php echo date("d/m/Y", $film['release']); ?></small></p>
                                <p class="card-text col-3"><small class="text-muted">Runtime: <?php echo $film['runtime']; ?> minutes</small></p>
                            </div>
                            <p class="card-text"><?php readfile(base_url()."uploads/films/text/".$film['id'].".txt"); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php foreach ($categories as $category): ?>
        <div class="btn btn-secondary bg-dark">
            <?php echo $category ?>
        </div>
<?php endforeach; ?>
        </main>
        <aside class="sidebar col-12 col-md-2 d-block m-4">
            <div class="page-header">
                <h1>Sidebar</h1>
            </div>
<?php foreach($screenings as $screening): ?>
               <a class="btn bg-dark btn-secondary btn-sm btn-block" href="<?php echo site_url("home/booking/{$screening['screening_id']}") ?>">
                   <h5 class="card-text"><?php echo date("H:i", $screening['time']);?></h5>
                  <h6 class="card-title"><?php echo date("d F Y", $screening['time']);?></h6>
                  <p class="card-text"><?php echo $screening['name']; ?></p>
               </a>
<?php endforeach; ?>
        </aside>
    </div>
</div>
