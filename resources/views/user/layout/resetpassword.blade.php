<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form action="" method="post">
                @if(session('success'))
                <div class="alert alert-success text-center">
                    {{session('success')}}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{session('error')}}
                </div>
                @endif
                @csrf
                <h1 style="text-align: center;">Reset Password</h1>
                <input type="hidden" name="tokenpassword" value="{{ $token }}">
                <div class="container">
                    <label for="psw"><b>New Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password">
                    @error('password')<small class="alert-danger">{{ $message }}</small>@enderror <br>

                    <label for="psw"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Confirm Password" name="reset_password" >
                    @error('reset_password')<small class="alert-danger">{{ $message }}</small>@enderror <br>

                    <button type="submit">Reset Password</button>
                </div>
                <div class="container" style="background-color:#f1f1f1">
                    <a href="{{url ('/')}}"> <button type="button" class="cancelbtn">Exit</button></a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Bordered form */

form {
    border: 3px solid #f1f1f1;
    position: relative;
    margin-left: 400px;
    margin-top: 50px;
}

/* Full-width inputs */
input[type=text],
input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
    opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}
.registerbtn {
    width: auto;
    padding: 10px 18px;
    background-color: rgb(50, 50, 241);
}

/* Center the avatar image inside this container */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
    width: 40%;
    border-radius: 50%;
}

/* Add padding to containers */
.container {
    padding: 16px;
}

/* The "Forgot password" text */
span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }

    .cancelbtn {
        width: 100%;
    }
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
