


function selectNamessl(obj) {
    var data_price_ssl = $(obj).find(':selected').data('price_ssl');
    var price_ssl = document.getElementById('price_ssl');
    price_ssl.value = data_price_ssl;
    var quantity = $('#quantity_ssl').val();
    let total_ssl = data_price_ssl * parseInt(quantity);
    $('#total_ssl').val(total_ssl);
    $('#total_ssl').text(total_ssl);
    calculatorTotal();
    $('#quantity_ssl').keyup(function () {
        var quantity = $('input[data-id="quantity_ssl"]').val();
        total_ssl.value = data_price_ssl * parseInt(quantity);
        calculatorTotal();
    });
    var data_id_ssl = $(obj).find(':selected').data('id_ssl');
    var id_ssl = document.getElementById('id_ssl');
    id_ssl.value = data_id_ssl;
}

function selectNamedomain(obj) {
    var data_price_domain = $(obj).find(':selected').data('price_domain');
    var price_domain = document.getElementById('price_domain');
    price_domain.value = data_price_domain;
    var quantity = $('#quantity_domain').val();
    let total_domain = data_price_domain * parseInt(quantity);
    $('#total_domain').val(total_domain);
    $('#total_domain').text(total_domain);
    calculatorTotal();
    $('#quantity_domain').keyup(function () {
        var quantity = $('input[data-id="quantity_domain"]').val();
        total_domain.value = data_price_domain * parseInt(quantity);
        calculatorTotal();
    });
    var data_price_domain_remain = $(obj).find(':selected').data('price_remain');
    var price_domain_remain = document.getElementById('price_domain_remain');
    price_domain_remain.value = data_price_domain_remain;
    var data_id_domain = $(obj).find(':selected').data('id_domain');
    var id_domain = document.getElementById('id_domain');
    id_domain.value = data_id_domain;
}

function selectNamevps(obj) {
    var data_price_vps = $(obj).find(':selected').data('price_vps');
    var price_vps = document.getElementById('price_vps');
    price_vps.value = data_price_vps;
    var quantity = $('#quantity_vps').val();
    let total_vps = data_price_vps * parseInt(quantity);
    $('#total_vps').val(total_vps);
    $('#total_vps').text(total_vps);
    calculatorTotal();
    $('#quantity_vps').keyup(function () {

        var quantity = $('#quantity_vps').val();

        total_vps = data_price_vps * parseInt(quantity);
        vat10_ = total_vps * 10 / 100;
        vat10.value = vat10_;
        $('#vat10').text(vat10_)
        $('#total_vps').val(total_vps);
        $('#total_vps').text(total_vps);
        calculatorTotal();
    });
    var data_id_vps = $(obj).find(':selected').data('id_vps');
    var id_vps = document.getElementById('id_vps');
    id_vps.value = data_id_vps;
}

function selectNamehosting(obj) {
    var data_price_hosting = $(obj).find(':selected').data('price_hosting');
    var price_hosting = document.getElementById('price_hosting');
    price_hosting.value = data_price_hosting;

    var quantity = $('#quantity_hosting').val();
    tien = data_price_hosting * parseInt(quantity);
    $('#total_hosting').val(tien);
    $('#total_hosting').text(tien);
    calculatorTotal();
    $('#quantity_hosting').keyup(function () {
        var quantity = $('input[data-id="quantity_hosting"]').val();
        tien = data_price_hosting * parseInt(quantity);
        total_hosting.value = tien;
        $('#total_hosting').text(tien);
        calculatorTotal();
    });
    var data_id_hosting = $(obj).find(':selected').data('id_hosting');
    var id_hosting = document.getElementById('id_hosting');
    id_hosting.value = data_id_hosting;
}

function selectName(obj) {
    var data_email = $(obj).find(':selected').data('email');
    var data_address = $(obj).find(':selected').data('address');
    var data_phone = $(obj).find(':selected').data('phone');
    var data_nameStore = $(obj).find(':selected').data('a');
    var data_position = $(obj).find(':selected').data('position');
    var data_fax_number = $(obj).find(':selected').data('fax_number');
    var data_tax_number = $(obj).find(':selected').data('tax_number');
    var data_account_number = $(obj).find(':selected').data('account_number');
    var data_open_at = $(obj).find(':selected').data('open_at');
    var data_id_customer = $(obj).find(':selected').data('id_customer');
    var id_customer = document.getElementById('id_customer');
    id_customer.value = data_id_customer;

    var email = document.getElementById('email');
    var address = document.getElementById('address');
    var telephone = document.getElementById('telephone');
    var nameStore = document.getElementById('nameStore');
    var position = document.getElementById('position');
    var fax_number = document.getElementById('fax_number');
    var account_number = document.getElementById('account_number');
    var open_at = document.getElementById('open_at');
    var tax_number = document.getElementById('tax_number');


    email.value = data_email;
    address.value = data_address;
    telephone.value = data_phone;
    nameStore.value = data_nameStore;
    position.value = data_position;
    fax_number.value = data_fax_number;
    account_number.value = data_account_number;
    open_at.value = data_open_at;
    tax_number.value = data_tax_number;

}

function selectSWare(obj) {
    var data_price = $(obj).find(':selected').data('price');
    $('#price').val(data_price);
    var quantity = $('#quantity').val();
    tien = data_price * parseInt(quantity);
    $('#total').val(tien);
    var text_total = fomat_curent_VND(tien);
    $('#total').text(text_total);
    calculatorTotal();

    console.log(total_all)
    $('#quantity').keyup(function () {
        var quantity = $('input[data-id="quantity"]').val();
        tien = data_price * parseInt(quantity);
        total.value = tien;
        $('#total').text(tien);
        calculatorTotal();
    });
    var data_id_website = $(obj).find(':selected').data('id_website');
    var id_website = document.getElementById('id_website');
    id_website.value = data_id_website;
}

function calculatorTotal() {
    let price_web = $('#total').val();
    let total_price_hosting = $('#total_hosting').val();
    let total_price_domain = $('#total_domain').val();
    let total_price_ssl = $('#total_ssl').val();
    let total_price_vps = $('#total_vps').val();
    if($('#vat10')!==undefined)
    {
        let vat = $('#vat10').val();

        if (price_web === undefined && total_price_ssl === undefined && total_price_domain === undefined && total_price_hosting !== undefined) {
            var total_all = parseInt(total_price_hosting) + parseInt(vat);
        }
        if (price_web === undefined && total_price_ssl === undefined && total_price_domain === undefined && total_price_hosting === undefined && total_price_vps !== undefined) {
            var total_all = parseInt(total_price_vps) + parseInt(vat);
        }
    }

    if (price_web !== undefined && total_price_ssl !== undefined && total_price_domain !== undefined && total_price_hosting !== undefined) {
        var total_all = parseInt(price_web) + parseInt(total_price_hosting) + parseInt(total_price_domain) + parseInt(total_price_ssl);
    }

    if (price_web === undefined && total_price_ssl !== undefined && total_price_domain === undefined && total_price_hosting === undefined) {
        var total_all = parseInt(total_price_ssl);

    }
    if (price_web === undefined && total_price_ssl === undefined && total_price_domain !== undefined && total_price_hosting === undefined) {
        var total_all = parseInt(total_price_domain);

    }



    $('#total_all').val(total_all);
    $('#total_all').text(total_all);

}

function fomat_curent_VND(number) {
    var formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    })
    var currentcy = formatter.format(number);
    return currentcy;
}

$(document).ready(function () {
    //tổng tiền web
    let price = $('#price').val();
    if (price !== undefined) {
        let quantity = $('#quantity').val();
        var tien = parseInt(price) * parseInt(quantity);
        console.log($('#price').val());
        total.value = tien;
        $('#total').text(tien);
    }

    //tổng tiền hosting
    let price_hosting = $('#price_hosting').val();
    if (price_hosting !== undefined) {
        let quantity_hosting = $('#quantity_hosting').val();
        var total_price_hosting = parseInt(price_hosting) * parseInt(quantity_hosting);
        if(!$('#vat10'))
        {
            vat10_ = total_price_hosting * 10 / 100;
            vat10.value = vat10_;
            $('#vat10').text(vat10_)
        }

        $('#total_hosting').val(total_price_hosting);
        $('#total_hosting').text(total_price_hosting);
    }

    //tổng tiền ssl
    let price_ssl = $('#price_ssl').val();
    if (price_ssl !== undefined) {
        let quantity_ssl = $('#quantity_ssl').val();
        var total_price_ssl = parseInt(price_ssl) * parseInt(quantity_ssl);
        $('#total_ssl').val(total_price_ssl);
        $('#total_ssl').text(total_price_ssl);
    }


    //tổng tiền domain
    let price_domain = $('#price_domain').val();
    if (price_domain !== undefined) {
        let quantity_domain = $('#quantity_domain').val();
        var total_price_domain = parseInt(price_domain) * parseInt(quantity_domain);
        $('#total_domain').val(total_price_domain);
        $('#total_domain').text(total_price_domain);
    }

    //tổng tiền vps
    let price_vps = $('#price_vps').val();
    if (price_vps !== undefined) {
        let quantity_vps = $('#quantity_vps').val();
        var total_price_vps = parseInt(quantity_vps) * parseInt(price_vps);
        if(!$('#vat10'))
        {
            vat10_ = total_price_hosting * 10 / 100;
            vat10.value = vat10_;
            $('#vat10').text(vat10_)
        }
        $('#total_vps').val(total_price_vps);
        $('#total_vps').text(total_price_vps);
    }
    let vat10__=$('#vat10').val();
    if (tien !== undefined && total_price_ssl !== undefined && total_price_domain !== undefined && total_price_hosting !== undefined) {
        var total_all = parseInt(tien) + parseInt(total_price_hosting) + parseInt(total_price_domain) + parseInt(total_price_ssl);
    }

    if (tien === undefined && total_price_ssl !== undefined && total_price_domain === undefined && total_price_hosting === undefined) {
        var total_all = parseInt($('#total_all').val()) + parseInt(total_price_ssl);
    }
    if (tien === undefined && total_price_ssl === undefined && total_price_domain !== undefined && total_price_hosting === undefined) {
        var total_all = parseInt($('#total_all').val()) + parseInt(total_price_domain);
    }
    if (tien === undefined && total_price_ssl === undefined && total_price_domain === undefined && total_price_hosting !== undefined) {
        var total_all = parseInt($('#total_all').val()) + parseInt(total_price_hosting)+parseInt(vat10__);
    }

    if (tien === undefined && total_price_ssl === undefined && total_price_domain === undefined && total_price_hosting === undefined && total_price_vps !== undefined) {
        var total_all = parseInt($('#total_all').val()) + parseInt(total_price_vps)+parseInt(vat10__);
    }
    $('#total_all').val(total_all);
    $('#total_all').text(total_all);
    $('#quantity').keyup(function () {
        var data_price = $('#price').val();
        console.log(data_price);
        var quantity = $('input[data-id="quantity"]').val();
        tien = data_price * parseInt(quantity);
        total.value = tien;
        $('#total').text(tien);
        calculatorTotal();
    });

    $('#quantity_ssl').keyup(function () {
        var data_price_ssl = $('#price_ssl').val();
        var quantity = $('#quantity_ssl').val();
        total_ssl.value = data_price_ssl * parseInt(quantity);
        calculatorTotal();
    });

    $('#quantity_domain').keyup(function () {
        var data_price_domain = $('#price_domain').val();
        var quantity = $('#quantity_domain').val();
        total_domain.value = data_price_domain * parseInt(quantity);
        calculatorTotal();
    });

    $('#quantity_hosting').keyup(function () {
        var data_price_hosting = $('#price_hosting').val();
        var quantity = $('input[data-id="quantity_hosting"]').val();
        tien = data_price_hosting * parseInt(quantity);
        total_hosting.value = tien;
        vat10_ = tien * 10 / 100;
        vat10.value = vat10_;
        $('#vat10').text(vat10_)
        $('#total_hosting').text(tien);
        calculatorTotal();
    });

    $('#quantity_vps').keyup(function () {
        var data_price = $('#price_vps').val();
        var quantity = $('input[data-id="quantity_vps"]').val();
        tien = data_price * parseInt(quantity);
        total_vps.value = tien;
        vat10_ = tien * 10 / 100;
        vat10.value = vat10_;
        $('#vat10').text(vat10_)
        $('#total_vps').text(tien);
        calculatorTotal();
    });
    //     // var list_hopdong_phanmem = [];
    //     var list_function_home = [];
    //     var list_function_product = [];
    //     var list_function_different = [];
    //     var i = 1;
    // var sum = 0;
    // $('#bt_contract_sw').click(function () {
    //     var tdhv = {
    //         id: i,
    //         tenhopdong: $('#nameSW option:selected').text(),
    //         gia: $('#price').val(),
    //         soluong: $('#quantity').val(),
    //         thanhtien: $('#total').val(),
    //     };
    //     list_hopdong_phanmem.push(tdhv);
    //
    //
    //     message = "<tr><td> " + "<input class='list_hopdong' type='hidden' name='list_hopdong[]' " +
    //         "value='"
    //         + tdhv.tenhopdong + ","
    //         + tdhv.gia + ","
    //         + tdhv.soluong + ","
    //         + tdhv.thanhtien + "'>"
    //         + tdhv.tenhopdong + "</td>" +
    //         "<td>" + tdhv.gia + "</td>" +
    //         "<td>" + tdhv.soluong + "</td>" +
    //         "<td class='thanhtien'>" + tdhv.thanhtien + "</td><td><a class='remove' id =" + tdhv.id + "><i class='fa fa-trash'></i></a></td>" +
    //         "</tr>";
    //     $('#tb_hopdong').append(message);
    //     i++;
    //
    //     sum += Number(tdhv.thanhtien);
    //     console.log(sum);
    //     $('#total_price').text(sum);
    // })
    //
    //
    // message = "<tr><th style='width: 80%'>Tổng tiền</th><th  id='total_price'></th></tr>";
    // // $('#tb_hopdong').append(message);
    // $('#tb_thanhtien').append(message);
    //

    // $('#bt_function_home').click(function () {
    //     var function_homes = {
    //         id: i,
    //         // category_page:$('#category_page').val(),
    //         function_home: $('#function_home').val()
    //     };
    //     list_function_home.push(function_homes);
    //
    //     message = "<tr><td> " + "<input class='list_function_home' type='hidden' name='list_function_homes[]' " +
    //         "value='"
    //         + function_homes.function_home + "'>" + function_homes.function_home + "</td><td><a class='remove' id ='" + function_homes.id + "'><i class='fa fa-trash'></i></a></td></tr>";
    //     $('#tb_function_home').append(message);
    //
    //     i++;
    // })
    // $("#tb_function_home").on("click", ".remove", function () {
    //     z = list_function_home.findIndex(obj => obj.id == $(this).attr("id"));
    //     list_function_home.splice(z, 1);
    //     $(this).closest("tr").remove();
    // });
    //
    //
    // $('#bt_function_product').click(function () {
    //     var function_products = {
    //         id: i,
    //         function_product: $('#function_product').val()
    //     };
    //     list_function_product.push(function_products);
    //
    //     message = "<tr><td> " + "<input class='list_function_product' type='hidden' name='list_function_products[]' " +
    //         "value='"
    //         + function_products.function_product + "'>" + function_products.function_product + "</td><td><a class='remove' id =" + function_products.id + "><i class='fa fa-trash'></i></a></td>" +
    //         "</tr>";
    //     $('#tb_function_product').append(message);
    //     i++;
    // })
    // $("#tb_function_product").on("click", ".remove", function () {
    //     z = list_function_product.findIndex(obj => obj.id == $(this).attr("id"));
    //     list_function_product.splice(z, 1);
    //     $(this).closest("tr").remove();
    // });
    //
    //
    // $('#bt_function_different').click(function () {
    //     var function_differents = {
    //         id: i,
    //         function_different: $('#function_different').val()
    //     };
    //     list_function_different.push(function_differents);
    //
    //     message = "<tr><td> " + "<input class='list_function_different' type='hidden' name='list_function_differents[]' " +
    //         "value='"
    //         + function_differents.function_different + "'>" + function_differents.function_different + "</td><td><a class='remove' id =" + function_differents.id + "><i class='fa fa-trash'></i></a></td>" +
    //         "</tr>";
    //     $('#tb_function_different').append(message);
    //     i++;
    // })
    // $("#tb_function_different").on("click", ".remove", function () {
    //     z = list_function_different.findIndex(obj => obj.id == $(this).attr("id"));
    //     list_function_different.splice(z, 1);
    //     $(this).closest("tr").remove();
    // });


    // $("#tb_hopdong").on("click", ".remove", function () {
    //     z = list_hopdong_phanmem.findIndex(obj => obj.id == $(this).attr("id"));
    //     list_hopdong_phanmem.splice(z, 1);
    //     $(this).closest("tr").remove();
    // });
});
