$(document).ready(function() {
    $('#user_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                    stringLength: {
                        min: 3,
                    },

                    notEmpty: {
                        message: 'Please enter your first name'
                    }
                }
            },
            last_name: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please enter your last name'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your email address'
                    },
                    emailAddress: {
                        message: 'Please enter a valid email address'
                    }
                }
            },
            psw: {
                validators: {
                    stringLength: {
                        min: 5,
                        max: 20,
                        message:'Please enter at least 5 characters'
                    },
                    notEmpty: {
                        message: 'Please create your password'
                    }
                }
            }
            ,
            psw: {
                validators: {
                    stringLength: {
                        min: 5,
                        max: 20,
                        message:'Please enter at least 5 characters'
                    },
                    notEmpty: {
                        message: 'Please confirm your password'
                    }
                }
            },

            dob: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your date of birth'
                    }
                }
            },



            mobile: {
                validators: {
                    stringLength: {
                        min: 11,
                        max: 11,
                    },
                    notEmpty: {
                        message: 'Please enter your mobile number'
                    }
                }
            },


            address: {
                validators: {
                    stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Please select location from map'
                    }
                }
            },
            sub_district: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your Sub-District\Thana'
                    }
                }
            },
            district: {
                validators: {
                    notEmpty: {
                        message: 'Please select your district'
                    }
                }
            },


            bloodgroup: {
                validators: {
                    notEmpty: {
                        message: 'Please select your blood group'
                    }
                }
            },

            doblood: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your date of birth'
                    }
                }
            },






        }
    })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow"); // Do something ...
            $('#user_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();


            // Get the form instance


            // Get the BootstrapValidator instance


            // Use Ajax to submit form data
            /*   $.post($form.attr('action'), $form.serialize(), function(result) {
             console.log(result);
             }, 'json');*/
        });
});