<?php echo form_open_multipart("cinema/edit/{$cinema['id']}/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('cinema-name'); ?>
                <?php echo custom_form_input('Name', [
                    'name'          => 'cinema-name',
                    'class'         => 'form-control',
                    'placeholder'   => 'Film Title',
                    'value'         => $cinema['name'] ?: set_value('cinema-name')
                ]); ?>
                <?php echo form_error('cinema-capacity'); ?>
                <?php echo custom_form_input('Capacity', [
                    'name'          => 'cinema-capacity',
                    'class'         => 'form-control',
                    'type'          => 'number',
                    'placeholder'   => '100',
                    'value'         => $cinema['capacity'] ?: set_value('cinema-capacity')
                ]); ?>
                <?php echo custom_form_input('Rows', [
                    'name'          => 'cinema-rows',
                    'class'         => 'form-control',
                    'type'          => 'number',
                    'placeholder'   => '10',
                    'value'         => $cinema['num_rows'] ?: set_value('cinema-rows')
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
