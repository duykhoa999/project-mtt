// var usercart = document.querySelectorAll(".usercart");
// var usercontent = document.querySelectorAll(".usercontent");

// usercart.forEach(function (el) {
//     el.addEventListener("click", openTabs);
// });


// function openTabs(el) {
//     var btn = el.currentTarget; // lắng nghe sự kiện và hiển thị các element
//     var electronic = btn.dataset.electronic; // lấy giá trị trong data-electronic

//     usercontent.forEach(function (el) {
//         el.classList.remove("active");
//     }); //lặp qua các tab content để remove class active

//     usercart.forEach(function (el) {
//         el.classList.remove("active");
//     }); //lặp qua các tab links để remove class active

//     document.querySelector("#" + electronic).classList.add("active");
//     // trả về phần tử đầu tiên có id="" được add class active

//     btn.classList.add("active");
//     // các button mà chúng ta click vào sẽ được add class active
// }
$('.usercontent:eq(0)').show();
$('.user-left .usercart').click(function () {
    /* loại bỏ class active của tất cả li */
    $('.user-left .usercart').removeClass('active');
    /* add class active của li được click */
    $(this).addClass('active');
    /* Xác định phần tử thứ n được click */
    var n = $('.user-left .usercart').index(this);
    /* Ẩn tất cả .box */
    $('.usercontent').hide();
    /* Hiển thị .box theo phần tử thứ n */
    $('.usercontent:eq(' + n + ')').fadeIn(300);
});