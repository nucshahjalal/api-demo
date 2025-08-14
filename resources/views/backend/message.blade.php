<?php
$message = '';
$document = 'success';

if (Session::get('success')):
    $message = Session::get('success');
    $document = 'success';
elseif (Session::get('error')):
    $message = Session::get('error');
    $document = 'error';
endif;
?>

@if($message)
<div class="row"> 
    <div class="col-md-12 col-xs-12 col-sm-12">
        <div id="message-div" class="alert alert-{{ $document }}" style="background-color: white; color: black;">
            {{ $message }}
            <span class="msg-remove"></span>
        </div>
    </div>
</div>
@endif

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
    $(document).ready(function (){
        $(function () {
            $('#message-div').delay(4000).fadeOut();
            $('.msg-remove').click(function () {
            $('#message-div').hide();
            });
        });
    });
</script>

<!--!  Data insert update delete sweet alert message  !-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'success',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'error',
            text: '{{ session('error') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif
