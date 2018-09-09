

<br>


<footer id="myFooter">

    <div>Copyright © 2017</div>

</footer>






<script src="js/modernizr.js" type="text/javascript"></script>
<script src="js/js_function.js"></script>
<script src="Bootstrap/js/bootstrapvalidator.min.js"></script>
<script src="Bootstrap/layout/scripts/jquery.backtotop.js"></script>
<script src="Bootstrap/layout/scripts/jquery.mobilemenu.js"></script>
<script src="js/index.js"></script>



<script type="text/javascript">

    $( "#login_form" ).on( "submit", function( event ) {
        event.preventDefault();


        document.getElementById('login_error').innerHTML  = "";

            var data = $("#login_form").serializeArray();
            data.push({name: 'login', value:true});

            console.log(data);


            $.ajax({
                type: "POST",
                url: "action.php",
                data: data,
                dataType: "json",
                success: function(data) {

                    if(data=="true"){
                        window.location='index.php';
                    }
                    if(data=="fail"){
                        document.getElementById('login_error').innerHTML  = "username or password mismatched";
                    }



                }
            });





    });


</script>


</body>
</html>
