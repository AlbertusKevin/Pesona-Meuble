/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

const baseURL = "http://localhost:8000/";

//ambil asal url terlebih dahulu
const getURL = () => window.location.href.split("/")[3];

const validateForm = (type) => {
    if (type == "header") {
        let isValidHeader = true;
        $(`.${type}-field-form`).each(function () {
            if ($(this).val() === "") isValidHeader = false;
        });
        return isValidHeader;
    }

    let isValidLine = true;
    $(`.${type}-field-form`).each(function () {
        if ($(this).val() === "") isValidLine = false;
    });
    return isValidLine;
};

const update = function () {
    //ambil asal url terlebih dahulu
    let url = getURL();

    if (validateForm("header")) {
        //ambil semua data di header PO
        const numPo = $("#numPO").val();
        const totalItem = $("#totalItem").val();
        const totalPrice = $("#totalPrice").val();
        const totalPayment = $("#totalPayment").val();

        //data header jika dari SO
        const numSO = $("#numSO").val();

        //ajax query ke database
        if (url == "salesorder") {
            $.ajax({
                url: "/salesorder",
                method: "patch",
                data: {
                    numSO,
                    totalItem,
                    totalPrice,
                    totalPayment,
                    _token: $("#ajaxInput").children()[0].getAttribute("value"),
                },
                success: () => {
                    $.ajax({
                        url: "/salesorder",
                        method: "delete",
                        data: {
                            numSO,
                            _token: $("#ajaxInput")
                                .children()[0]
                                .getAttribute("value"),
                        },
                        success: () => {
                            // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
                            const item = $("#lineItem").children();

                            //ambil per baris yang ada
                            for (let i = 0; i < item.length; i++) {
                                const child = item[i];
                                const modelType = child.getAttribute("id");
                                const price = parseInt(
                                    $(`#price-${modelType}`).val()
                                );
                                const quantity = parseInt(
                                    $(`#quantity-${modelType}`).val()
                                );
                                $.ajax({
                                    url: "/salesorder/line",
                                    method: "post",
                                    data: {
                                        numSO,
                                        modelType,
                                        price,
                                        quantity,
                                        _token: $("#ajaxInput")
                                            .children()[0]
                                            .getAttribute("value"),
                                    },
                                });
                            }
                        },
                    });
                },
            });
        } else {
            $.ajax({
                url: `/procurement`,
                method: "patch",
                data: {
                    numPo,
                    totalItem,
                    totalPrice,
                    totalPayment,
                    _token: $("#ajaxInput").children()[0].getAttribute("value"),
                },
                success: () => {
                    // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
                    const item = $("#lineItem").children();
                    //ambil per baris yang ada
                    for (let i = 0; i < item.length; i++) {
                        const child = item[i];
                        const modelType = child.getAttribute("id");
                        const price = parseInt($(`#price-${modelType}`).val());
                        const quantity = parseInt(
                            $(`#quantity-${modelType}`).val()
                        );

                        $.ajax({
                            url: `/procurement/line`,
                            method: "delete",
                            data: {
                                numPo,
                                _token: $("#ajaxInput")
                                    .children()[0]
                                    .getAttribute("value"),
                            },
                            success: () => {
                                $.ajax({
                                    url: `/procurement/line`,
                                    method: "post",
                                    data: {
                                        numPo,
                                        modelType,
                                        price,
                                        quantity,
                                        _token: $("#ajaxInput")
                                            .children()[0]
                                            .getAttribute("value"),
                                    },
                                    success: () => {
                                        return url;
                                    },
                                });
                            },
                        });
                    }
                },
            });
        }
    } else {
        alert("All field header must be filled!");
    }
    return url;
};

const quantity = () => {
    const model = $("#modelType").val();
    const quantity = $("#quantity").val();

    //ambil asal url terlebih dahulu
    let url = getURL();

    if (url == "salesorder") {
        $.ajax({
            url: `/meuble/search`,
            data: {
                model,
                source_url: url,
                _token: $("#ajaxCoba").children()[0].getAttribute("value"),
            }, //ambil nilai dari csrf
            dataType: "json",
            success: (data) => {
                if (data) {
                    if (data.stock < quantity) {
                        alert("Insufficient stock " + model);
                    }
                }
            },
        });
    }
};
// =========================================================== Generate Data Customer dan Meuble ====================================================================
//generate data jika ada untuk PO dan SO (fix)
$("#modelType").on("change", function () {
    //ambil asal url terlebih dahulu
    let url = getURL();

    $.ajax({
        url: `/meuble/search`,
        data: {
            model: $("#modelType").val(),
            vendor: $("#vendor").val(),
            source_url: url,
            _token: $("#ajaxCoba").children()[0].getAttribute("value"),
        }, //ambil nilai dari csrf
        dataType: "json",
        success: (data) => {
            if (data) {
                $("#price").val(data.price);
                $("#name").val(data.name);
                if (url == "salesorder") {
                    if (data.stock < quantity) {
                        alert(
                            "Insufficient stock " +
                                model +
                                ". You can still continue the process if stock is planned."
                        );
                    }
                }
            } else {
                alert(
                    `Model ${$("#modelType").val()} from vendor ${$(
                        "#vendor"
                    ).val()} doesn't exist!`
                );
                $("#modelType").val(null);
                $("#price").val(0);
            }
        },
    });
});

//generate data customer jika ada (fix)
$("#customer").on("change", function () {
    $.ajax({
        url: "/customer/search",
        data: {
            id: $("#customer").val(),
            _token: $("#ajaxCoba").children()[0].getAttribute("value"),
        }, //ambil nilai dari csrf
        dataType: "json",
        success: (data) => {
            if (data) {
                $("#customerName").val(data.name);
            } else {
                $("#customer").val("");
                $("#customerName").val("Customer");
                alert(`Customer doesn't exist, please Add New Customer.`);
            }
        },
    });
});

// ============================================= Perhitungan Freight In, Discount  ====================================================================
//freight in untuk PO dan SO (fix)
$("#freightIn").keypress(function (e) {
    if (e.which == 13) {
        // the enter key code
        let totalPayment =
            parseInt($("#totalPayment").val()) +
            parseInt($("#freightIn").val());
        $(this).attr("disabled", true);
        $("#totalPayment").val(totalPayment);
    }
});

//Discount ketika PO dari Vendor (fix)
$("#totalDisc").keypress(function (e) {
    if (e.which == 13) {
        // the enter key code
        let totalPayment =
            parseInt($("#totalPayment").val()) - parseInt($(this).val());
        $(this).attr("disabled", true);
        $("#totalPayment").val(totalPayment);
    }
});

//hitung diskon payment dan Meuble untuk SO (fix)
const hitungDiskon = (id) => {
    const disc = $(id).val();
    let discount = $(`.${disc}`).html().split(":");
    let percent = parseFloat(discount[1]);
    return percent;
};

//prosedur untuk mengubah total diskon payment
const hitungDiskonTotalPayment = () => {
    const disc = hitungDiskon("#discount"); //ambil percent diskon payment
    let totalPayment = parseInt($("#totalPayment").val()); //ambil total payment yang lama
    let discValue = parseFloat((totalPayment * disc).toFixed(2)); //hitung besaran diskon payment saat ini
    let totalDisc = parseInt($("#totalDisc").val()); //ambil total disc yang lama
    totalDisc = totalDisc + discValue; //kalkulasi total discount yang baru
    $("#totalDisc").val(totalDisc); //ubah tampilan dengan hasil baru
    totalPayment = totalPayment - discValue; //kurangi total payment lama dengan discount baru
    $("#totalPayment").val(totalPayment); //ubah value total Payment setelah dikurangi diskon
};

//mengambil nilai discount dari header SO (fix)
$("#discount").on("change", function () {
    $(this).attr("disabled", true); //disabled select option
    hitungDiskonTotalPayment();
});

//===================================================== Menambah, Mengedit, Menghapus Line Item SO dan PO ===========================================================
//menambahkan item PO dan SO (fix)
$("#lineHeader").on("click", "#addItem", function () {
    if (validateForm("line")) {
        //ambil asal url terlebih dahulu
        let url = getURL();

        $.ajax({
            url: `/meuble/search`,
            data: {
                model: $("#modelType").val(),
                vendor: $("#vendor").val(),
                source_url: url,
                _token: $("#ajaxCoba").children()[0].getAttribute("value"),
            },
            dataType: "json",
            success: (data) => {
                if (data) {
                    //cek apakah barang tersebut sudah ada di line item?
                    let found = false;
                    let i = 0;
                    let item = $("#lineItem").children();

                    //looping ambil barang yang ada di line
                    while (!found && item.length > i) {
                        if (item.attr("id") == data.modelType) {
                            found = true;
                        }
                        i++;
                    }
                    // item.each(() => {
                    //     //cek antara div id model dengan data.model, jika ada yang sama, alert
                    //     if (item.attr("id") == data.modelType) {
                    //         found = true;
                    //     }
                    // });

                    if (found) {
                        alert("Data Already Exist in Product List!");
                    } else {
                        let quantity = parseInt($("#quantity").val());
                        //ambil data awal dari total item dan total price yang ada di header
                        let totalItem = parseInt($("#totalItem").val());
                        let totalPrice = parseInt($("#totalPrice").val());
                        let totalPayment = parseInt($("#totalPayment").val());

                        //ubah tampilan data awal sesuaikan dengan kalkulasi
                        totalItem += quantity;
                        totalPrice += quantity * data.price;
                        totalPayment += quantity * data.price;
                        $("#totalItem").val(totalItem);
                        $("#totalPrice").val(totalPrice);
                        $("#totalPayment").val(totalPayment);

                        let totalDisc = 0;

                        if (url == "salesorder") {
                            // //ambil percent diskon mebel
                            // const percent = hitungDiskon("#discountMeuble");
                            // //hitung total diskon mebel
                            // const discountVal = parseFloat(
                            //     (data.price * percent).toFixed(2)
                            // );
                            // totalDisc = discountVal * quantity;
                            // //ambil total diskon lama
                            // let oldTotalDisc = parseInt($("#totalDisc").val());
                            // //hitung total diskon baru
                            // let newTotalDisc = oldTotalDisc + totalDisc;
                            // //ubah total diskon dengan yang baru
                            // $("#totalDisc").val(newTotalDisc);
                            // //ubah total payment yang baru
                            // let totalPrice = parseInt($("#totalPrice").val());
                            // $("#totalPayment").val(totalPrice - newTotalDisc);

                            if (data.stock < quantity) {
                                alert(
                                    "Insufficient stock " +
                                        $("#modelType").val() +
                                        ". You can still continue the process if stock is planned."
                                );
                            }
                        }

                        //Buat tag template HTML
                        const tag_html = /*html*/ `
                        <div id="${data.modelType}">
                            <input type="hidden" id="model-${
                                data.modelType
                            }" value="${data.modelType}">
                            <input type="hidden" id="price-${
                                data.modelType
                            }" value="${data.price}"> 
                            <input type="hidden" id="quantity-${
                                data.modelType
                            }" value="${quantity}">

                            ${
                                url == "salesorder"
                                    ? `<input type="hidden" id="discMeuble-${data.modelType}" value="${totalDisc}">`
                                    : ""
                            }

                            <div class="row pt-3" >
                                <div class="col-12 col-md-3">
                                    <img id="${
                                        data.modelType
                                    }-img" class="card-img-top" src="${baseURL}${
                            data.image
                        }" alt="Card image cap">
                                </div>
                                <div class="col-12 col-md-9 pt-4">
                                    <h3 class="font-weight-bold">${
                                        data.modelType
                                    }</h3>Rp ${data.price},00
                                    <p class="font-weight-bold dataQuantity">Ammount: ${quantity}</p>
                                    ${
                                        url == "salesorder"
                                            ? `<p class="font-weight-bold dataDiscountMeuble">Discount: ${totalDisc}</p>`
                                            : ""
                                    }
                                    <p class="font-weight-bold">Color: ${
                                        data.color
                                    }</p>
                                    <p class="font-weight-bold">Size: ${
                                        data.size
                                    }</p>
                                    <p class="font-weight-bold">Description: ${
                                        data.description
                                    }.</p>
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
                    }
                } else {
                    alert(
                        `Model ${$("#modelType").val()} from vendor ${$(
                            "#vendor"
                        ).val()} doesn't exist!`
                    );
                    $("#modelType").val(null);
                    $("#price").val(0);
                }
            },
        });
    } else {
        alert("Line Item form must be filled");
    }
});

//remove item PO dan SO (fix)
$("#lineItem").on("click", ".removeItem", function () {
    url = getURL();
    //simpan element yang akan di remove
    const element = $(this).parent().parent().parent();

    //ambil data yang dibutuhkan
    const model = element.attr("id");
    const quantity = parseInt($(`#quantity-${model}`).val());
    const price = parseInt($(`#price-${model}`).val());

    //ambil data awal dari total item, total payment, dan total price yang ada di header
    const totalItem = parseInt($("#totalItem").val());
    const totalPrice = parseInt($("#totalPrice").val());
    const totalPayment = parseInt($("#totalPayment").val());

    // kalkulasi hasil perubahan berdasarkan update
    const newTotalItem = totalItem - quantity;
    const newTotalPrice = totalPrice - quantity * price;
    let newTotalPayment;

    // ubah tampilan data
    $("#totalItem").val(newTotalItem);
    $("#totalPrice").val(newTotalPrice);

    if (url == "salesorder") {
        console.log("--Debug--"); //////////////////////////////////////////////////////////
        //ambil diskon mebel yang akan diremove
        let discount = $(`#${model} .dataDiscountMeuble`).html();
        discount = parseInt(discount.split(":")[1].trim());
        //ambil total diskon, kalkulasi hasil update, lalu tampilkan
        let totalDisc = parseInt($("#totalDisc").val());
        console.log("Total Diskon saat ini: " + totalDisc); ///////////////////////////////////////
        totalDisc = totalDisc - discount;
        $("#totalDisc").val(totalDisc);
        //ubah totalPayment dengan mengurangi totalPayment - (harga normal - diskon mebel)
        newTotalPayment = totalPayment - (quantity * price - discount);

        console.log("Diskon Mebel: " + discount);
        console.log("Total Diskon perubahan: " + totalDisc);
        console.log("Total Payment Lama: " + $("#totalPayment").val());
        console.log("Total Payment Perubahan: " + newTotalPayment);
    } else {
        newTotalPayment = totalPayment - quantity * price;
    }

    $("#totalPayment").val(newTotalPayment);
    //hapus item dari list item
    element.remove();
});

//ketika edit di list item diklik saat create PO (fix)
$("#lineItem").on("click", ".editItem", function () {
    //ambil data dari tombol ini yang di klik
    const model = $(this).parent().parent().parent().attr("id");
    const quantity = parseInt($(`#quantity-${model}`).val());
    const price = parseInt($(`#price-${model}`).val());

    //pasang value lama ke field edit
    $("#modelType").val(model);
    $("#quantity").val(quantity);
    $("#price").val(price);

    //disabled si model type
    $("#modelType").attr("disabled", true);
    //ubah tombol add jadi update
    $("#addItem").attr("id", "changeItem").html("Change");
    //hilangkan select discount meuble
    // $("#discountMeuble").attr('disabled',true);
});

//update list item PO dan SO (fix)
$("#lineHeader").on("click", "#changeItem", function () {
    //ambil value baru dari field
    const model = $("#modelType").val();
    const quantity = parseInt($("#quantity").val());
    const price = parseInt($("#price").val());

    //ambil data awal dari total item, total payment, dan total price yang ada di header
    const totalPayment = parseInt($("#totalPayment").val());
    const totalItem = parseInt($("#totalItem").val());
    const totalPrice = parseInt($("#totalPrice").val());

    //ambil data lama sebelum perubahan
    const old_quantity = parseInt($(`#quantity-${model}`).val());

    //kalkulasi hasil perubahan berdasarkan update
    const newTotalItem = totalItem - old_quantity + quantity;
    const newTotalPrice = totalPrice - old_quantity * price + quantity * price;
    const newTotalPayment = totalPayment - totalPrice + newTotalPrice;

    //ubah tampilan data
    $("#totalItem").val(newTotalItem);
    $("#totalPrice").val(newTotalPrice);
    $("#totalPayment").val(newTotalPayment);

    //ubah data yang ada di list item dengan hasil update
    $(`#quantity-${model}`).val(quantity);
    $(`#${model} .dataQuantity`).html("Amount: " + quantity);

    //kembalikan tombol change ke tombol add
    $("#changeItem").attr("id", "addItem").html("Add");
    $("#modelType").attr("disabled", false);

    //bersihkan kembali field input
    $("#lineHeader input").val(null);
    $("#price").val(0);
    $("#quantity").val(0);
});

// ===================================================================== Memproses PO dan SO ==============================================================================
//create new PO dan SO (fix)
$("#createTransaction").on("click", function () {
    //ambil asal url terlebih dahulu
    let url = getURL();

    if (validateForm("header")) {
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
        // const paymentDiscount = $("#discount").val();

        //ajax query ke database
        if (url == "salesorder") {
            $.ajax({
                url: "/salesorder",
                method: "post",
                data: {
                    numSO,
                    customer,
                    id,
                    date,
                    validTo,
                    totalItem,
                    totalPrice,
                    freightIn,
                    totalPayment,
                    _token: $("#ajaxInput").children()[0].getAttribute("value"),
                },
                success: () => {
                    // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
                    const item = $("#lineItem").children();
                    //ambil per baris yang ada
                    for (let i = 0; i < item.length; i++) {
                        const child = item[i];
                        const modelType = child.getAttribute("id");

                        const price = parseInt($(`#price-${modelType}`).val());
                        const quantity = parseInt(
                            $(`#quantity-${modelType}`).val()
                        );
                        // const discountMeuble = $(`#discMeuble-${modelType}`).val();

                        $.ajax({
                            url: "/salesorder/line",
                            method: "post",
                            data: {
                                numSO,
                                modelType,
                                price,
                                quantity,
                                _token: $("#ajaxInput")
                                    .children()[0]
                                    .getAttribute("value"),
                            },
                            success: () => {
                                alert("Data successfully inserted");
                                window.location.href = "/salesorder"; //? Can be better to php first?
                            },
                        });
                    }
                },
            });
        } else {
            $.ajax({
                url: `/procurement`,
                method: "post",
                data: {
                    numPo,
                    vendor,
                    id,
                    date,
                    validTo,
                    totalItem,
                    freightIn,
                    totalPrice,
                    totalDisc,
                    totalPayment,
                    _token: $("#ajaxInput").children()[0].getAttribute("value"),
                },
                success: () => {
                    // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
                    const item = $("#lineItem").children();
                    //ambil per baris yang ada
                    for (let i = 0; i < item.length; i++) {
                        const child = item[i];
                        const modelType = child.getAttribute("id");
                        const price = parseInt($(`#price-${modelType}`).val());
                        const quantity = parseInt(
                            $(`#quantity-${modelType}`).val()
                        );

                        $.ajax({
                            url: `/procurement/line`,
                            method: "post",
                            data: {
                                numPo,
                                modelType,
                                price,
                                quantity,
                                vendor,
                                _token: $("#ajaxInput")
                                    .children()[0]
                                    .getAttribute("value"),
                            },
                            success: () => {
                                alert("Data successfully inserted");
                                window.location.href = "/procurement"; //? Can be better to php first for generate flash message?
                            },
                        });
                    }
                },
            });
        }
    } else {
        alert("All field header must be filled!");
    }
});

//cancel po dan so (fix)
$("#cancel").on("click", function () {
    //ambil asal url terlebih dahulu
    let url_ajax, num, message, url_direct;

    let url = getURL();

    if (url == "salesorder") {
        num = $("#numSO").val();
        message = `Sales Order ${num} canceled`;
        url_direct = "/salesorder";
        url_ajax = `/salesorder/cancel/${num}`;
    } else {
        num = $("#numPO").val();
        message = `Purchase Order ${num} canceled`;
        url_direct = "/procurement";
        url_ajax = `/procurement/cancel/${num}`;
    }

    $.ajax({
        url: url_ajax,
        method: "patch",
        success: () => {
            alert(message);
            window.location.href = url_direct; //? Can be better to php first for generate session flash message
        },
    });
});

//update PO dan SO (fix)
$("#updateTransaction").on("click", function () {
    const result = update();
    alert("Data successfully updated");
    if (result == "salesorder") {
        window.location.href = "/salesorder"; //? Can be better to php first for generate session flash message
    }
    if (result == "procurement") {
        window.location.href = "/procurement"; //? Can be better to php first for generate session flash message
    }
});

//proceed PO SO untuk update stock meuble
$("#proceed").on("click", function () {
    const result = update();
    let ajaxProceed, ajaxMeuble;
    let employee = $("#employeeName").val();
    let id = parseInt(employee.split(":")[0]);

    if (result == "salesorder") {
        ajaxProceed = `/salesorder/proceed/${$("#numSO").val()}`;
        ajaxMeuble = "/meuble/reduce";
    }

    if (result == "procurement") {
        ajaxProceed = `/procurement/proceed/${$("#numPO").val()}`;
        ajaxMeuble = "/meuble/add";
    }

    $.ajax({
        url: ajaxProceed,
        method: "patch",
        data: {
            _token: $("#ajaxInput").children()[0].getAttribute("value"),
        },
        success: () => {
            // ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
            const item = $("#lineItem").children();
            //ambil per baris yang ada
            for (let i = 0; i < item.length; i++) {
                const child = item[i];
                const modelType = child.getAttribute("id");
                const quantity = parseInt($(`#quantity-${modelType}`).val());

                $.ajax({
                    url: ajaxMeuble,
                    method: "patch",
                    data: {
                        modelType,
                        quantity,
                        _token: $("#ajaxInput")
                            .children()[0]
                            .getAttribute("value"),
                    },
                });
            }
        },
    });

    //? Can be better with DRY
    if (result == "salesorder") {
        const freightIn = parseInt($("#freightIn").val());
        $.ajax({
            url: "/salesorder/invoice",
            method: "post",
            data: {
                numSO: $("#numSO").val(),
                id,
                freightIn,
                _token: $("#ajaxInput").children()[0].getAttribute("value"),
            },
            success: () => {
                if (freightIn != 0) {
                    if (
                        confirm(
                            "Sales Order has been processed and an invoice has been generated. Do you want to immediately create a shipment document?"
                        )
                    ) {
                        window.location.href = `/delivery/create/${$(
                            "#numSO"
                        ).val()}`;
                    } else {
                        window.location.href = "/salesorder"; //? Can be better to php first for generate session flash message
                    }
                } else {
                    alert("Sales Order has been processed");
                    window.location.href = "/salesorder"; //? Can be better to php first for generate session flash message
                }
            },
        });
    }
    if (result == "procurement") {
        //buat PO invoice
        $.ajax({
            url: "/procurement/invoice",
            method: "post",
            data: {
                numPO: $("#numPO").val(),
                id,
                _token: $("#ajaxInput").children()[0].getAttribute("value"),
            },
            success: () => {
                alert(
                    "The purchase order has been processed and an invoice has been generated!"
                );
                window.location.href = "/procurement"; //? Can be better to php first for generate session flash message
            },
        });
    }
});

//cek quantity SO apakah stock tersedia
$(".quantity-SO").on("change", function () {
    quantity();
});

//menampilkan field yang harus diisi ketika claim warranty
$(".warranty").on("click", function () {
    const html = /*html*/ `
    <div class="form-group row">
        <label for="quantity"
            class="col-md-3 col-form-label font-weight-bold m-1">Quantity :</label>
        <div class="col-md-4">
            <input type="number"
                class="form-control line-field-form quantity-warranty"
                name="quantity[]" placeholder="Quantity">
        </div>
    </div>
    <div class="form-group">
        <label for="information" class="font-weight-bold m-1">Information:</label>
        <textarea class="form-control" id="information" name="information[]"
            rows="3"></textarea>
    </div>`;

    if (this.checked == true) {
        $(this).parent().parent().append(html);
    } else {
        $(this).parent().next().next().remove();
        $(this).parent().next().remove();
    }
});

//mengecek apakah quantity yang di klaim melebih jumlah dari yang dipesan
$(".info-item").on("change", ".quantity-warranty", function () {
    const modelType = $(this)
        .parent()
        .parent()
        .parent()
        .parent()
        .parent()
        .attr("id");
    const quantity = $(this).val();
    const numSO = $(".heading").attr("id");

    $.ajax({
        url: "/warranty/quantity",
        dataType: "json",
        data: { numSO, quantity, modelType },
        success: (data) => {
            if (!data) {
                alert("The amount claimed exceeds the amount on the invoice");
                $(this).val(null);
            }
        },
    });
});
//Diskon
// if(url == 'salesorder'){
//     // console.log("--Debug--"); //////////////////////////////////////////////////////////
//     // //ambil diskon mebel yang akan diremove
//     // let discount = parseInt($(`#disc-${model}`).val());
//     // // let discount = $(`#${model} .dataDiscountMeuble`).html();
//     // // discount = parseInt(discount.split(":")[1].trim());
//     // //ambil total diskon, kalkulasi hasil update, lalu tampilkan
//     // let totalDisc = parseInt($("#totalDisc").val());
//     // console.log("Total Diskon saat ini: "+ totalDisc); ///////////////////////////////////////
//     // totalDisc = totalDisc - discount;
//     // $("#totalDisc").val(totalDisc)
//     // //ubah totalPayment dengan mengurangi totalPayment - (harga normal - diskon mebel)
//     // newTotalPayment = totalPayment - ((quantity*price)-discount);

//     // console.log("Diskon Mebel: "+ discount);
//     // console.log("Total Diskon perubahan: "+ totalDisc);
//     // console.log("Total Payment Lama: "+ $("#totalPayment").val());
//     // console.log("Total Payment Perubahan: "+ newTotalPayment);
// }else{
// }

// //ambil percent diskon mebel
// const percent = hitungDiskon('#discountMeuble');
// //hitung total diskon mebel
// const discountVal = parseFloat((data.price*percent).toFixed(2));
// totalDisc = discountVal*quantity;
// //ambil total diskon lama
// let oldTotalDisc = parseInt($("#totalDisc").val());
// //hitung total diskon baru
// let newTotalDisc = oldTotalDisc+totalDisc;
// //ubah total diskon dengan yang baru
// $("#totalDisc").val(newTotalDisc);
// //ubah total payment yang baru
// let totalPrice = parseInt($("#totalPrice").val());
// $("#totalPayment").val(totalPrice-newTotalDisc);

// ${url == 'salesorder' ? `<input type="hidden" id="discMeuble-${data.modelType}" value="${$("#discountMeuble").val()}">` : ''}
// ${url == 'salesorder' ? `<input type="hidden" id="disc-${data.modelType}" value="${totalDisc}">` : ''}
// ${url == 'salesorder' ? `<p class="font-weight-bold dataDiscountMeuble">Discount: ${totalDisc}</p>` : ''}

//hitung diskon payment dan Meuble untuk SO (fix)
// const hitungDiskon = (id) => {
//     const disc = $(id).val();
//     let discount = $(`.${disc}`).html().split(":");
//     let percent = parseFloat(discount[1]);
//     return percent;
// }

// //prosedur untuk mengubah total diskon payment
// const hitungDiskonTotalPayment = () => {
//     const disc = hitungDiskon('#discount');                         //ambil percent diskon payment
//     let totalPayment = parseInt($("#totalPayment").val());          //ambil total payment yang lama
//     let discValue = parseFloat((totalPayment*disc).toFixed(2));     //hitung besaran diskon payment saat ini
//     let totalDisc = parseInt($("#totalDisc").val());                //ambil total disc yang lama
//     totalDisc = totalDisc + discValue;                              //kalkulasi total discount yang baru
//     $("#totalDisc").val(totalDisc);                                 //ubah tampilan dengan hasil baru
//     totalPayment = totalPayment - discValue;                        //kurangi total payment lama dengan discount baru
//     $("#totalPayment").val(totalPayment);                           //ubah value total Payment setelah dikurangi diskon
// }

// //mengambil nilai discount dari header SO (fix)
// $('#discount').on('change', function(){
//     $(this).attr('disabled',true);                                  //disabled select option
//     hitungDiskonTotalPayment();
// });
