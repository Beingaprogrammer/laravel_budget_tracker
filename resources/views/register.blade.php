@extends('layouts/app')
@section('content')

<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Register</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">    
                <form action="" id="registrationForm" method="POST">
                    @csrf
                    <h4 class="modal-title">Register Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                        <p class="error" id="error"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                        <p class="error" id="error"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Password" id="password" name="password">
                        <p class="error" id="error"></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="cpassword" name="cpassword">
                        <p class="error" id="error"></p>
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div> 
                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Register</button>
                </form>			
                <div class="text-center small">Already have an account? <a href="{{route('login')}}">Login Now</a></div>
            </div>
        </div>
    </section>
</main>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script type="text/javascript">

    $('#registrationForm').submit(function(e){
        e.preventDefault();
        $("button[type='submit']").prop('disabled',true);

        $.ajax({
          url:'{{route("storeregister")}}',
          type:"POST",
          data:$('#registrationForm').serialize(),
          cache: false,
          success: function(response){
            if (response["status"]  == true){
                $("button[type='submit']").prop('disabled',false);
                window.location.href='{{route("login")}}'
            } else{
                var errors  = response["errors"];
               
                $(".error").removeClass('invalid-feedback').html('');
                $("input[type='text'], select,input[type='number'] ").removeClass('is-invalid');

                $.each(errors, function(key,value){
                   $(`#${key}`).addClass('is-invalid')
                   .siblings('p')
                   .addClass('invalid-feedback')
                   .html(value);
                });
            }
          },error: function(){
            console.log('something went wrong');
          }
        });
    });

</script>

  
@endsection