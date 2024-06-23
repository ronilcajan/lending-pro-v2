var $window = $(window);
$window.on("load",function (){
    $(".preloader").fadeOut(500);
});

$(document).ready(function(){
    setTimeout(function(){ $('.alert').fadeOut('slow'); }, 3000);

    // Initialize webcam
    Webcam.set({
        height: 250,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    $('#open_cam').click(function(){
        Webcam.attach( '#my_camera' );
    });
    $('#open_cam1').click(function(){
        Webcam.attach( '#my_camera1' );
    });

    $('.borrowers').select2({
        theme: "bootstrap",
        dropdownParent: $('#addLoan')
    });

    $('#date_started').change(function(){
        var date_started = new Date($(this).val());
        var terms = $('#terms').val();

        $('#maturity_date').val(addMonths(date_started,terms));
    });

    $('#terms').change(function(){
        var terms = $(this).val();
        var date_started = new Date($('#date_started').val());

        $('#maturity_date').val(addMonths(date_started,terms));

        if($('#interest').val() != ''){
            var interest = $('#interest').val();
            var principal = $('#principal').val();
            calculateLoan(interest, principal, terms);
        }
    });

    $('#interest').change(function(){
        var interest = $(this).val();
        var principal = $('#principal').val();
        var terms = $('#terms').val();

        calculateLoan(interest, principal, terms);
    });

    $('#principal').change(function(){
        var interest = $('#interest').val();
        var principal = $(this).val();
        var terms = $('#terms').val();

        if($('#interest').val() != ''){
            calculateLoan(interest, principal, terms);
        }
    });
});

function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

function calculateLoan(interest, principal, terms){
    var total_interest = parseFloat(principal * (interest/100)) * terms;
    var monthly = (parseFloat(principal) + parseFloat(total_interest))  / terms ;
    var total_amount = monthly * terms;

    $('#monthly').val(monthly.toFixed(2));
    $('#total_amount').val(total_amount.toFixed(2));

    console.log(total_interest);
    console.log(monthly);
    console.log(total_amount);
}

function addMonths(date,terms){
    var date = new Date(date);
    var maturity_date = moment(date);
    maturity_date.add(terms, 'months');
    return maturity_date.toISOString().substr(0,10);
}
function save_photo() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById('profileImage').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage" value="'+data_uri+'"/>';
    } );
}
function save_photo1() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera1').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById('profileImage1').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage" value="'+data_uri+'"/>';
    } );
}

function editBorrowers(that){
    id = $(that).attr('data-id');
    bname = $(that).attr('data-name');
    gender = $(that).attr('data-gender');
    bdate = $(that).attr('data-bdate');
    num = $(that).attr('data-num');
    occu = $(that).attr('data-occu');
    em_address = $(that).attr('data-em_address');
    spouse = $(that).attr('data-spouse');
    spouse_occ = $(that).attr('data-spouse_occ');
    spouse_em_add = $(that).attr('data-spouse_em_add');
    address = $(that).attr('data-address');
    avatar = $(that).attr('data-avatar');

    $('#borrowers_id').val(id);
    $('#name').val(bname);
    $('#gender').val(gender);
    $('#birthdate').val(bdate);
    $('#number').val(num);
    $('#occupation').val(occu);
    $('#em_address').val(em_address);
    $('#spouse').val(spouse);
    $('#spouse_occu').val(spouse_occ);
    $('#spouse_em_address').val(spouse_em_add);
    $('#address').val(address);

    var str = avatar;
    var n = str.includes("data:image");
    if(!n){
        avatar = 'assets/uploads/borrowers/'+avatar;
    }
    if(str==''){
        avatar = 'assets/img/person.png';
    }
    $('#avatar').attr('src', avatar);
    
}
function editLoantype(that){
    id = $(that).attr('data-id');
    typename = $(that).attr('data-typename');
    interest = $(that).attr('data-interest');
    terms = $(that).attr('data-terms');

    $('#loan_type_name').val(typename);
    $('#loan_type_int').val(interest);
    $('#loan_type_terms').val(terms);
    $('#loan_type_id').val(id);
}
function create_loan(that){

    $('#create_loan_form').attr('action', SITE_URL+"create_loan");
    $('#modalHead').text('Create Loan');

}
function editLoan(that){

    $('#create_loan_form').attr('action', SITE_URL+"update_loan");
    $('#modalHead').text('Update Loan');

    id = $(that).attr('data-id');
    bid = $(that).attr('data-bid');
    cmaker = $(that).attr('data-cmaker');
    cmaker1 = $(that).attr('data-cmaker1');
    type = $(that).attr('data-ltype');
    amount = $(that).attr('data-amount');
    terms = $(that).attr('data-terms');
    inter = $(that).attr('data-inter');
    penal = $(that).attr('data-penal');
    dstart = $(that).attr('data-dstart');
    mdate = $(that).attr('data-mdate');
    monthly = $(that).attr('data-monthly');
    total = $(that).attr('data-total');
    notes = $(that).attr('data-notes');

    $('#loan_id').val(id);
    $('.borrowers').val(bid).trigger('change');
    $('#cmaker').val(cmaker);
    $('#cmaker1').val(cmaker1);
    $('#loan_type').val(type);
    $('#principal').val(parseInt(amount));
    $('#terms').val(terms).trigger('change');
    $('#interest').val(inter);
    $('#penalty').val(penal);
    $('#date_started').val(dstart);
    $('#maturity_date').val(mdate);
    $('#monthly').val(monthly);
    $('#total_amount').val(total);
    $('#notes').val(notes);

}
function viewloan_type(that){
    lname = $(that).attr('data-name');
    interest = $(that).attr('data-interest');
    terms = $(that).attr('data-terms');
    penal = $(that).attr('data-penalty');

    $('#tname').val(lname);
    $('#tinterest').val(interest+' %');
    $('#tterms').val(terms+' Months');
    $('#tpenalty').val(penal+' %');
    
}

function payLoan(that){
    id = $(that).attr('data-id');
    amount = $(that).attr('data-amount');
    terms = $(that).attr('data-terms');
    skip = $(that).attr('data-skip');
    min = $(that).attr('data-payment');

    if(skip=='hide'){
        $('#skip').hide();
        $('#amount').css('pointer-events','none')
    }else{
        $('#skip').show();
    }
    $('#amount').prop('min', min);
    $('#p_terms').val(terms);
    $('#pment_id').val(id);
    $('#amount').val(amount);
}

function calculateTotal(that){
    var terms = $(that).val();
    var monthly = removeCommas($('#monthlyp').val());
    var penal = $('#penal').val();

    if(penal != ''){
        total = monthly * terms + parseFloat(penal);
    }else{
        total = monthly * terms;
    }

    $('#total_payment').val(numberWithCommas(total.toFixed(2)));
}

function calculateP(){
    var terms = $('#payment_no').val();
    var monthly = parseFloat(removeCommas($('#monthlyp').val()));

    var amount = $('#princ').val();
    var penalty = $('#penalval').val();
    var totalP = amount * (penalty/100);
    var totalAmount = (monthly * terms) + totalP;

    $('#penal').val(totalP);
    $('#total_payment').val(numberWithCommas(totalAmount.toFixed(2)));
}

function addPenalty(that){
    var penalty = parseFloat($(that).val());
    var terms = $('#payment_no').val();
    var monthly = removeCommas($('#monthlyp').val());
    
    total = monthly * terms + penalty;

    $('#total_payment').val(numberWithCommas(total.toFixed(2)));
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function removeCommas(str) {
    while (str.search(",") >= 0) {
        str = (str + "").replace(',', '');
    }
    return str;
};