        <nav class = "navbar navbar-expand-lg sticky-top border-bottom py-1">
            <a href="index.html" class="navbar-brand ml-4">
                <img src="<?php echo base_url('images/logo.png') ?>" width = "64" height= "64" alt="Eden Cinemas Logo" class="d-sm-block">
            </a>
            <div class="nav-container d-flex mr-auto mt-2 mt-lg-0 ml-3">
                <a class="nav-link px-5" href="#">Now Showing</a>
                <a class="nav-link px-5" href="#">Coming Soon</a>
                <a class="nav-link px-5" href="#">Contact Us</a>
                <a class="nav-link px-5" href="backend.html">Disabled</a>
                <?php $is_logged = $this->system->confirm_session();
                    if(!$is_logged):
                ?>
                <a class="nav-link px-5" href="login">Login</a>
                <?php else: ?>
                <a href="#"><i class="fas fa-user"></i></a>
                <a href="<?php $this->session->sess_destroy(); ?>"> Logout</a>
                <?php endif; ?>
            </div>
        </nav>
