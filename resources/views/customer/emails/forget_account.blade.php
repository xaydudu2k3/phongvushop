<html>
<head>
  <style>
    .main {
      background: lightcyan;
      max-width: 700px;
      margin: 0 auto;
      padding: 20px;
    }

    .link {
      text-decoration: none;
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
    <h2 style="text-align: center">Chào {{ $customer->name }}</h2>
    <p>Bạn đã xác nhận tài khoản email này để thay đổi lại mật khẩu tại hệ thống của chúng tôi</p>
    <p>Để có thể tiếp tục thay đổi mật khẩu cho tài khoản của bạn, bạn vui lòng nhấn vào nút kích hoạt ở bên dưới để thay đổi mật khẩu</p>
    <p>Chú ý: mã xác nhận trong link chi có hiệu lúc trong vòng 72 giờ</p>
    <a href="{{ route('home.getPass',['customer' => $customer->id, 'token' => $customer->token ]) }}" class="link" style="color: black">Đặt lại mật khẩu</a>
  </div>
</body>
</html>
