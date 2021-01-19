function selectAll(obj) {
    var screen = $(obj).data('screen');
    var checkbox = '.check-' + screen;
    if (obj.checked) {
        // Iterate each checkbox
        $(checkbox).each(function () {
            this.checked = true;
        });
    } else {
        $(checkbox).each(function () {
            this.checked = false;
        });
    }
}

function selectPermission(obj) {
    var countChecked = 0;
    var class_name = $(obj).attr('class');
    var screen = $(obj).data('screen');
    var checkboxAll = '.select-' + screen;
    var checkbox = $('.' + class_name);
    $(checkbox).each(function () {
        if (this.checked) {
            countChecked++;
        }
    });
    if (countChecked === checkbox.length) {
        $(checkboxAll).prop('checked', true);
    } else {
        $(checkboxAll).prop('checked', false);
    }
}

function addProduct(obj) {
    var html = $('#list-product').html();
    var add = $('#content-js').append(html);
    var totalElm = $(obj).closest('.row').find('.info-totalcart');
    totalElm.css('display', 'block');
}

function selectService(obj) {
    var select = document.getElementById('choose_service');
    var opt = select.options[select.selectedIndex];
    console.log(opt);
    var domain = document.getElementById('content-domain');
    var choose = document.getElementById('content-choose');
    var hosting = document.getElementById('content-hosting');
    var vps = document.getElementById('content-vps');
    var email = document.getElementById('content-email');
    var ssl = document.getElementById('content-ssl');
    var website = document.getElementById('content-website');
    var valueoption = opt.text
    switch(valueoption) {
        case 'Choose Service':
            domain.style.display = 'none';
            hosting.style.display = 'none';
            vps.style.display = 'none';
            email.style.display = 'none';
            ssl.style.display = 'none';
            website.style.display = 'none';
            break;
        case 'Domain':
            domain.style.display = 'block';
            hosting.style.display = 'none';
            vps.style.display = 'none';
            email.style.display = 'none';
            ssl.style.display = 'none';
            website.style.display = 'none';
            break;
        case 'Hosting':
            hosting.style.display = 'block';
            domain.style.display = 'none';
            vps.style.display = 'none';
            email.style.display = 'none';
            ssl.style.display = 'none';
            website.style.display = 'none';
            break;
        case 'Vps':
            vps.style.display = 'block';
            domain.style.display = 'none';
            hosting.style.display = 'none';
            email.style.display = 'none';
            ssl.style.display = 'none';
            website.style.display = 'none';
            break;
        case 'Email':
            email.style.display = 'block';
            hosting.style.display = 'none';
            domain.style.display = 'none';
            vps.style.display = 'none';
            ssl.style.display = 'none';
            website.style.display = 'none';
            break;
        case 'SSL':
            ssl.style.display = 'block';
            hosting.style.display = 'none';
            domain.style.display = 'none';
            vps.style.display = 'none';
            email.style.display = 'none';
            website.style.display = 'none';
            break;
        case 'Website':
            website.style.display = 'block';
            hosting.style.display = 'none';
            domain.style.display = 'none';
            vps.style.display = 'none';
            email.style.display = 'none';
            ssl.style.display = 'none';
            break;
        default:
        // code block
    }
}
function selectDomain(obj) {


    var data_fee_register = $(obj).find(':selected').data('fee-register');
    var data_fee_remain = $(obj).find(':selected').data('fee-remain');
    var data_fee_tranformation = $(obj).find(':selected').data('fee-tranformation');
    var data_notes = $(obj).find(':selected').data('notes');

    var fee_register = document.getElementById('fee-register');
    var fee_remain = document.getElementById('fee-remain');
    var fee_tranformation = document.getElementById('fee-tranformation');
    var notes = document.getElementById('notes_domain');

    fee_register.value = data_fee_register ;
    fee_remain.value = data_fee_remain ;
    fee_tranformation.value = data_fee_tranformation ;
    notes.value = data_notes;
    // var fee_register_select = document.getElementById('fee_register_select');
    // var fee_register = document.getElementById('fee_register');
}
function selectHosting(obj) {


    var data_price = $(obj).find(':selected').data('price');
    var data_capacity = $(obj).find(':selected').data('capacity');
    var data_bandwith = $(obj).find(':selected').data('bandwith');
    var data_sub_domain = $(obj).find(':selected').data('sub-domain');
    var data_email = $(obj).find(':selected').data('email');
    var data_ftp = $(obj).find(':selected').data('ftp');
    var data_database = $(obj).find(':selected').data('database');
    var data_adddon_domain = $(obj).find(':selected').data('adddon-domain');
    var data_park_domain = $(obj).find(':selected').data('park-domain');
    var data_notes = $(obj).find(':selected').data('notes');
    // console.log(data_notes);

    var price = document.getElementById('price');
    var capacity = document.getElementById('capacity');
    var bandwith = document.getElementById('bandwith');
    var sub_domain = document.getElementById('sub_domain');
    var email = document.getElementById('email');
    var ftp = document.getElementById('ftp');
    var database = document.getElementById('database');
    var adddon_domain = document.getElementById('adddon_domain');
    var park_domain = document.getElementById('park_domain');
    var notes = document.getElementById('notes_hosting');

    price.value = data_price ;
    capacity.value = data_capacity ;
    bandwith.value = data_bandwith ;
    sub_domain.value = data_sub_domain ;
    email.value = data_email ;
    ftp.value = data_ftp ;
    database.value = data_database ;
    adddon_domain.value = data_adddon_domain ;
    park_domain.value = data_park_domain ;
    notes.value = data_notes;

}
function selectVPS(obj) {


    var data_price = $(obj).find(':selected').data('price');
    var data_cpu = $(obj).find(':selected').data('cpu');
    var data_capacity = $(obj).find(':selected').data('capacity');
    var data_ram = $(obj).find(':selected').data('ram');
    var data_bandwith = $(obj).find(':selected').data('bandwith');
    var data_technical = $(obj).find(':selected').data('technical');
    var data_operating_system = $(obj).find(':selected').data('operating-system');
    var data_backup = $(obj).find(':selected').data('backup');
    var data_panel = $(obj).find(':selected').data('panel');
    var data_notes = $(obj).find(':selected').data('notes');
    // console.log(data_notes);

    var price = document.getElementById('price_hosting');
    var cpu = document.getElementById('cpu');
    var capacity = document.getElementById('capacity_hosting');
    var ram = document.getElementById('ram');
    var bandwith = document.getElementById('bandwith_hosting');
    var technical = document.getElementById('technical');
    var operating_system = document.getElementById('operating_system');
    var backup = document.getElementById('backup');
    var panel = document.getElementById('panel');
    var notes = document.getElementById('notes_vps');

    price.value = data_price ;
    cpu.value = data_cpu ;
    capacity.value = data_capacity ;
    ram.value = data_ram ;
    bandwith.value = data_bandwith ;
    technical.value = data_technical ;
    operating_system.value = data_operating_system ;
    backup.value = data_backup ;
    panel.value = data_panel ;
    notes.value = data_notes;
    console.log(price);
}
function selectEmail(obj) {


    var data_price = $(obj).find(':selected').data('price');
    var data_capacity = $(obj).find(':selected').data('capacity');
    var data_email_number = $(obj).find(':selected').data('email-number');
    var data_email_forwarder = $(obj).find(':selected').data('email-forwarder');
    var data_email_list = $(obj).find(':selected').data('email-list');
    var data_parked_domains = $(obj).find(':selected').data('parked-domains');
    var data_notes = $(obj).find(':selected').data('notes');
    // console.log(data_notes);

    var price = document.getElementById('price_email');
    var capacity_email = document.getElementById('capacity_email');
    var email_number = document.getElementById('email_number');
    var email_forwarder = document.getElementById('email_forwarder');
    var email_list = document.getElementById('email_list');
    var parked_domains_email = document.getElementById('parked_domains_email');
    var notes = document.getElementById('notes_email');

    price.value = data_price ;
    capacity_email.value = data_capacity ;
    email_number.value = data_email_number ;
    email_forwarder.value = data_email_forwarder ;
    email_list.value = data_email_list ;
    parked_domains_email.value = data_parked_domains ;
    notes.value = data_notes;
    console.log(price);
}
function selectSSL(obj) {


    var data_price = $(obj).find(':selected').data('price');
    var data_insurance_policy = $(obj).find(':selected').data('insurance-policy');
    var data_domain_number = $(obj).find(':selected').data('domain-number');
    var data_reliability = $(obj).find(':selected').data('reliability');
    var data_green_bar = $(obj).find(':selected').data('green-bar');
    var data_sans = $(obj).find(':selected').data('sans');
    var data_notes = $(obj).find(':selected').data('notes');
    // console.log(data_notes);

    var price = document.getElementById('price_ssl');
    var insurance_policy = document.getElementById('insurance_policy');
    var domain_number = document.getElementById('domain_number');
    var reliability = document.getElementById('reliability');
    var green_bar = document.getElementById('green_bar');
    var sans = document.getElementById('sans');
    var notes = document.getElementById('notes_ssl');

    price.value = data_price ;
    insurance_policy.value = data_insurance_policy ;
    domain_number.value = data_domain_number ;
    reliability.value = data_reliability ;
    green_bar.value = data_green_bar ;
    sans.value = data_sans ;
    notes.value = data_notes;
    console.log(price);
}
function selectWebsite(obj) {


    var data_price = $(obj).find(':selected').data('price');
    var data_type_website = $(obj).find(':selected').data('type-website');
    var data_notes = $(obj).find(':selected').data('notes');
    // console.log(data_notes);

    var price = document.getElementById('price_website');
    var type_website = document.getElementById('type_website');
    var notes = document.getElementById('notes_website');

    price.value = data_price ;
    type_website.value = data_type_website ;
    notes.value = data_notes;
    console.log(price);
}


function selectProduct(obj) {
    var cost = $(obj).find(':selected').data('cost');
    var qtyElm = $(obj).closest('.row').find('.qty');
    var qty = $(qtyElm).val();
    var costElm = $(obj).closest('.row').find('.cost');
    costElm.val(cost * qty);
    calculatorTotal();
}

function removeProduct(obj) {
    var removeElm = $(obj).parents('.product-info');
    removeElm.remove();
    var numberELm = $('.product-info');
    if (numberELm.length === 1) {
        $('.info-totalcart').css('display', 'none');
    }
    calculatorTotal();
}

function changeCustomer(obj) {
    var elm = document.getElementById('content-js');
    elm.innerHTML = '';
    $('.info-totalcart').css('display', 'none');
    $('.amount').text(0);
    $('.vat-amount').text(0);
    $('.total').text(0);
}

// function changeService(obj) {
//     var selectService = $('#choose_service');
//
//     if(selectService.val() === 0)
//     {
//         $('.content-service').css('display', 'block');
//     }
// }

function changeQty(obj) {

    var qty = $(obj).val();
    var selectProElm = $(obj).closest('.row').find('.select-product');
    var price = selectProElm.find(':selected').data('cost');
    var costNew = (typeof price !== 'undefined')  ? price * qty : 0;
    var costElm = $(obj).closest('.row').find('.cost');
    costElm.val(costNew);
    calculatorTotal();
}

function calculatorTotal() {
    var amount = 0;
    $('.cost').each(function () {
        amount += Number($(this).val());
    });
    var vat = amount * 0.1;
    var total = vat + amount;
    $('.amount').text(amount);
    $('.vat-amount').text(vat);
    $('.total').text(total);
}
$('document').ready(function(){
    $('.dateTimeBirthday').datepicker({
        //datepicker thu vien de su dung
    dateFormat:"dd-mm-yy"
    });
});
$('document').ready(function(){
    $('.picker1').datetimepicker({
        //datepicker thu vien de su dung
        format:'d-m-Y H:i',
        onShow: function (ct) {
            this.setOptions({
                maxDate: $('.picker2').val() ? $('.picker2').val() : false
            })

        }
    });
});
$('document').ready(function(){
    $('.picker2').datetimepicker({
        //datepicker thu vien de su dung
        format:'d-m-Y H:i',
        onShow: function (ct) {
            this.setOptions({
                minDate: $('.picker1').val() ? $('.picker1').val() : false
            })

        }
    });
});


