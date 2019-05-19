<div class="container-fluid" id="content">
    <div class="row">
        <main class="col-12 col-md-8 my-4">
            <div class="page-header">
                <h1>Main Content</h1>
            </div>
        <div class="film-listing">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="<?php echo base_url()."uploads/films/images/".$film['id'].".jpg"; ?>" class="card-img" alt="<?php echo $film['title']; ?>">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="card-title"><?php echo $film['title']; ?></h3>
                                <a href="<?php echo site_url('film_view/'.$film['id']); ?>" class="ml-auto"><small>More Info</small></a>
                            </div>
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
        </main>
        <aside class="sidebar col-12 col-md-2 d-block m-4">
            <div class="page-header">
                <h1>Sidebar</h1>
            </div>
<?php foreach($screenings as $screening): ?>
            <div class="card bg-dark text-white p-3">
                <h5 class="card-title"><?php echo date("d-M-Y h:i A", $screening['time']);?></h5>
                <p class="card-text"><?php echo $screening['name']; ?></p>
            </div>
<?php endforeach; ?>
        </aside>
    </div>
</div>
