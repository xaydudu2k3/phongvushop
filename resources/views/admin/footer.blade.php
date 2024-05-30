<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<!-- jQuery -->

<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->

<!-- ChartJS -->
<script src="/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/admin/plugins/moment/moment.min.js"></script>
<script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin/dist/js/pages/dashboard.js"></script>
<script src="/admin/dist/js/main.js"></script>

<script>
    $(document).ready(function() {
        $(".avatar").on("click", function() {
            $(this).toggleClass("show")
        });
    });
</script>

<script>
    $('.button').on('click', function() {
        $('.login').addClass('loading').delay(2200).queue(function() {
            $(this).addClass('active')
        });
    });
</script>

<script>
    $(".inpw").on("click", function() {
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
            $(this).html("<i class='fa-regular fa-eye'></i>").prev("input").attr("type", "text");
        } else {
            $(this).html("<i class='fa-regular fa-eye-slash'></i>").prev("input").attr("type", "password");
        }
    });
</script>

<script>
    $('input[type="search"]').attr('autocomplete', 'off');
</script>

<script>
    window.addEventListener('beforeunload', function(event) {
        // Gọi API đăng xuất trong Laravel
        axios.post('/logout').then(response => {
            console.log(response);
        }).catch(error => {
            console.log(error);
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"
    integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#search-user').typeahead({
        source: function(query, process) {
            return $.get('{{ route('admin.users.search') }}', {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    $('#search-producttype').typeahead({
        source: function(query, process) {
            return $.get('{{ route('admin.producttypes.search') }}', {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    $('#search-sale').typeahead({
        source: function(query, process) {
            return $.get('{{ route('admin.sales.search') }}', {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    $('#search-trademark').typeahead({
        source: function(query, process) {
            return $.get('{{ route('admin.trademarks.search') }}', {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    $('#search-product').typeahead({
        source: function(query, process) {
            return $.get('{{ route('admin.products.search') }}', {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });
</script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $("#datepicker").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"]
    });
    $("#datepicker2").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"]
    });
</script>
@yield('footer')
