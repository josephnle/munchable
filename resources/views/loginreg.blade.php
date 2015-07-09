@extends('layouts.master')

@section('content')
<html lang="">
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <style>
        p {
            text-transform: lowercase;
            font-size: 13pt;
            font-weight: 300;
        }
        h1 {
            font-weight: 800;
            text-transform: lowercase;
            font-size: 40pt;
        }
        body {
            text-align:center;
            background-image: url('../pics n stuff/burgerbackground.png'); 
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body >
    <h1>Sign Up</h1>
    <p>Get ready to start munching.</p>
    <form style="margin: 0 10%;" method="post"> 
        
<!-- First and Last Name --> 
<div style="width=75%;">
    <fieldset style="text-align: left;" class="form-group">   
        <p>
            <label for="first-name">First Name<span class="required"></span></label>
            <input type="text" id="first-name" name="first_name" class="form-control" required="required" aria-required="true"/>
        </p>
        <p>
            <label for="last-name">Last Name<span class="required"></span></label>
            <input type="text" id="last-name" name="last_name" class="form-control" required="required" aria-required="true"/>
        </p>

<!-- Email Address -->  
        <p>
            <label for="email">Email Address<span class="required"></span></label>
            <input type="text" id="email" name="email" class="form-control" required="required" aria-required="true"/>
        </p>

<!-- Password -->  
        <p class=>
            <label for="password">Password<span class="required"></span></label>
            <input type="password" id="password" name="password" class="form-control" required="required" aria-required="true"/>
        </p>
    </fieldset> 
</div>
    
<!-- Submit button -->
    <input type="submit" value="Submit" style="background-color: #f9423a; border: 0; border-radius: 10%;" class="btn btn-primary btn-lg"/>
    </form>
        
    <script src=""></script>  
</body>
</html>
@endsection