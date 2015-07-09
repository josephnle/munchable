@extends('layouts.master')

@section('content')
<html lang="">
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <style>
        p {
            font-size: 13pt;
            font-weight: 300;
        }
        h1 {
            font-family: 'Patua One', cursive;
            font-size: 40pt;
        }
        body {
            text-align:center;
            background-image: url('../pics n stuff/burgerbackground.png'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        label {
            font-family: 'Helvetica-Neue', sans-serif;
        }
        .form-group.required .control-label:after {
            content:"*";
            color:red;
        } 
        footer {
            font-family: 'Helvetica-Neue', sans-serif;
            font-weight: 200;
            margin-top: 3em;
        }
        a {
            font-weight: 400;
            color: #ff4e00; 
        }
        a:hover {
            text-decoration: none;
            font-weight: bold;
            color: #c33c00;
        }
    </style>
</head>
<body >
    <h1>Sign Up</h1>
    <p>Munch through the 6 with your woes.</p>
    <form style="margin: 0 20%;" method="post"> 
        
<!-- First and Last Name --> 
<div class= "form-group required" style="width=75%;">
    <fieldset style="text-align: left;" class="form-group">   
        <p>
            <label class="control-label" for="first-name">First Name<span class="required"></span></label>
            <input type="text" id="first-name" name="first_name" placeholder="Aubrey Drake" class="form-control" required="required" aria-required="true"/>
        </p>
        <p>
            <label class="control-label" for="last-name">Last Name<span class="required"></span></label>
            <input type="text" id="last-name" name="last_name" placeholder="Graham" class="form-control" required="required" aria-required="true"/>
        </p>

<!-- Email Address -->  
        <p>
            <label class="control-label" for="email">Email Address<span class="required"></span></label>
            <input type="text" id="email" name="email" placeholder="6god@gmail.com" class="form-control" required="required" aria-required="true"/>
        </p>

<!-- Password -->  
        <p class=>
            <label class="control-label" for="password">Password<span class="required"></span></label>
            <input type="password" id="password" name="password" placeholder="Password" class="form-control" required="required" aria-required="true"/>
        </p>
    </fieldset> 
</div>
    
<!-- Submit button -->
    <input type="submit" value="Submit" style="background-color: #f9423a; border: 0; border-radius: 10%;" class="btn btn-primary btn-lg"/>
    </form>

    <footer>Already a member? <a href="/">Login here.</a></footer>
    <script src=""></script>  
</body>
</html>
@endsection