<html>
<head>
  <style>
    /*style mở ra một khu vực để viết mã CSS*/
    .main {
      background: lightblue;
      max-width: 700px;
      margin: 0 auto;
      padding: 20px;
    }

    .link {
      display: flex;
      width: fit-content;
      margin: auto;
      padding: 10px 20px;
      background-image: linear-gradient(to right, #62cdff, #62cdff, #1a5f7a, #1a5f7a);
      background-size: 300%;
      border-radius: 10px;
      color: black;
    }

    .link:hover {
      background-position: right;
      color: white;
    }

  </style>
</head>
<body>
  <div class="main">
    <h2 style="text-align: center">Chào {{ $name }}</h2>
    <p>Bạn đã đăng ký tài khoản tại hệ thống của chúng tôi</p>
    <p>Để có thể tiếp tục sử dụng cho các dịch vụ, bạn vui lòng nhấn vào nút kích hoạt ở bên dưới để kích hoạt</p>
    <a href="" class="link">Kích hoạt tài khoản</a>
  </div>
</body>
</html>
