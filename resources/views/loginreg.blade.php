@extends('layouts.master')

@section('content')
<html lang="">
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign up</h1>
    <form method="post"> <!-- *****action="http://htmlcssvqs.com/8ed/examples/chapter-16/show-data.php" enctype="multipart/form-data"-->

<!-- First and Last Name --> 
    <fieldset>   
        <p class="row">
            <label for="first-name">First Name<span class="required"></span></label>
            <input type="text" id="first-name" name="first_name" class="field-large" required="required" aria-required="true"/>
        </p>
        <p class="row">
            <label for="last-name">Last Name<span class="required"></span></label>
            <input type="text" id="last-name" name="last_name" class="field-large" required="required" aria-required="true"/>
        </p>
    </fieldset> 

<!-- Email Address -->
    <fieldset>   
        <p class="row">
            <label for="email">Email Address<span class="required"></span></label>
            <input type="text" id="email" name="email" class="field-large" required="required" aria-required="true"/>
        </p>
    </fieldset>

<!-- Password --> 
    <fieldset>   
        <p class="row">
            <label for="password">Password<span class="required"></span></label>
            <input type="password" id="password" name="password" class="field-large" required="required" aria-required="true"/>
        </p>
    </fieldset> 
        
<!-- Submit button -->
    <input type="submit" value="Submit" class="btn"/>
    </form>
        
    <script src=""></script>  
</body>
</html>
@endsection