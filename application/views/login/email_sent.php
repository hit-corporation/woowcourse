<?php $this->layout('layouts::main_template', ['title' => 'Course']) ?>

<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <p class="fs-5 text-shadow">
                An email to <strong></strong> has been sent with instructions to activate your account. 
                The activation link is only valid for 1 hours. If you don't receive the instructions try checking your junk or spam filters. 
            </p>
            <div class="d-flex flex-nowrap mt-3 align-items-center">
                <button class="btn btn-sm btn-primary text-white fs-6" type="button">Homepage</button>
                <span class="fs-6 mx-2">Or</span>
                <a href="javascript:void(0)" class="fs-6">Resend activation mail</a>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>