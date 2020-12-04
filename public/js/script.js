const baseURL = 'http://localhost:8000/';

function validateForm(type) {
    if(type == 'header'){
        let isValidHeader = true;
        $('.header-field-form').each(function() {
            if ( $(this).val() === '' )
            isValidHeader = false;
        });
        return isValidHeader;
    }

    let isValidLine = true;
    $('.header-line-field-form').each(function() {
        if ( $(this).val() === '' )
            isValidLine = false;
      });
    return isValidLine;
}

//freight in untuk PO dan SO (fix)
$('#freightIn').keypress(function (e) {
    if(e.which == 13)  // the enter key code
    {
        let totalPayment = parseInt($("#totalPayment").val()) + parseInt($('#freightIn').val());
        $(this).attr('disabled',true);
        $("#totalPayment").val(totalPayment)
    }
});

//Discount ketika PO dari Vendor (fix)
$('#totalDisc').keypress(function (e) {
    if(e.which == 13)  // the enter key code
    {
        let totalPayment = parseInt($("#totalPayment").val()) - parseInt($(this).val());
        $(this).attr('disabled',true);
        $("#totalPayment").val(totalPayment)
    }
});

//generate data jika ada untuk PO dan SO (fix)
$('#modelType').on("change", function () {
    //ambil asal url terlebih dahulu
    let url = window.location.href;
    url = url.split("/");
    url = `${url[(url.length)-2]}`;

    $.ajax({
        url: `/procurement/meuble`,
        data: {
            model: $("#modelType").val(),
            vendor: $('#vendor').val(),
            source_url: url,
            _token: $("#ajaxCoba").children()[0].getAttribute("value")}, //ambil nilai dari csrf
        dataType: "json",
        success: (data) => {
            if(data){
                $("#price").val(data.price);
                $('#name').val(data.name);
            }else{
                alert(`Model ${$("#modelType").val()} from vendor ${$("#vendor").val()} doesn't exist!`);
                $('#modelType').val(null);
                $('#price').val(0);
            }
        }
    });
});

//generate data customer jika ada (fix)
$('#customer').on("change", function () {
    $.ajax({
        url: `/salesorder/customer`,
        data: {
            model: $("#customer").val(),
            _token: $("#ajaxCoba").children()[0].getAttribute("value")}, //ambil nilai dari csrf
        dataType: "json",
        success: (data) => {
            if(data){
                $("#customerName").val(data.name);
            }else{
                $("#customer").val("");
                $("#customerName").val("Customer");
                alert(`Customer doesn't exist, please Add New Customer.`);
            }
        }
    });
});

//menambahkan item ketika PO dan SO (fix)
$("#lineHeader").on("click", '#addItem', function (){
    if(validateForm('line')){
        //ambil asal url terlebih dahulu
        let url = window.location.href;
        url = url.split("/");
        url = `${url[(url.length)-2]}`;

        $.ajax({
            url: `/procurement/meuble`,
            data: {
                model: $("#modelType").val(),
                vendor: $('#vendor').val(),
                source_url: url,
                _token: $("#ajaxCoba").children()[0].getAttribute("value")}, //ambil nilai dari csrf
            dataType: "json",
            success: (data) => {
                if(data){
                    let quantity = parseInt($('#quantity').val());
                    //ambil data awal dari total item dan total price yang ada di header
                    let totalItem =  parseInt($("#totalItem").val());
                    let totalPrice = parseInt($("#totalPrice").val());
                    let totalPayment = parseInt($("#totalPayment").val());
                    //ubah tampilan data awal sesuaikan dengan kalkulasi
                    totalItem += quantity;
                    totalPrice += quantity*data.price;
                    totalPayment += quantity*data.price;
                    $("#totalItem").val(totalItem);
                    $("#totalPrice").val(totalPrice);
                    $("#totalPayment").val(totalPayment);

                    //Buat tag template HTML
                    const tag_html = `
                        <div id="${data.modelType}">
                            <input type="hidden" id="model-${data.modelType}" value="${data.modelType}">
                            <input type="hidden" id="name-${data.modelType}" value="${data.name}">
                            <input type="hidden" id="price-${data.modelType}" value="${data.price}"> 
                            <input type="hidden" id="quantity-${data.modelType}" value="${quantity}"> 
                            <input type="hidden" id="category-${data.modelType}" value="${data.category}"> 
                            <input type="hidden" id="warranty-${data.modelType}" value="${data.warrantyPeriodeMonth}">
                            <input type="hidden" id="color-${data.modelType}" value="${data.color}"> 
                            <input type="hidden" id="size-${data.modelType}" value="${data.size}">
                            <input type="hidden" id="desc-${data.modelType}" value="${data.description}">
                            ${url == 'salesorder' ? `<input type="hidden" id="discMeuble-${data.modelType}" value="${$("#discountMeuble").val()}">` : ''}
                            <div class="row pt-3" >
                                <div class="col-12 col-md-3">
                                    <img id="${data.modelType}-img" class="card-img-top" src="${baseURL}${data.image}" alt="Card image cap">
                                </div>
                                <div class="col-12 col-md-9 pt-4">
                                    <h3 class="font-weight-bold">${data.modelType}</h3>Rp ${data.price},00
                                    <p class="font-weight-bold dataQuantity">Ammount: ${quantity}</p>
                                    ${url == 'salesorder' ? `<p class="font-weight-bold meubleDiscount">Discount: Rp ${data.price*$("#discountMeuble").val()},00</p>` : ''}
                                    <p class="font-weight-bold">Color: ${data.color}</p>
                                    <p class="font-weight-bold">Size: ${data.size}</p>
                                    <p class="font-weight-bold">Description: ${data.description}.</p>
                                    <button type="button" class="btn btn-danger removeItem">remove</button>
                                    <button type="button" class="btn btn-primary editItem">edit</button>
                                </div>
                            </div>
                        </div>
                    `;

                    //tambahkan item ke daftar purchase order
                    $("#lineItem").append(tag_html);
                    //setelah klik add, bersihkan field input
                    $("#lineHeader input").val(null);
                    $("#price").val(0);
                    $("#quantity").val(0);
                    $("#vendor").attr("disabled", true);
                }else{
                    alert(`Model ${$("#modelType").val()} from vendor ${$("#vendor").val()} doesn't exist!`);
                    $('#modelType').val(null);
                    $('#price').val(0);
                }
            }
        });
    }else{
        alert("Line Item form must be filled");
    }
});

//mengambil nilai discount dari header SO (fix)
$('#discount').on('click', function(){
    let disc = $(this).val();
    let totalPayment = $('#totalPayment').val();

    disc = totalPayment*disc;
    totalPayment = totalPayment - disc;
    $(this).val(disc);
    $('#totalPayment').val(totalPayment);

    $(this).attr('disabled',true);
});

//create new PO dan SO (fix)
$("#createTransaction").on("click",function(){
    //ambil asal url terlebih dahulu
    let url = window.location.href;
    url = url.split("/");
    url = `${url[(url.length)-2]}`;

    if(validateForm('header')){
        //ambil semua data di header PO
        const numPo = $("#numPO").val();
        const vendor = $("#vendor").val();
        const date = $("#date").val();
        const validTo = $("#validTo").val();
        const totalItem = $("#totalItem").val();
        const freightIn = $("#freightIn").val();
        const totalPrice = $("#totalPrice").val();
        const totalDisc = $("#totalDisc").val();
        const totalPayment = $("#totalPayment").val();
        let employee = $("#employeeName").val();
        let id = parseInt(employee.split(":")[0]);
        
        //data header jika dari SO
        const numSO = $("#numSO").val();
        const customer = $("#customer").val();
        const paymentDiscount = $("#discount").val();
        const totalMeubleDisc = totalDisc-paymentDiscount;

        //ajax query ke database
        if(url == "salesorder"){
            $.ajax({
                url: "/salesorder/create/header",
                method: "post",
                data: {numSO, customer, id, date, validTo, totalItem, totalPrice, freightIn, paymentDiscount, totalDisc, totalPayment, totalMeubleDisc, _token: $("#ajaxInput").children()[0].getAttribute("value")},
                success: () => {
                    // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
                    const item = $("#lineItem").children();
                    //ambil per baris yang ada
                    for(let i = 0; i < item.length; i++){
                        const child = item[i];
                        const modelType = child.getAttribute("id");

                        const meubleName = $(`#name-${modelType}`).val();
                        const category = $(`#category-${modelType}`).val();
                        const size = $(`#size-${modelType}`).val();
                        const color = $(`#color-${modelType}`).val();
                        const description = $(`#desc-${modelType}`).val();
                        const warranty = parseInt($(`#warranty-${modelType}`).val());
                        const price = parseInt($(`#price-${modelType}`).val());
                        const quantity = parseInt($(`#quantity-${modelType}`).val());
                        const discountMeuble = parseInt($(`#discMeuble-${modelType}`).val());
                
                        $.ajax({
                            url: '/salesorder/create/salesorderline',
                            method: "post",
                            data: {numSO ,modelType, price, quantity, discountMeuble, _token: $("#ajaxInput").children()[0].getAttribute("value")},
                            success: () => {
                                alert("Data successfully inserted");
                                window.location.href = "/salesorder";
                            }
                        });
                    }
                }
            });
        }else{
            $.ajax({
                url: `/procurement/create/header`,
                method: "post",
                data: {numPo, vendor, id, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment, _token: $("#ajaxInput").children()[0].getAttribute("value")},
                success: () => {
                    // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
                    const item = $("#lineItem").children();
                    //ambil per baris yang ada
                    for(let i = 0; i < item.length; i++){
                        const child = item[i];
                        const modelType = child.getAttribute("id");
    
                        const meubleName = $(`#name-${modelType}`).val();
                        const category = $(`#category-${modelType}`).val();
                        const size = $(`#size-${modelType}`).val();
                        const color = $(`#color-${modelType}`).val();
                        const description = $(`#desc-${modelType}`).val();
                        const warranty = parseInt($(`#warranty-${modelType}`).val());
                        const price = parseInt($(`#price-${modelType}`).val());
                        const quantity = parseInt($(`#quantity-${modelType}`).val());
                
                        $.ajax({
                            url: `/procurement/create`,
                            method: "post",
                            data: {numPo ,modelType, meubleName, category, size, color, description, warranty, price, quantity, vendor, _token: $("#ajaxInput").children()[0].getAttribute("value")},
                            success: () => {
                                alert("Data successfully inserted");
                                window.location.href = "/procurement/list";
                            }
                        });
                    }
                }
            });
        }
    }else{
        alert("All field header must be filled!");
    }
})

//remove item ketika create PO (fix)
$('#lineItem').on('click','.removeItem',function(){
    //simpan element yang akan di remove
    const element = $(this).parent().parent().parent();

    //ambil data yang dibutuhkan
    const model = element.attr('id');
    const quantity = parseInt($(`#quantity-${model}`).val());
    const price = parseInt($(`#price-${model}`).val());

    //ambil data awal dari total item, total payment, dan total price yang ada di header
    const totalPayment = parseInt($("#totalPayment").val());
    const totalItem =  parseInt($("#totalItem").val());
    const totalPrice = parseInt($("#totalPrice").val());

    //kalkulasi hasil perubahan berdasarkan update
    const newTotalItem = totalItem - quantity;
    const newTotalPrice = totalPrice - quantity*price;
    const newTotalPayment = totalPayment - quantity*price;

    console.log("Old Value Item: "+model+" "+quantity+" "+price);
    console.log("Old Value Header: item-"+totalItem+" payment-"+totalPayment+" price-"+totalPrice);
    console.log("New Value Header: item-"+newTotalItem+" payment-"+newTotalPayment+" price-"+newTotalPrice);

    // ubah tampilan data
    $("#totalItem").val(newTotalItem);
    $("#totalPrice").val(newTotalPrice);
    $("#totalPayment").val(newTotalPayment);

    //hapus item dari list item
    element.remove();
});

//ketika edit di list item diklik saat create PO (fix)
$('#lineItem').on("click", '.editItem', function(){
    //ambil data dari tombol ini yang di klik
    const model = $(this).parent().parent().parent().attr("id");
    const quantity = parseInt($(`#quantity-${model}`).val());
    const price = parseInt($(`#price-${model}`).val());
    alert(model+" "+price+" "+quantity);
    
    //pasang value lama ke field edit
    $("#modelType").val(model);
    $("#quantity").val(quantity);
    $("#price").val(price);

    //disabled si model type
    $("#modelType").attr('disabled',true);
    //ubah tombol add jadi update
    $("#addItem").attr('id','changeItem').html("Change");
})

//update list item ketika create PO (fix) 
$("#lineHeader").on("click", '#changeItem', function (){
    //ambil value baru dari field
    const model = $("#modelType").val();
    const quantity = parseInt($("#quantity").val());
    const price = parseInt($("#price").val());

    //ambil data awal dari total item, total payment, dan total price yang ada di header
    const totalPayment = parseInt($("#totalPayment").val());
    const totalItem =  parseInt($("#totalItem").val());
    const totalPrice = parseInt($("#totalPrice").val());

    //ambil data lama sebelum perubahan
    const old_quantity = parseInt($(`#quantity-${model}`).val());

    //kalkulasi hasil perubahan berdasarkan update
    const newTotalItem = (totalItem - old_quantity) + quantity;
    const newTotalPrice = (totalPrice - (old_quantity*price)) + (quantity*price);
    const newTotalPayment = (totalPayment - totalPrice) + newTotalPrice;

    //ubah tampilan data
    $("#totalItem").val(newTotalItem);
    $("#totalPrice").val(newTotalPrice);
    $("#totalPayment").val(newTotalPayment);
    
    //ubah data yang ada di list item dengan hasil update
    $(`#quantity-${model}`).val(quantity);
    $(`#${model} .dataQuantity`).html("Amount: "+quantity);
    
    //kembalikan tombol change ke tombol add
    $("#changeItem").attr('id','addItem').html("Add");
    $("#modelType").attr('disabled',false);
    
    //bersihkan kembali field input
    $("#lineHeader input").val(null);
    $("#price").val(0);
    $("#quantity").val(0);
});


$('#updatePO').on("click",function (){
    //Ambil data header, lalu update header di tabel purchase_order
    if(validateForm('header')){
        const numPo = $("#numPO").val();
        const vendor = $("#vendor").val();
        const date = $("#date").val();
        const validTo = $("#validTo").val();
        const totalItem = $("#totalItem").val();
        const freightIn = $("#freightIn").val();
        const totalPrice = $("#totalPrice").val();
        const totalDisc = $("#totalDisc").val();
        const totalPayment = $("#totalPayment").val();
        let employee = $("#employeeName").val();
        let id = parseInt(employee.split(":")[0]);
        
        //ajax query ke database purchase_order untuk update
        $.ajax({
            url: `/procurement/update/header`,
            method: "put",
            data: {numPo, vendor, id, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment, _token: $("#ajaxInput").children()[0].getAttribute("value")},
            success: () => {
                // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
                const item = $("#lineItem").children();
                //ambil per baris yang ada
                for(let i = 0; i < item.length; i++){
                    const child = item[i];
                    
                    const modelType = child.getAttribute("data-model");
                    const meubleName = child.getAttribute("data-meubleName");
                    const category = child.getAttribute("data-category");
                    const size = child.getAttribute("data-size");
                    const color = child.getAttribute("data-color");
                    const description = child.getAttribute("data-description");
                    const warranty = parseInt(child.getAttribute("data-warranty"));
                    const price = parseInt(child.getAttribute("data-price"));
                    const quantity = parseInt(child.getAttribute("data-quantity"));
            
                    $.ajax({
                        url: `/procurement/update`,
                        method: "put",
                        data: {numPo ,modelType, meubleName, category, size, color, description, warranty, price, quantity, vendor, _token: $("#ajaxInput").children()[0].getAttribute("value")},
                        success: () => {
                            alert("Purchase Order "+numPo+" successfully updated!");
                            window.location.href = "/procurement/list";
                        }
                    });
                }
            }
        });
    }else{
        alert("All field header must be filled!");
    }
    //Ambil data line item, lalu update tabel purchase_order_line
});

$("#updateSO").on("click",function(){
    if(validateForm('header')){
        //ambil semua data di header
        const numSO = $("#numSO").val();
        const customer = $("#customer").val();
        const date = $("#date").val();
        const validTo = $("#validTo").val();
        const totalItem = $("#totalItem").val();
        // const freightIn = $("#freightIn").val();
        const totalPrice = $("#totalPrice").val();
        const paymentDiscount = null;
        const totalDisc = $("#totalDisc").val();
        const totalPayment = $("#totalPayment").val();
        const employeeID = $("#employeeName").val();
        
        //ajax query ke database purchase_order
        $.ajax({
            url: `/salesorder/update/header`,
            method: "put",
            data: {numSO, customer, employeeID, date, validTo, totalItem, totalPrice, paymentDiscount, totalDisc, totalPayment, _token: $("#ajaxInput").children()[0].getAttribute("value")},
            // success: (data) => {
            //     console.log(data);
            // }
            success: () => {
                // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
                const item = $("#lineItem").children();
                //ambil per baris yang ada
                for(let i = 0; i < item.length; i++){
                    const child = item[i];
                    
                    const modelType = child.getAttribute("data-model");
                    const meubleName = child.getAttribute("data-meubleName");
                    const category = child.getAttribute("data-category");
                    const size = child.getAttribute("data-size");
                    const color = child.getAttribute("data-color");
                    const description = child.getAttribute("data-description");
                    const warranty = parseInt(child.getAttribute("data-warranty"));
                    const price = parseInt(child.getAttribute("data-price"));
                    const quantity = parseInt(child.getAttribute("data-quantity"));
                    const discountMeuble = 0;
            
                    $.ajax({
                        url: `/salesorder/update/salesorderline`,
                        method: "put",
                        data: {numSO ,modelType, price, quantity, discountMeuble, _token: $("#ajaxInput").children()[0].getAttribute("value")},
                        success: () => {
                            alert("Sales Order "+numSO+" successfully updated!");
                            window.location.href = "/salesorder";
                        }
                    });
                }
            }
        });
    }else{
        alert(validateForm('header'));
    }
})

$('#cancel').on("click", function (){
    
});

$('#proceedPO').on("click", function(){
    //updateData();
    //Data line item yang diambil, update quantity di tabel mebel berdasarkan type model
    //Ubah transaction status menjadi 1
});

function coba(){
    console.log(url);
}

//windows.location.href