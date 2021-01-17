/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */
const baseURL = "http://localhost:8000/";

//! ============================================================================================================
//? ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ UTILITIES GROUP FUNCTION ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//! ============================================================================================================
//? -------------------------------------------------------------------------------
// Ambil asal url yang melakukan request ajax
// digunakan untuk sales order dan procurement
//? -------------------------------------------------------------------------------
const getURL = () => window.location.href.split("/")[3];

//? -------------------------------------------------------------------------------
// Validasi memastikan form header tidak ada yang kosong ketika create
// form header line tidak ada yang kosong ketika add new item ke list
//? -------------------------------------------------------------------------------
const validateForm = (type) => {
    let isValid = true;

    $(`.${type}-field-form`).each(function () {
        if ($(this).val() === "") {
            isValid = false;
        }
    });
    return isValid;
};

//? -------------------------------------------------------------------------------
// Melakukan update data ketika update sales order atau purchase order
// Update juga ketika proceed sales order atau purchase order
//? -------------------------------------------------------------------------------
const update = function () {
    //ambil asal url terlebih dahulu
    let url = getURL();

    if (validateForm("header")) {
        const totalItem = $("#totalItem").val();
        const totalPrice = $("#totalPrice").val();
        const totalPayment = $("#totalPayment").val();

        if (url == "salesorder") {
            const numSO = $("#numSO").val();
            const totalDisc = parseInt($("#totalDisc").val());
            $.ajax({
                url: "/salesorder",
                method: "patch",
                data: {
                    numSO,
                    totalItem,
                    totalPrice,
                    totalPayment,
                    totalDisc,
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
                                const discountMeuble = $(
                                    `#discCode-${modelType}`
                                );
                                $.ajax({
                                    url: "/salesorder/line",
                                    method: "post",
                                    data: {
                                        numSO,
                                        modelType,
                                        price,
                                        quantity,
                                        discountMeuble,
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
            const numPo = $("#numPO").val();
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

//? -------------------------------------------------------------------------------
// Cek quantity yang dipesan saat sales order dengan stok yang ada
//? -------------------------------------------------------------------------------
const checkQuantity = (stock, quantity, message) => {
    if (stock < quantity) {
        alert(message);
        return false;
    }

    return true;
};

//? -------------------------------------------------------------------------------
// Mengambil besaran percent diskon dari kode diskon
//? -------------------------------------------------------------------------------
const getDiscount = (id, index) =>
    $(`.${$(id).val()}`)
        .html()
        .split(":")[index];

//? -------------------------------------------------------------------------------
// Cek apakah data yang ingin ditambahkan ada di prodcut list
// Saat add item, create dan update sales order dan purchase order
//? -------------------------------------------------------------------------------
const isInProductList = (data) => {
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

    return found;
};
//! ============================================================================================================
//? ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ GENERATE DATA FORM ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//! ============================================================================================================
//? -------------------------------------------------------------------------------
// Generate data meuble sesuai dengan vendor yang dipilih untuk procurement.
// Generate data meuble dari vendor apapun untuk sales order
//? -------------------------------------------------------------------------------
$("#modelType").on("change", function () {
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
                console.log(url);
                if (url == "procurement") {
                    if (data.price <= 100000) {
                        $("#price").val(data.price - 10000);
                    } else if (data.price <= 300000) {
                        $("#price").val(data.price - 50000);
                    } else if (data.price <= 1000000) {
                        $("#price").val(data.price - 150000);
                    } else if (data.price <= 5000000) {
                        $("#price").val(data.price - 300000);
                    } else if (data.price <= 10000000) {
                        $("#price").val(data.price - 450000);
                    } else {
                        $("#price").val(data.price - 600000);
                    }
                } else {
                    $("#price").val(data.price);
                }

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
                if (url == "procurement") {
                    alert(
                        `Model ${$("#modelType").val()} from vendor ${$(
                            "#vendor"
                        ).val()} doesn't exist!`
                    );
                } else {
                    alert(`Model ${$("#modelType").val()} doesn't exist!`);
                }

                $("#modelType").val(null);
                $("#price").val(0);
            }
        },
    });
});

//? -------------------------------------------------------------------------------
// Generate data customer yang sudah terdaftar ketika membuat sales order
//? -------------------------------------------------------------------------------
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

//! ============================================================================================================
//? ~~~~~~~~~~~~~ BIAYA OPERASIONAL (Diskon, Freight In): SALES ORDER DAN PURCHASE ORDER ~~~~~~~~~~~~~~~~~~~~~~~
//! ============================================================================================================
//? -------------------------------------------------------------------------------
// Generate data customer yang sudah terdaftar ketika membuat sales order
//? -------------------------------------------------------------------------------
$("#freightIn").keypress(function (e) {
    if (e.which == 13) {
        let oldFreightIn = parseInt($("#oldfreightIn").val());
        let totalPayment = parseInt($("#totalPayment").val());

        let total = parseInt(totalPayment - oldFreightIn);
        let freightIn = parseInt($(this).val());

        if (isNaN(freightIn) || freightIn == null) {
            freightIn = 0;
        }

        // the enter key code
        totalPayment = total + freightIn;
        $("#totalPayment").val(totalPayment);

        $("#oldfreightIn").val(freightIn);
    }
});

//? -------------------------------------------------------------------------------
// Ambil diskon yang diinput ketika membuat purchase order
//? -------------------------------------------------------------------------------
$("#totalDisc").keypress(function (e) {
    if (e.which == 13) {
        // ambil value lama dan ambil total payment saat ini
        let oldDiscount = parseInt($("#oldDiscount").val());
        let totalPayment = parseInt($("#totalPayment").val());

        let total = parseInt(totalPayment + oldDiscount);
        let discount = parseInt($(this).val());

        if (isNaN(discount) || discount == null) {
            discount = 0;
        }

        // the enter key code
        totalPayment = total - discount;
        $("#totalPayment").val(totalPayment);

        $("#oldDiscount").val(discount);
    }
});
//! ============================================================================================================
//? ~~~~~~~~~~~~~~~~~~~~~~~~~~~ ADD, REMOVE, EDIT (ITEM) SALES ORDER DAN PROCUREMENT ~~~~~~~~~~~~~~~~~~~~~~~~~~~
//! ============================================================================================================
//? -------------------------------------------------------------------------------
// Add item ketika create dan update sales order dan purchase order
//? -------------------------------------------------------------------------------
$("#lineHeader").on("click", "#addItem", function () {
    if (validateForm("line")) {
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
                    let found = isInProductList(data);

                    if (found) {
                        alert("Data Already Exist in Product List!");
                        $("#quantity").val(0);
                        $("#modelType").val(null);
                        $("#price").val(0);
                    } else {
                        let totalItem = parseInt($("#totalItem").val());
                        let totalPrice = parseInt($("#totalPrice").val());
                        let totalPayment = parseInt($("#totalPayment").val());
                        let quantity = parseInt($("#quantity").val());
                        let price = parseInt($("#price").val());

                        //ubah tampilan data awal sesuaikan dengan kalkulasi
                        totalItem += quantity;
                        totalPrice += quantity * price;
                        $("#totalItem").val(totalItem);
                        $("#totalPrice").val(totalPrice);

                        let discountHidden = "";
                        let infoDiscount = "";

                        if (url == "salesorder") {
                            let message =
                                "Insufficient stock " +
                                $("#modelType").val() +
                                ". You can still continue the process if stock is planned.";
                            checkQuantity(data.stock, quantity, message);
                            //ambil value kode dan persen diskon meuble
                            const discCode = getDiscount(
                                "#discountMeuble",
                                0
                            ).trim();
                            const discPercent = parseFloat(
                                getDiscount("#discountMeuble", 1)
                            );

                            // ambil harga setelah quantity * harga barang
                            let sumPrice = quantity * price;
                            // hitung harga diskon
                            let discountMeuble = sumPrice * discPercent;
                            // hitung jumlah yang harus dibayarkan dari meuble tersebut
                            let paymentPrice = sumPrice - discountMeuble;

                            // ambil total discount
                            let totalDisc = parseInt($("#totalDisc").val());
                            // ambil total payment
                            let totalPayment = parseInt(
                                $("#totalPayment").val()
                            );

                            //update total discount
                            totalDisc = totalDisc + discountMeuble;
                            //update total payment
                            totalPayment = totalPayment + paymentPrice;

                            $("#totalDisc").val(totalDisc);
                            $("#totalPayment").val(totalPayment);
                            discountHidden =
                                /*html*/
                                `<input type="hidden" id="discCode-${data.modelType}" value="${discCode}">
                                <input type="hidden" id="discValue-${data.modelType}" value="${discPercent}">`;
                            infoDiscount = /*html */ `
                            <p class="font-weight-bold discount-value">Discount: Rp ${discountMeuble.toLocaleString(
                                "en"
                            )},00 (${discPercent * 100}%)</p>
                            `;
                        } else {
                            totalPayment += quantity * price;
                            $("#totalPayment").val(totalPayment);
                        }

                        //Buat tag template HTML
                        const tag_html = /*html*/ `
                        <div id="${data.modelType}">
                        <div class="card-body">
                            <div class="row pt-3" >
                            <input type="hidden" id="model-${
                                data.modelType
                            }" value="${data.modelType}">
                            <input type="hidden" id="price-${
                                data.modelType
                            }" value="${price}"> 
                            <input type="hidden" id="quantity-${
                                data.modelType
                            }" value="${quantity}">
                            ${discountHidden}
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
                                        }</h3>Rp ${price.toLocaleString(
                            "en"
                        )},00
                                        <p class="font-weight-bold dataQuantity">Ammount: ${quantity}</p>
                                        ${infoDiscount}
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

//? -------------------------------------------------------------------------------
// Remove item ketika create dan update sales order dan purchase order
//? -------------------------------------------------------------------------------
$("#lineItem").on("click", ".removeItem", function () {
    url = getURL();
    //simpan element yang akan di remove
    const element = $(this).parent().parent().parent().parent();

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
        //ambil diskon mebel yang akan diremove
        let percentDiscount = parseFloat($(`#discValue-${model}`).val());
        let normalPrice = quantity * price;
        let discountValue = normalPrice * percentDiscount;
        let discountPrice = normalPrice - discountValue;

        //ambil total diskon, kalkulasi hasil update, lalu tampilkan
        let totalDisc = parseInt($("#totalDisc").val());
        totalDisc = totalDisc - discountValue;
        $("#totalDisc").val(totalDisc);

        //ubah totalPayment dengan mengurangi totalPayment - (harga normal - diskon mebel)
        newTotalPayment = totalPayment - discountPrice;
    } else {
        newTotalPayment = totalPayment - quantity * price;
    }

    $("#totalPayment").val(newTotalPayment);
    //hapus item dari list item
    console.log(element);
    element.remove();

    if (url == "procurement") {
        let item = $("#lineItem").children();
        if (item.length == 0) {
            $("#vendor").removeAttr("disabled");
        }
    }
});

//? -------------------------------------------------------------------------------
// Ambil data item dari list untuk diisikan ke form line item
// Ketika create dan update sales order dan purchase order
//? -------------------------------------------------------------------------------
$("#lineItem").on("click", ".editItem", function () {
    //ambil data dari tombol ini yang di klik
    const model = $(this).parent().parent().parent().parent().attr("id");
    const quantity = parseInt($(`#quantity-${model}`).val());
    const price = parseInt($(`#price-${model}`).val());
    const discCode = $(`#discCode-${model}`).val();

    //pasang value lama ke field edit
    $("#modelType").val(model);
    $("#quantity").val(quantity);
    $("#price").val(price);
    $("#discountMeuble").val(discCode);

    //disabled si model type
    $("#modelType").attr("disabled", true);
    //ubah tombol add jadi update
    $("#addItem").attr("id", "changeItem").html("Change");
});

//? -------------------------------------------------------------------------------
// Update item berdasarkan data yang diubah di form line item
// Ketika create dan update sales order dan purchase order
//? -------------------------------------------------------------------------------
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
    let newTotalPayment;

    if (getURL() == "salesorder") {
        // ambil discount yang baru
        const discountCode = getDiscount("#discountMeuble", 0).trim();
        const discountPercent = parseFloat(getDiscount("#discountMeuble", 1));
        const newNormalPrice = quantity * price;
        const newDiscountValue = newNormalPrice * discountPercent;
        const newDiscountPrice = newNormalPrice - newDiscountValue;

        //ambil diskon mebel yang lama
        let oldPercentDiscount = parseFloat($(`#discValue-${model}`).val());
        let oldNormalPrice = old_quantity * price;
        let oldDiscountValue = oldNormalPrice * oldPercentDiscount;
        let oldDiscountPrice = oldNormalPrice - oldDiscountValue;

        //ambil total diskon, kalkulasi hasil update, lalu tampilkan
        let totalDisc = parseInt($("#totalDisc").val());
        totalDisc = totalDisc - oldDiscountValue + newDiscountValue;
        $("#totalDisc").val(totalDisc);

        //ubah totalPayment
        newTotalPayment = totalPayment - oldDiscountPrice + newDiscountPrice;

        // ubah tampilan di list data
        $(`#discValue-${model}`).val(discountPercent);
        $(`#discCode-${model}`).val(discountCode);
        $(`#${model} .discount-value`).html(
            `Discount: Rp ${newDiscountValue.toLocaleString("en")},00 (${
                discountPercent * 10
            }%)`
        );
    } else {
        newTotalPayment = totalPayment - totalPrice + newTotalPrice;
    }

    //ubah tampilan data di form header
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
//! ============================================================================================================
//? ~~~~~~~~~~~~~~~~~~~~ NEW, PROCEED, CANCEL (Document) SALES ORDER DAN PURCHASE ORDER ~~~~~~~~~~~~~~~~~~~~~~~~
//! ============================================================================================================
//? -------------------------------------------------------------------------------
// Buat Sales Order dan Purchase Order, insert ke database
//? -------------------------------------------------------------------------------
$("#createTransaction").on("click", function () {
    if (validateForm("header")) {
        const date = $("#date").val();
        const validTo = $("#validTo").val();
        const totalItem = $("#totalItem").val();
        const freightIn = $("#freightIn").val();
        const totalPrice = $("#totalPrice").val();
        const totalPayment = $("#totalPayment").val();
        let employee = $("#employeeName").val();
        let id = parseInt(employee.split(":")[0]);

        if (getURL() == "salesorder") {
            const numSO = $("#numSO").val();
            const customer = $("#customer").val();
            const totalDisc = parseInt($("#totalDisc").val());

            $.ajax({
                url: "/salesorder",
                method: "post",
                data: {
                    numSO,
                    customer,
                    totalDisc,
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
                        const discountMeuble = $(
                            `#discCode-${modelType}`
                        ).val();

                        $.ajax({
                            url: "/salesorder/line",
                            method: "post",
                            data: {
                                numSO,
                                modelType,
                                price,
                                quantity,
                                discountMeuble,
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
            const numPo = $("#numPO").val();
            const vendor = $("#vendor").val();
            const totalDisc = $("#totalDisc").val();

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

//? -------------------------------------------------------------------------------
// Membatalkan transaksi Sales Order dan Purchase Order
//? -------------------------------------------------------------------------------
$("#cancel").on("click", function () {
    //ambil asal url terlebih dahulu
    let url_ajax, num, message, url_direct;

    if (getURL() == "salesorder") {
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

//? -------------------------------------------------------------------------------
// Memproses lanjjut Sales Order dan Purchase Order
//? -------------------------------------------------------------------------------
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

//? -------------------------------------------------------------------------------
// Update data, line item dan header Sales Order dan Purchase Order
//? -------------------------------------------------------------------------------
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

//cek quantity SO apakah stock tersedia
$(".quantity-SO").on("change", function () {
    const model = $("#modelType").val();
    const quantity = $("#quantity").val();

    let url = getURL();

    if (url == "salesorder") {
        $.ajax({
            url: `/meuble/search`,
            data: {
                model,
                source_url: url,
            },
            dataType: "json",
            success: (data) => {
                if (data) {
                    let message = "Insufficient stock " + model;
                    checkQuantity(data.stock, quantity, message);
                }
            },
        });
    }
});

//! ============================================================================================================
//? ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ KLAIM GARANSI ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//! ============================================================================================================
//? -------------------------------------------------------------------------------
// Menampilkan field form data yang harus diisi ketika klaim garansi
//? -------------------------------------------------------------------------------
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

//? -------------------------------------------------------------------------------
// Mengecek apakah quantity yang di klaim melebih jumlah dari yang dipesan
//? -------------------------------------------------------------------------------
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
