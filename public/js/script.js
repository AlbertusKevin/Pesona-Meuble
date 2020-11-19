/* Header:
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

Line Item:
const modelType = $("#modelType").val();
const meubleName = $("#meubleName").val();
const category = $("#category").val();
const size = $("#size").val();
const color = $("#color").val();
const image = $("#image").val();
const description = $("#description").val();
const warranty = $("#warranty").val();
const price = $("#price").val();
const quantity = $("#quantity").val();
*/

//additem
//tombol diklik
    //ambil semua field yang ada di line header
    //tampilkan kedalam html



const baseURL = "localhost:8000";


$("#addItem").on("click", function (){
    //ambil data yang ada di bagian field Header Line
    const modelType = $("#modelType").val();
    const meubleName = $("#meubleName").val();
    const category = $("#category").val();
    const size = $("#size").val();
    const color = $("#color").val();
    const image = $("#image").val();
    const description = $("#description").val();
    const warranty = $("#warranty").val();
    const price = parseInt($("#price").val());
    const quantity = parseInt($("#quantity").val());

    //setelah klik add, bersihkan field input
    $("#lineHeader input,textarea").val(null);

    //ambil data awal dari total item dan total price yang ada di header
    let totalItem =  parseInt($("#totalItem").val());
    let totalPrice = parseInt($("#totalPrice").val());
    totalItem += quantity;
    totalPrice += quantity*price;

    $("#totalItem").val(totalItem);
    $("#totalPrice").val(totalPrice);
    $("#totalPayment").val(totalPrice-parseInt($("#totalDisc").val()));

    const tag_html = `
        <div id="${modelType}">
            <div class="row pt-3" >
                <!-- <div class="col-12 col-md-3"><img class="card-img-top" src="{{ asset('images/syntherine.svg') }}" alt="Card image cap"></div> -->
                <div class="col-12 col-md-9 pt-4">
                    <h3 class="font-weight-bold">${modelType}</h3>Rp ${price},00
                    <p class="font-weight-bold">Ammount: ${quantity}</p>
                    <p class="font-weight-bold">Category: ${category}</p>
                    <p class="font-weight-bold">Color: ${color}</p>
                    <p class="font-weight-bold">Size: ${size}</p>
                    <p class="font-weight-bold">Description: ${description}.</p>
                </div>
            </div>
        </div>
    `;
    $("#lineItem").append(tag_html);
});
// INSERT INTO t(dob) VALUES(TO_DATE('17/12/2015', 'DD/MM/YYYY'));

// $.ajax({
//     url: `${baseURL}/post/like_post/${$(this).data("id")}/${$(this).data("username")}`,
//     success: () => {
//       $(this).removeClass("like").addClass("unlike");
//       $(this).children("img").attr("src", `${baseURL}/assets/images/mdi_thumb-up.svg`);
//     },
// });