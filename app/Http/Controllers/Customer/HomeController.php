<?php

namespace App\Http\Controllers\Customer;

// use App\HTTP\Services\Slider\SliderService;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeRequest;
use App\HTTP\Services\CustomerService;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        return view('customer.home', [
            'title' => 'Phong Vũ Shop',
        ]);
    }

    public function logout()
    {
        Auth::guard('cus')->logout();
        return redirect()->route('home');
    }

    public function login()
    {
        return view('customer.login', [
            'title' => 'Đăng nhập',
        ]);
    }

    public function post_login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);

        if (Auth::guard('cus')->attempt($request->only('email', 'password'), $request->has('remember_token'))) {
            if (Auth::guard('cus')->user()->status == 0) {
                Auth::guard('cus')->logout();
                return redirect()->route('home.login')->with('error', 'Tài khoản chưa kích hoạt, <a href="' . route('home.getActived') . '">nhấn vào đây</a>');
            }
            return redirect()->route('home');
        }
        Session::flash('error', 'Email hoặc Mật khẩu không đúng');
        return redirect()->back();
    }

    public function register()
    {
        return view('customer.register', [
            'title' => 'Đăng ký',
        ]);
    }

    public function post_register(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ], [
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp với mật khẩu.',
        ]);
        $email = $request->input('email');
        $existingCustomer = Customer::where('email', $email)->first();
        if ($existingCustomer) {
            return redirect()->back()->with('error', 'Email đã tồn tại, hãy đăng ký email khác.');
        }
        $token = strtoupper(Str::random(10));
        $data = $request->only('name', 'phone', 'address', 'email');
        $password = Hash::make($request->password);
        $data['password'] = $password;
        $data['token'] = $token;

        if ($customer = Customer::create($data)) {
            Mail::send('customer.emails.active_account', compact('customer'), function ($email) use ($customer) {
                $email->subject('Phong Vũ - Xác nhận tài khoản');
                $email->to($customer->email, $customer->name);
            });
            return redirect()->route('home.login')->with('success', 'Đã đăng kí tài khoản, hãy xác thực tài khoản');
        }

        return redirect()->back();
    }

    public function actived(Customer $customer, $token)
    {
        if ($customer->token === $token) {
            $customer->update(['status' => 1, 'token' => null]);
            return redirect()->route('home.login')->with('success', 'Xác nhận thành công, bạn có thể đăng nhập');
        } else {
            return redirect()->route('home.login')->with('error', 'Mã xác nhận bạn gửi không hợp lệ');
        }
    }

    public function showInfo()
    {
        $customer = Auth::guard('cus')->user();
        return view('customer.info', [
            'title' => 'Thông tin khách hàng',
        ], compact('customer'));
    }

    public function forget()
    {
        return view('customer.forget', [
            'title' => 'Quên mật khẩu'
        ]);
    }

    public function post_forget(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers'
        ], [
            'email.required' => "Vui lòng nhập địa chỉ email",
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.exists' => 'Email bạn nhập không tồn tại'
        ]);

        $token = strtoupper(Str::random(10));
        $customer = Customer::where('email', $request->email)->first();
        $customer->update(['token' => $token]);

        Mail::send('emails.forget_account', compact('customer'), function ($email) use ($customer) {
            $email->subject('Phong Vũ - Lấy lại mật khẩu tài khoản');
            $email->to($customer->email, $customer->name);
        });

        return redirect()->back()->with('success', 'Xác nhận mail để thay đổi mật khẩu');
    }

    public function getPass(Customer $customer, $token)
    {
        if ($customer->token === $token) {
            return view('customer.changepassword', [
                'title' => 'Thay đổi mật khẩu'
            ])->with('success', 'Xác nhận thành công, hãy thay đổi mật khẩu');
        }

        return abort(404);
    }

    public function postGetPass(Customer $customer, $token, Request $request)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $password = Hash::make($request->password);
        $customer->update(['password' => $password, 'token' => NULL]);
        return redirect()->route('home.login')->with('success', 'Đổi mật khẩu thành công, bạn có thể đăng nhập');
    }

    public function getActived()
    {
        return view('customer.getActived', [
            'title' => 'Kích hoạt tài khoản'
        ]);
    }

    public function postGetActived(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers'
        ], [
            'email.required' => "Vui lòng nhập địa chỉ email",
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.exists' => 'Email bạn nhập không tồn tại'
        ]);

        $token = strtoupper(Str::random(10));
        $customer = Customer::where('email', $request->email)->first();
        $customer->update(['token' => $token]);

        Mail::send('customer.emails.active_account', compact('customer'), function ($email) use ($customer) {
            $email->subject('Phong Vũ - Xác nhận tài khoản');
            $email->to($customer->email, $customer->name);
        });

        return redirect()->back()->with('success', 'Xác nhận mail để kích hoạt lại tài khoản');
    }

    public function updateInfo(HomeRequest $request)
    {
        $customer = Auth::guard('cus')->user();
        $this->customerService->updateInfo($request, $customer);
        return redirect('/info');
    }

    public function ajaxSearch()
    {
        $data = Product::search()->get();
        return view('customer.ajaxSearch', compact('data'));
    }

    public function testEmail()
    {
        $name = 'Nguyễn Văn Minh Quân';
        Mail::send(
            'customer.emails.test',
            compact('name'),
            function ($email) use ($name) {
                $email->subject('Đơn đặt hàng');
                $email->to('nvmq0175@gmail.com', $name);
            }
        );
    }
}
