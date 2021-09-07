// Js for admin site form validations
jQuery("#admin-site-form").validate({
    rules: {
        user_email : "required",
        field_name : "required",
        field_description : "required",
        field_category : "required",
        field_file : {
            required: true,
            extension: "jpg|jpeg|png"
        },
        update_field_file : {
            extension: "jpg|jpeg|png"
        },
        user_password : {
            required: true,
            minlength: 6,
            maxlength: 15
        },
        user_password_cnfrm : {
            required: true,
            equalTo: "#user_password"
        },
        user_name : {
            required: true
        },
        field_textarea : {
            required: true
        }
    },
    messages:{
        user_name: {
            required: "Please Enter username."
        },
        user_email: {
            required: "Please Enter Email.",
            email: "Please Enter valid Email."
        },
        user_password: {
            required: "Please Enter your password.",
            minlength: "Password length must be between 6 to 15.",
            maxlength: "Password length must be between 6 to 15."
        },
        user_password_cnfrm: {
            required: "Please Enter your confirm password.",
            equalTo: "Confirm password must be equals to password."
        },
        field_name: {
            required:"This is a required field."
        },
        field_description: {
            required:"This is a required field."
        },
        field_file: {
            required:"This is a required field.",
            extension:"This file type is not permitted."
        },
        update_field_file: {
            extension:"This file type is not permitted."
        }

    }
});


//  Sidebar js
let menuButton = document.querySelector(".button-menu");
let container = document.querySelector(".sidebar-container");
let pageContent = document.querySelector(".page-content");
let responsiveBreakpoint = 991;

if (window.innerWidth <= responsiveBreakpoint) {
    container.classList.add("nav-closed");
}

menuButton.addEventListener("click", function () {
    container.classList.toggle("nav-closed");
});

window.addEventListener("resize", function () {
    if (window.innerWidth > responsiveBreakpoint) {
        container.classList.remove("nav-closed");
    }
});


jQuery(document).ready(function() {
    // Jquery Initialize data tables
    jQuery('#admin-data-table').DataTable( {
        "pageLength": 2,
        dom: 'lBfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

    // Jquery initialize fancybox
    jQuery('a#img-popup').fancybox();


    // Jquery toggle checkbox
    jQuery(function() {
        jQuery('#toggle-status').bootstrapToggle({
            on: 'Enabled',
            off: 'Disabled'
        });
    });
});

// jquery update status of specific record
    jQuery('body').on('change','.change-status',function(){
        var id = jQuery(this).data('id');
        var status = jQuery(this).attr('status');
        var tbl_name = jQuery(this).attr('tbl_name');

        jQuery.ajax({
            type:"post",
            url:"./admin_ajax.php",
            data:"id=" + id + "&status=" + status + "&operation=toggle&tbl_name=" + tbl_name,
            success: function (data) {

            }
        });
        if (status == 1)
        {
            var newstatus = 0;
        } else
        {
            newstatus = 1;
        }
        jQuery(this).attr("status",newstatus);

    });

// Jquery delete record
jQuery('body').on('click','#delete-data-link',function(e) {
    e.preventDefault();
    var id = jQuery(this).data('id');
    var tbl_name = jQuery(this).attr('tbl_name');
    var data_image = jQuery(this).data('image');

    var url = "./admin_ajax.php?id=" + id + "&tbl_name=" + tbl_name + "&operation=delete_data&data_img=" + data_image;
    if(confirm("Are you sure?")) {
        window.location.replace(url);
    }
});

// Jquery signature pad help and support page
$(document).ready(function() {
    jQuery(".clear_canvas").click(function () {
        clear_canvas();
    });
    jQuery("#canvas-text").keyup(function () {
        draw_canvas(jQuery(this).val());
    });
    function draw_canvas(value) {
        var canvas = document.getElementById("sign-pad");
        var ctx = canvas.getContext("2d");
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.font = "italic 28px cursive";
        ctx.textAlign = "center";
        ctx.strokeText(value, 135, 60);
    }
    function clear_canvas() {
        jQuery("#canvas-text").val('');
        var canvas = document.getElementById("sign-pad");
        const context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);
    }
    jQuery("#help_sbmt").click(function (event) {
        event.preventDefault();
        html2canvas([document.getElementById('sign-pad')], {
            onrendered: function (canvas) {
                var canvas_img_data = canvas.toDataURL('image/png');
                document.getElementById('canvas_url').value = canvas_img_data;
                jQuery("#admin-site-form").submit();
            }
        });
    });

});





