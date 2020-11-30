const baseURL = 'http://localhost:8000/';

function validateFormHeader() {
    let isValidHeader = true;
    $('.header-field-form').each(function() {
        if ( $(this).val() === '' )
        isValidHeader = false;
    });
    return isValidHeader;
}

function validateFormHeaderLine(){
    let isValidLine = true;
    $('.header-line-field-form').each(function() {
        if ( $(this).val() === '' )
            isValidLine = false;
      });
    return isValidLine;
}

function previewImg(idInput, idImage) {
    const file = new FileReader();
    const img = document.querySelector(`#${idInput}`);
    file.readAsDataURL(img.files[0]);

    const contoh = document.querySelector(`#${idImage}`);
    // console.log(contoh);
    file.onload = function(e){
        contoh.src = (e.target.result);
    }
}

$('#modelType').on("change", function (e) {
    // if(e.which == 13)  // the enter key code
    // {
        $.ajax({
            url: `/procurement/meuble`,
            data: {
                model: $("#modelType").val(),
                _token: $("#ajaxCoba").children()[0].getAttribute("value")}, //ambil nilai dari csrf
            dataType: "json",
            success: (data) => {
                if(data){
                    $("#price").val(data.price);
                    $('#name').val(data.name);
                }else{
                    $('#modelType').val("");
                    $('#name').val("");
                    $('#price').val(0);
                    alert(`Data model ${$("#modelType").val()} doesn't exist!`);
                }
            }
        });
    });

$('#customer').on("change", function (e) {
    // if(e.which == 13)  // the enter key code
    // {
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

$("#addItem").on("click", function (){
    if(validateFormHeaderLine()){
        $.ajax({
            url: `/procurement/meuble`,
            data: {
                model: $("#modelType").val(),
                _token: $("#ajaxCoba").children()[0].getAttribute("value")}, //ambil nilai dari csrf
            dataType: "json",
            success: (data) => {
                if(data){
                    let quantity = parseInt($('#quantity').val());
                    //ambil data awal dari total item dan total price yang ada di header
                    let totalItem =  parseInt($("#totalItem").val());
                    let totalPrice = parseInt($("#totalPrice").val());
                    
                    //ubah tampilan data awal sesuaikan dengan kalkulasi
                    totalItem += quantity;
                    totalPrice += quantity*data.price;

                    $("#totalItem").val(totalItem);
                    $("#totalPrice").val(totalPrice);
                    $("#totalPayment").val(totalPrice-parseInt($("#totalDisc").val()));

                    //Buat tag template HTML
                    const tag_html = `
                        <div id="${data.modelType}"
                            data-model="${data.modelType}"
                            data-meubleName="${data.name}" 
                            data-price="${data.price}" 
                            data-quantity="${quantity}" 
                            data-category="${data.category}" 
                            data-warranty="${data.warrantyPeriodeMonth}"
                            data-color="${data.color}" 
                            data-size="${data.size}" 
                            data-description="${data.description}">
                            <div class="row pt-3" >
                                <div class="col-12 col-md-3">
                                    <img id="${data.modelType}-img" class="card-img-top" src="${baseURL}${data.image}" alt="Card image cap">
                                </div>
                                <div class="col-12 col-md-9 pt-4">
                                    <h3 class="font-weight-bold">${data.modelType}</h3>Rp ${data.price},00
                                    <p class="font-weight-bold">Ammount: ${quantity}</p>
                                    <p class="font-weight-bold">Color: ${data.color}</p>
                                    <p class="font-weight-bold">Size: ${data.size}</p>
                                    <p class="font-weight-bold">Description: ${data.description}.</p>
                                </div>
                            </div>
                        </div>
                    `;

                    //tambahkan item ke daftar purchase order
                    $("#lineItem").append(tag_html);
                    //setelah klik add, bersihkan field input
                    $("#lineHeader input").val(null);
                    $("#price").val(0);
                }else{
                    alert(`Data model ${$("#modelType").val()} doesn't exist!`);
                    $("#price").val(0);
                }
            }
        });
    }else{
        alert("Line Item form must be filled");
    }
});

$("#createPO").on("click",function(){
    if(validateFormHeader()){
        //ambil semua data di header
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
        
        //ajax query ke database purchase_order
        $.ajax({
            url: `/procurement/create/header/${id}`,
            method: "post",
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
                        url: `/procurement/create/${id}`,
                        method: "post",
                        data: {numPo ,modelType, meubleName, category, size, color, description, warranty, price, quantity, vendor, _token: $("#ajaxInput").children()[0].getAttribute("value")},
                        success: (response) => {
                            alert("Data successfully inserted");
                            window.location.href = "/procurement/menu/"+id;
                        }
                    });
                }
            }
        });
    }else{
        alert(validateFormHeader());
    }
})

$("#createSO").on("click",function(){
    if(validateFormHeader()){
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
        const employeeID = $("#employee").data("id");
        
        //ajax query ke database purchase_order
        $.ajax({
            url: `/salesorder/create/header`,
            method: "post",
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
                        url: `/salesorder/create/salesorderline`,
                        method: "post",
                        data: {numSO ,modelType, price, quantity, discountMeuble, _token: $("#ajaxInput").children()[0].getAttribute("value")},
                        success: (response) => {
                            window.location.href = "/salesorder";
                        }
                    });
                }
            }
        });
    }else{
        alert(validateFormHeader());
    }
})

// INSERT INTO t(dob) VALUES(TO_DATE('17/12/2015', 'DD/MM/YYYY'));

// $('#freightIn').on("click", function(){
//     let freight = parseInt($('#freightIn').val());
//     console.log(freight);
//     $('#freightIn').keypress(function (e) {
//         let key = e.which;
//         if(key == 13)  // the enter key code
//         {
//             let totalPrice = parseInt($("#totalPrice").val())-freight;
//             totalPrice += parseInt($(this).val());
    
//             $("#totalPrice").val(totalPrice)
//         }
//     });   
// });

// $("#modelType").keypress(function (e) {
//     if(e.which == 13){
//         $.ajax({
//             url: `/procurement/meuble`,
//             data: {
//                 model: $("#modelType").val(),
//                 _token: $("#ajaxCoba").children()[0].getAttribute("value")},
//             dataType: "json",
//             success: (data) => {
//                 if(data){
//                     $("#vendor").val(data.vendor);
//                     $("#meubleName").val(data.name);
//                     $("#category").val(data.category);
//                     $("#size").val(data.size);
//                     $("#color").val(data.color);
//                     $("#description").val(data.description);
//                     $("#warranty").val(data.warrantyPeriodeMonth);
//                     $("#price").val(data.price);
//                 }
//             }
//         });
//         console.log("Oke");
//     }
// });