<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Google Font: Source Sans Pro -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css" />
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/sharp-solid.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.3.0/css/sharp-regular.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="/admin/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/admin/dist/css/adminlte.min.css">
<link rel="stylesheet" href="/admin/dist/css/loginadmin.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="/template/vendor/Chart.js/Chart.min.js"></script>
<style>
    .btn {
        transition: 0.3s;
    }

    .active-sidebar {
        /* border-radius: 50px 0 0 50px !important; */
        /* background: #DFFFD8 !important; */
        background: #F1F6F9 !important;
        color: black !important;
        position: relative !important;
        margin-right: -8px !important;
    }

    /* .active-sidebar::before{
      content: ''!important;
      position: absolute!important;
      background: #06283D!important;
      right: -8px!important;
      width: 15px!important;
      height: 15px!important;
      top:-15px!important;
      border-bottom-right-radius: 15px!important;
      box-shadow: 15px 15px 0 15px #DFFFD8 !important;
    }
    .active-sidebar::after{
      content: ''!important;
      position: absolute!important;
      background: #06283D!important;
      right: -8px!important;
      width: 15px!important;
      height: 15px!important;
      bottom:-15px!important;
      border-top-right-radius: 15px!important;
      box-shadow: 15px -15px 0 15px #DFFFD8 !important;
    } */
</style>
