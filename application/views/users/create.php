<?php echo form_open_multipart('users/create/submit', ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('user-email'); ?>
                <?php echo custom_form_input('Email', [
                    'name'          => 'user-email',
                    'class'         => 'form-control',
                    'placeholder'   => 'me@example.com',
                    'type'          => 'email',
                    'value'         => set_value('user-email')
                ]); ?>

                <?php echo form_error('user-password'); ?>
                <?php echo custom_form_input('Password', [
                    'name'          => 'user-password',
                    'class'         => 'form-control',
                    'placeholder'   => 'password',
                    'type'          => 'password'
                ]); ?>

                <?php echo form_error('user-conf-password'); ?>
                <?php echo custom_form_input('Confirm Password', [
                    'name'          => 'user-conf-password',
                    'class'         => 'form-control',
                    'placeholder'   => 'confirm password',
                    'type'          => 'password'
                ]); ?>

                <h5 class="mb-3 mt-4">Personal Details</h5>
                <?php echo form_error('user-name'); ?>
                <?php echo custom_form_input('Name', [
                    'name'          => 'user-name',
                    'class'         => 'form-control',
                    'placeholder'   => 'John',
                    'value'         => set_value('user-name')
                ]); ?>

                <?php echo form_error('user-surname'); ?>
                <?php echo custom_form_input('Surname', [
                    'name'          => 'user-surname',
                    'class'         => 'form-control',
                    'placeholder'   => 'Borg',
                    'value'         => set_value('user-surname')
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <?php echo form_multiselect(
                    'user-role',
                    $roles,
                    set_value('user-role'),
                    [
                        'class' => 'custom-select form-control',
                        'size'  => count($roles)
                    ]
                ); ?>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
