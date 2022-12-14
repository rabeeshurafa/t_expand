"use strict";
var tbl;
var KTAppEcommerceProducts = function () {
    console.log(window.columns)
    console.log(window.data_url)
    var t, e, o = () => {
        t.querySelectorAll('[data-kt-ecommerce-product-filter="delete_row"]').forEach((t => {
            t.addEventListener("click", (function (t) {
                t.preventDefault();
                const o = t.target.closest("tr"),
                    n = o.querySelector('[data-kt-ecommerce-product-filter="product_name"]').innerText;
                Swal.fire({
                    text: "Are you sure you want to delete " + n + "?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((function (t) {
                    t.value ? Swal.fire({
                        text: "You have deleted " + n + "!.",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {confirmButton: "btn fw-bold btn-primary"}
                    }).then((function () {
                        e.row($(o)).remove().draw()
                    })) : "cancel" === t.dismiss && Swal.fire({
                        text: n + " was not deleted.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {confirmButton: "btn fw-bold btn-primary"}
                    })
                }))
            }))
        }))
    };
    return {
        init: function () {
            (t = document.querySelector("#kt_ecommerce_products_table")) && ((tbl = $(t).DataTable({
                info: 1,
                dom: 'Bflrtip',
                processing: !0,
                serverSide: !0,
                order: [],
                bSort : true,
                ajax:window.data_url,
                columns: window.columns,
                buttons: window.buttons,
                language: {
                        "sEmptyTable":     "???????? ???????? ???????????? ?????????? ???? ????????????",
                        "sLoadingRecords": "???????? ??????????????...",
                        "sProcessing":   "???????? ??????????????...",
                        "sLengthMenu":   "???????? _MENU_ ????????????",
                        "sZeroRecords":  "???? ???????? ?????? ?????? ??????????",
                        "sInfo":         "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                        "sInfoEmpty":    "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                        "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                        "sInfoPostFix":  "",
                        "sSearch":       "????????:",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst":    "??????????",
                            "sPrevious": "????????????",
                            "sNext":     "????????????",
                            "sLast":     "????????????"
                        },
                        "oAria": {
                            "sSortAscending":  ": ?????????? ???????????? ???????????? ????????????????",
                            "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
                        }
                    },
                select: true,
            })).on("draw", (function () {
                o() /*, KTMenu.createInstances()*/
            })),/* document.querySelector('[data-kt-ecommerce-product-filter="search"]').addEventListener("keyup", (function (t) {
                tbl.search(t.target.value).draw()
            })),*/ (() => {
                const t = document.querySelector('[data-kt-ecommerce-product-filter="status"]');
                $(t).on("change", (t => {
                    let o = t.target.value;
                    "all" === o && (o = ""), tbl.column(3).search(o).draw()
                }))
            })(), o())
        }
    }
}();
// $( document ).ready(
//
//     function(){
//         console.log('hi');
//         KTAppEcommerceProducts.init();
//     }
// );
jQuery(document).ready(function () {

            KTAppEcommerceProducts.init()
        });
// KTUtil.onDOMContentLoaded((function () {
//     KTAppEcommerceProducts.init()
// }));
