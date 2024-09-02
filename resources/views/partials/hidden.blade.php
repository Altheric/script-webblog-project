@if(Session::get('user_id') == null)
<?php 
    header('Location: /'); 
    exit(); ?>
@endif