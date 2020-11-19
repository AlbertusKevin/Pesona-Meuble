const baseURL = "http://localhost:8000";

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

$("#addItem").on("click", function (){
    //ambil data yang ada di bagian field Line Header
    const modelType = $("#modelType").val();
    const meubleName = $("#meubleName").val();
    const category = $("#category").val();
    const size = $("#size").val();
    const color = $("#color").val();
    const description = $("#description").val();
    const warranty = parseInt($("#warranty").val());
    const price = parseInt($("#price").val());
    const quantity = parseInt($("#quantity").val());
    
    //setelah klik add, bersihkan field input
    $("#lineHeader input,textarea").val(null);
    
    //ambil data awal dari total item dan total price yang ada di header
    let totalItem =  parseInt($("#totalItem").val());
    let totalPrice = parseInt($("#totalPrice").val());
    let freightIn = parseInt($("#freightIn").val());
    
    //ubah tampilan data awal sesuaikan dengan kalkulasi
    totalItem += quantity;
    totalPrice += quantity*price + freightIn;
    
    $("#totalItem").val(totalItem);
    $("#totalPrice").val(totalPrice);
    $("#totalPayment").val(totalPrice-parseInt($("#totalDisc").val()));
    
    //Buat tag template HTML
    const tag_html = `
        <div id="${modelType}"
            data-model="${modelType}"
            data-meubleName="${meubleName}" 
            data-price="${price}" 
            data-quantity="${quantity}" 
            data-category="${category}" 
            data-warranty="${warranty}"
            data-color="${color}" 
            data-size="${size}" 
            data-description="${description}">
            <div class="row pt-3" >
                <div class="col-12 col-md-3">
                    <img id="${modelType}-img" class="card-img-top" src="" alt="Card image cap">
                </div>
                <div class="col-12 col-md-9 pt-4">
                    <h3 class="font-weight-bold">${modelType}</h3>Rp ${price},00
                    <p class="font-weight-bold">Ammount: ${quantity}</p>
                    <p class="font-weight-bold">Color: ${color}</p>
                    <p class="font-weight-bold">Size: ${size}</p>
                    <p class="font-weight-bold">Description: ${description}.</p>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="${modelType}-img-input" name="${modelType}-img" onchange="previewImg('${modelType}-img-input','${modelType}-img');">
                    </div>
                </div>
            </div>
        </div>
    `;

    //tambahkan item ke daftar purchase order
    $("#lineItem").append(tag_html);
});

$("#createPO").on("click",function(){
    //ambil semua data di header
    const numPo = $("#numPO").val();
    const vendor = $("#vendor").val();
    const employeeName = $("#employeeName").val();
    const date = $("#date").val();
    const validTo = $("#validTo").val();
    const totalItem = $("#totalItem").val();
    const freightIn = $("#freightIn").val();
    const totalPrice = $("#totalPrice").val();
    const totalDisc = $("#totalDisc").val();
    const totalPayment = $("#totalPayment").val();
    const employee = $("#employee").data("id");

    //ambil data per list barang, lalu lakukan query insert ke database purchase_order_line
    const item = $("#lineItem").children();
    
    //ajax query ke database purchase_order
    $.ajax({
        url: `${baseURL}/procurement/create/header/${employee}`,
        method: "post",
        // dataType: "json",
        data: {numPo, vendor, employeeName, date, validTo, totalItem, freightIn, totalPrice, totalDisc, totalPayment, _token: $("#ajaxInput").children()[0].getAttribute("value")},
        success: (data) => {
            console.log(data);
        }
    });

    //ambil per baris yang ada
    // for(let i = 0; i < item.length; i++){
    //     const child = item[i];
        
    //     const modelType = child.getAttribute("data-model");
    //     const meubleName = child.getAttribute("data-meubleName");
    //     const category = child.getAttribute("data-category");
    //     const size = child.getAttribute("data-size");
    //     const color = child.getAttribute("data-color");
    //     const description = child.getAttribute("data-description");
    //     const warranty = parseInt(child.getAttribute("data-warranty"));
    //     const price = parseInt(child.getAttribute("data-price"));
    //     const quantity = parseInt(child.getAttribute("data-quantity"));

    //     $.ajax({
    //         url: `${baseURL}/procurement/create/${employee}`,
    //         method: "POST",
    //         dataType: "json",
    //         data: {}
    //     });
    // }
})
    // INSERT INTO t(dob) VALUES(TO_DATE('17/12/2015', 'DD/MM/YYYY'));
    
    // $.ajax({
        //     url: `${baseURL}/post/like_post/${$(this).data("id")}/${$(this).data("username")}`,
        //     success: () => {
            //       $(this).removeClass("like").addClass("unlike");
            //       $(this).children("img").attr("src", `${baseURL}/assets/images/mdi_thumb-up.svg`);
            //     },
            // });