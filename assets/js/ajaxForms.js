$("#create_user_form").validate({
    rules: {
        confirmpassword: {
            equalTo: "#password"
        }
    },
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    }
});

$("#create_borrowers_form").validate({
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
});

$("#edit_borrowers_form").validate({
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
});
$("#create_loan_type_form").validate({
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
});
$("#edit_loan_type_form").validate({
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
});

$("#create_loan_form").validate({
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
});

function getLoanTypes(that){
    var type = $(that).val();

    if(type=='Custom'){
        $("#terms").css("pointer-events","auto");
        $("#interest").css("pointer-events","auto");
    }else{
        $.ajax({
            type: "POST",
            url: SITE_URL+"getLoanType",
            dataType: "json",
            data: {type:type},
            success: function(response) {
                console.log(response.msg);

                $('#terms').val(response.msg.terms);
                $('#interest').val(response.msg.interest);
                var principal = $('#principal').val();

                $("#terms").css("pointer-events","none");
                $("#interest").css("pointer-events","none");

                var date_started = new Date($('#date_started').val());

                $('#maturity_date').val(addMonths(date_started,response.msg.terms));
                if(principal==''){
                    principal = 0;
                }
                calculateLoan(response.msg.interest, principal, response.msg.terms);
            }
        });
    }
}
