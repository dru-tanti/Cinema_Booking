
        <nav class="header">
            <div class="row nav-container mx-4">
                <div class="col d-flex flex-column justify-content-center">
                    <a href="<?php echo site_url('home') ?>" class="navbar-brand">
                        <img src="<?php echo base_url('images/logo.png') ?>" width = "72" height= "72" alt="Eden Cinemas Logo" class="">
                    </a>
                </div>
                <div class="col d-flex flex-column justify-content-center">
                    <a href="#"><h5>Now Showing</h5></a>
                </div>
                <div class="col d-flex flex-column justify-content-center">
                    <?php $is_logged = $this->system->confirm_session();
                    if(!$is_logged):
                        ?>
                        <a href="<?php echo site_url('login') ?>"><h6>Login</h6></a>
                    <?php else: ?>
                        <a href="<?php echo site_url('logout') ?>"><i class="fas fa-user"></i> <h6>Logout</h6></a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
