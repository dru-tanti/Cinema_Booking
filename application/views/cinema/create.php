<?php echo form_open_multipart('cinema/create/submit', ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('cinema-name'); ?>
                <?php echo custom_form_input('Name', [
                    'name'          => 'cinema-name',
                    'class'         => 'form-control',
                    'placeholder'   => 'Film Title',
                    'value'         => set_value('cinema-name')
                ]); ?>
                <?php echo form_error('cinema-capacity'); ?>
                <?php echo custom_form_input('Capacity', [
                    'name'          => 'cinema-capacity',
                    'class'         => 'form-control',
                    'type'          => 'number',
                    'placeholder'   => '100',
                    'value'         => set_value('cinema-capacity')
                ]); ?>
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
