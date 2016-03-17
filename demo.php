<!doctype html>
<html>
<head>

    <title>How to get <a> href value using jQuery</title>
    
    <style>
        body{
            text-align: center;
            font-family: arial;
            font-size: 21px;
        }
   
        .button{
            margin:20px;
            font-size:16px;
            font-weight: bold;
            padding:5px 10px;
        }
        
    </style>


</head>
<body>
    <a class="sourcelink" href="#13">text_I_want_to_get_from_here</a><br />


<div id="13"><input id="destination" type="text" size="40" value=""></div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script>

        //When DOM loaded we attach click event to button
        $(document).ready(function() {
$('.sourcelink').click(function() {
   $('#destination').val($(this).html());
});
});

    </script>

</body>
</html>