<?php echo form_open_multipart('screening/create/submit', ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('screening-film'); ?>
                <?php echo form_dropdown(
                'screening-film',
                $film,
                set_value('screening-film'),
                [
                    'class' => 'custom-select form-control my-3',
                    'size'  => count($film)
                ]);
                ?>
                <?php echo form_error('screening-cinema'); ?>
                <?php echo form_dropdown('screening-cinema',
                $cinema,
                set_value('screening-cinema'),
                [
                    'class' => 'custom-select form-control my-3',
                    'size'  => count($cinema)
                ]);
                ?>
            <?php echo form_error('screening-date'); ?>
            <?php echo custom_form_input('Screening Date', [
                'name'          => 'screening-date',
                'class'         => 'form-control my-3',
                'placeholder'   => 'DD/MM/YYYY',
                'value'         => set_value('screening-date')
            ]); ?>
                <?php echo form_error('screening-time'); ?>
                <?php echo form_dropdown('screening-time',
                $time,
                set_value('screening-time'),
                [
                    'class' => 'custom-select form-control my-3',
                    'size'  => count($time)
                ]);
                ?>

            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
