(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#province-select").change(function () {
        let provinceId = $(this).val();
        if (provinceId) {
            // Gửi request AJAX để lấy danh sách thành phố
            $.get(
                "/api/provinces/" + provinceId + "/cities",
                function (cities) {
                    // Xóa danh sách thành phố cũ
                    $("#city-select").find(".option-city").remove();

                    // Thêm option ẩn mới với giá trị city_id của khách hàng
                    let hiddenOption = $(
                        '<option class="option-city" style="display:none">'
                    );
                    hiddenOption
                        .attr("value", "{{ $customer->city_id }}")
                        .attr("selected", "selected");
                    $("#city-select").append(hiddenOption);

                    // Thêm các option mới vào danh sách thành phố
                    $.each(cities, function (i, city) {
                        let option = $('<option class="option-city">');
                        option.attr("value", city.id).text(city.name);
                        $("#city-select").append(option);
                    });
                }
            );
        } else {
            // Nếu không chọn tỉnh, xóa danh sách thành phố
            $("#city-select").find(".option-city").remove();
        }
    });

    $(`.hamburger-menu`).on("click", function () {
        $(`.hamburger-menu`).toggleClass("change");
        $(`.menu-header`).toggleClass("menu-header-close");
    });

    $(".slide-banner").slick({
        prevArrow:
            '<button type="button" class="slick-left"><i class="fa-solid fa-caret-left"></i></button>',
        nextArrow:
            '<button type="button" class="slick-right"><i class="fa-solid fa-caret-right"></i></button>',
        pauseOnHover: false,
        autoplay: true,
        autoplaySpeed: 4000,
        fade: true,
        cssEase: "linear",
    });

    $(".slide-trademark").slick({
        prevArrow:
            '<button type="button" class="slick-left"><i class="fa-solid fa-caret-left"></i></button>',
        nextArrow:
            '<button type="button" class="slick-right"><i class="fa-solid fa-caret-right"></i></button>',
        autoplay: true,
        autoplaySpeed: 1500,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 80 ||
            document.documentElement.scrollTop > 80
        ) {
            $("header").addClass("bg-light border-bottom border-dark");
            $(".scroll-top").addClass("d-flex");
        } else {
            $("header").removeClass("bg-light border-bottom border-dark");
            $(".scroll-top").removeClass("d-flex");
        }
    }

    // $(window).on('beforeunload', function () {
    //   $(window).scrollTop(0);
    // });

    $(`.scroll-top`).on("click", function () {
        $("html, body").animate({ scrollTop: 0 }, "5000");
    });

    $(".menu-header-item li").on("click", function () {
        $(this).toggleClass("show");
    });

    const showMore = ".showMore";
    const card = ".product-card";

    if ($(showMore).length === 0) {
        $(card).css("display", "block");
    } else {
        let n = 8;
        $(card).slice(0, n).show();
        $(showMore).on("click", (e) => {
            e.preventDefault();
            $(`${card}:hidden`).slice(0, 4).slideDown();
            if ($(`${card}:hidden`).length === 0) {
                $(showMore).fadeOut("slow");
            }
            $("html,body").animate(
                {
                    scrollTop: $(`${card}:nth-child(${n + 1})`).offset().top,
                },
                1500
            );
            n = n + 4;
        });
    }

    const btnSearch = ".btn-search";
    const inputSearch = ".input-search";
    $(btnSearch).on("click", function () {
        $(inputSearch).toggleClass("search-active");
    });

    $(".list-search").hide();
    $(".input-search-ajax").keyup(function () {
        let _text = $(this).val();
        if (_text != "") {
            $.ajax({
                url:
                    window.location.origin +
                    "/api/ajax-search-product?key=" +
                    _text,
                type: "GET",
                success: function (res) {
                    let _html = "";
                    let count = 0;
                    for (let pro of res) {
                        if (count === 3) {
                            break;
                        }
                        _html += '<a href="/product/id=' + pro.id + '">';
                        _html += '<div class="card mx-2 my-2">';
                        _html += '<div class="row g-0">';
                        _html += '<div class="col-3 list-search-img">';
                        _html +=
                            '<img src="' +
                            pro.thumb +
                            '" class="img-fluid rounded-start" alt="' +
                            pro.name +
                            '">';
                        _html += "</div>";
                        _html += '<div class="col-9">';
                        _html += '<div class="card-body">';
                        _html +=
                            '<p class="card-text"><small>' +
                            pro.name +
                            "</small></p>";
                        _html += "</div>";
                        _html += "</div>";
                        _html += "</div>";
                        _html += "</div>";
                        _html += "</a>";
                        count++;
                    }
                    $(".list-search").show(200);
                    $(".list-search").html(_html);
                },
            });
        } else {
            $(".list-search").html("");
            $(".list-search").hide();
        }
    });

    $(".add-to-cart-button").click(function (e) {
        e.preventDefault(); // Ngăn chặn chuyển trang khi submit form
        let form = $(this).closest("form"); // Tìm form gần nhất
        let data = form.serialize(); // Lấy dữ liệu của form
        let quantityInput = form.find("input[name=num_product]");
        if (quantityInput.val() <= 0) {
            return;
        }
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: data,
            success: function (response) {
                if (response.success) {
                    alert("Vui lòng đăng nhập mới được thêm sản phẩm");
                } else {
                    alert("Sản phẩm không vượt quá 5 trong giỏ hàng");
                }
            },
            error: function (xhr) {
                if (xhr.status === 400) {
                    let error = JSON.parse(xhr.responseText);
                    alert(error.error);
                } else {
                    $("#addToCartModal").modal("show");
                }
            },
        });
    });

    $(".add-to-cart-form input[type=number]").on("change", function () {
        if ($(this).val() <= 0) {
            $("#addToCartModal").modal("hide");
        }
    });

    $(".btn-delete-all").on("click", function () {
        $.ajax({
            url: "/carts/delete/all",
            type: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                location.reload(); // Reload trang web
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });

    $(".btn-delete").on("click", function () {
        let productId = $(this).data("id");

        $.ajax({
            url: "/carts/" + productId,
            type: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                location.reload(); // Reload trang web
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });

    if ($("li.menu-header-shop-product").length > 0) {
        $("li.empty-product").addClass("d-none");
        $("li.menu-header-shop-bill").removeClass("d-none");
    }

    $(".nav-item.menu-header-item-menu").each(function () {
        if ($(this).find("ul.menu-drop").length) {
            $(this)
                .find("a.nav-link")
                .append("<i class='ms-2 fa-solid fa-chevron-down'></i>");
            $(this).find("ul.menu-drop i").addClass("d-none");
        }
    });

    $(".btn-qtt-minus").click(function () {
        let input = $(this).siblings('input[type="number"]');
        let val = parseInt(input.val());
        if (val > 1) {
            input.val(val - 1);
        }
    });

    $(".btn-qtt-plus").click(function () {
        let input = $(this).siblings('input[type="number"]');
        let val = parseInt(input.val());
        let max = parseInt(input.attr("max"));
        if (val < max) {
            input.val(val + 1);
        } else {
            alert("Sản phẩm không vượt quá số lượng trên hệ thống");
        }
    });

    $(".btn-quantity-minus").click(function () {
        let input = $(this).siblings('input[type="number"]');
        let val = parseInt(input.val());
        if (val > 1) {
            input.val(val - 1);
        }
    });

    $(".btn-quantity-plus").click(function () {
        let input = $(this).siblings('input[type="number"]');
        let val = parseInt(input.val());
        let max = parseInt(input.attr("max"));
        if (val < max) {
            input.val(val + 1);
        } else {
            alert("Sản phẩm không vượt quá số lượng trên hệ thống");
        }
    });

    $(".show-password").click(function () {
        let passwordInput = $('input[name="password"]');
        let passwordIcon = $(".show-password i");

        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            passwordInput.attr("type", "password");
            passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });

    $(".btn-sale").click(function () {
        let saleCode = $(this)
            .closest(".card-body")
            .find(".card-subtitle")
            .text();

        // Tạo một thẻ input ẩn
        let $tempInput = $("<input>");
        $("body").append($tempInput);

        // Đặt giá trị của thẻ input bằng mã khuyến mãi
        $tempInput.val(saleCode).select();

        // Sao chép nội dung vào clipboard
        document.execCommand("copy");

        // Xóa thẻ input
        $tempInput.remove();

        // Thông báo sao chép thành công
        alert("Đã sao chép mã: " + saleCode);
    });

    setTimeout(function () {
        $("#loading").hide();
    }, 1500);
})(jQuery);
