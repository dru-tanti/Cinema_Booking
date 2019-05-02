<?php echo form_open_multipart('film/create/submit', ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('film-title'); ?>
                <?php echo custom_form_input('Title', [
                    'name'          => 'film-title',
                    'class'         => 'form-control',
                    'placeholder'   => 'Film Title',
                    'value'         => set_value('film-title')
                ]); ?>

                <?php echo form_error('film-text'); ?>
                <?php echo form_textarea([
                    'rows'          => 8,
                    'cols'          => 80,
                    'name'          => 'film-text',
                    'placeholder'   => 'This is the start of your next work!',
                    'class'         => 'form-control mb-3',
                    'value'         => set_value('film-text')
                ]); ?>
                <?php echo form_error('film-runtime'); ?>
                <?php echo custom_form_input('Runtime', [
                    'name'          => 'film-runtime',
                    'class'         => 'form-control',
                    'type'          => 'number',
                    'placeholder'   => '180',
                    'value'         => set_value('film-runtime')
                ]); ?>

                <?php echo form_error('film-release'); ?>
                <?php echo custom_form_input('Release Data', [
                    'name'          => 'film-release',
                    'class'         => 'form-control',
                    'placeholder'   => 'DD/MM/YYYY',
                    'value'         => set_value('film-release')
                ]); ?>

                <?php echo form_error('film-image'); ?>
                <?php echo custom_form_upload('Choose Image', [
                    'type'          => 'file',
                    'name'          => 'film-image',
                    'accept'        => 'image/*'
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <?php echo form_multiselect(
                    'film-categories[]',
                    $categories,
                    set_value('film-categories'),
                    [
                        'class' => 'custom-select form-control',
                        'size'  => count($categories)
                    ]
                ); ?>

                <small class="d-block mt-1 mb-3"><?php echo ($platform == 'mac os x') ? 'Cmd' : 'Ctrl'; ?>-click to select multiple options.</small>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
