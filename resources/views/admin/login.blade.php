<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<body>
    <div id="loading"><span class="loader"></span></div>
    <section class="login-admin">
        <div class="form-box">
            <div class="form-value">
                <form action="/admin/login/store" method="post" class="form-admin">
                    <h2>Admin Login</h2>
                    @include('admin.alert')
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="email" required autocomplete="off">
                        <label>Email</label>
                    </div>
                    <div class="inputbox" id="password-show">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required autocomplete="off">
                        <label>Password</label>
                        <div class="show-password text-white"
                            style="position: absolute; cursor: pointer; ; right: 38px; bottom: 6px;">
                            <i class="fa-regular fa-eye-slash"></i>
                        </div>
                    </div>
                    <div class="forget">
                        <label>Remember Me
                            <input type="checkbox" name="remember_token">
                            <span class="checkmark"></span>
                        </label>
                        {{-- <a href="#">Forget Password</a> --}}
                    </div>
                    <button type="submit" class="submit-admin">Log in</button>
                    {{-- <div class="register">
            <p>Don't have a account <a href="#">Register</a></p>
          </div> --}}
                    @csrf
                </form>
            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        $(function() {
            $('#loading').hide();
            $('.submit-admin').click(function() {
                let email = $('input[name="email"]').val().trim();
                let password = $('input[name="password"]').val().trim();
                if (email == '' || password == '') {
                    $('#loading').hide();
                } else {
                    $('#loading').show();
                }
            });

            $('.show-password').click(function() {
                let passwordInput = $('input[name="password"]');
                let passwordIcon = $('.show-password i');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        });
    </script>
    @include('admin.footer')
</body>

</html>
