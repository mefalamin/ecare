var form=true;

function checkpassmatch(){
    var password = $("#txt_passwd").val();
    var confirmPassword = $("#txt_confirm_passwd").val();

    if (password != confirmPassword) {
        $("#divCheckPasswordMatch").html("Not matched!");

    }
    else

        $("#divCheckPasswordMatch").html("Password matched.");
}

function getAge()
{
    var today = new Date();
    var birthDate = new Date($("#dobfield").val());
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
    {
        age--;
    }
    if(age<18) {
        $("#divCheckAge").html("Age needs to be 18");
        $("#dobfield").val('');
    }
    else
        $("#divCheckAge").html("");

}

$(document).ready(function () {
    $("#radio_yes").click(function() {
        $('#dob_on').show('slow');
        $('#location').show('slow');
        $('#dblood_on').show('slow');
        $('#district_on').show('slow');
        $('#sub_district_on').show('slow');
        $('#last_donated_on').show('slow');
        $('#bg_on').show('slow');



    });

    $("#radio_no").click(function () {
        // body...
        $('#dob_on').hide('slow');
        $('#location').hide('slow');
        $('#dblood_on').hide('slow');
        $('#district_on').hide('slow');
        $('#sub_district_on').hide('slow');


        $('#last_donated_on').hide('slow');
        $('#bg_on').hide('slow');


    })



});




function fetch_select(val)
{
    $.ajax({
        type: 'post',
        url: 'action.php',
        data: {
            get_option:val
        },
        success: function (response) {
            document.getElementById("sub_combo").innerHTML=response;
        }
    });
}

function validatenumber() {

    var val = $('#mobile').val();
    if (/^\d{11}$/.test(val)) {
        // value is ok, use it
        $('#divChecknumber').html("");
    } else {
        $('#divChecknumber').html("Invalid number; must be 11 digits");

    }

}

/*
$( "#user_form" ).on( "submit", function( event ) {
    event.preventDefault();

        var form=false;

        var data = $("#user_form").serializeArray();
        var fname=document.getElementById('first_name').val;
        console.log(fname);


        console.log(data);


     $.ajax({
            type: "POST",
            url: "action.php",
            data: data,
            dataType: "json",
            success: function(data) {
                document.getElementById('serial').innerHTML  = data.serial;
                $('#success_modal').modal('show');
                console.log(data.affected,data.serial);


            }
        });






});

*/

    function submit(){

        $('#user_form').preventDefault();



    }

