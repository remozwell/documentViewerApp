<?php 


if($_SERVER["REQUEST_METHOD"] != "POST") {
    unset($_SESSION['success']);
    unset($_SESSION['error']);
}

if(isset($error)) : ?>
    
<div class="container row alert-cont">
    <div class="col s12">
        <div class="col s12 white-text red2 z-depth-3">
            <div class="">
                <h4 class="alert-msg"><?php echo $error; ?></h4>
            </div>
        </div>
    </div>
</div>

<?php elseif(isset($success)) : ?>
    
<div class="container row alert-cont">
    <div class="col s12">
        <div class="col s12 white-text green2 z-depth-3">
            <div class="">
                <h4 class="alert-msg"><?php echo $success; ?></h4>
            </div>
        </div>
    </div>
</div>


<?php endif ?>