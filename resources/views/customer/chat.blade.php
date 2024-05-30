@extends('layout.main')
@section('main')

<section class="main-chat">
  <div class="container">
    <h2 class="mb-3">Liên hệ</h2>
    <div class="row mt-5 bg-white p-4">
      <div class="col-lg-6 chat-row">
        <div class="chat-content" id="chatcontent">
          <ul id="chatMessages" class="p-2">
            {{-- Tin nhắn sẽ được hiển thị ở đây --}}
            @if ($messages->count() > 0)
            @foreach ($messages as $message)
              @if ($message->sender == 'admin')
              <li class="admin-message">{{ $message->message }}</li>
              <span class="d-flex mb-4"><small>{{ date('H:i:s d/m/Y', strtotime($message->updated_at)) }}</small></span>
              @else
              <li class="customer-message">{{ $message->message }}</li>
              <span class="d-flex justify-content-end mb-4"><small>{{ date('H:i:s d/m/Y', strtotime($message->updated_at)) }}</small></span>
              @endif
            @endforeach
            @endif
          </ul> 
        </div>
        <form class="chat-section" id="customerChatForm" method="POST">
          @csrf
          <input type="hidden" name="customerId" value="{{ Auth::guard('cus')->user()->id }}">
          <div class="chat-box d-flex">
            <input class="chat-input bg-white" name="message" id="chatInput" autocomplete="off" contenteditable="" placeholder="Nhập tin nhắn" type="text">
            <button type="submit" class="btn btn-outline-primary ms-3" style="transition: 0.3s"><i class="fa-sharp fa-solid fa-paper-plane-top"></i></button>
          </div>
        </form>
      </div>
      <div class="col-6 d-lg-flex align-items-center justify-content-end d-none">
        <img class="img-fluid" src="/template/img/chat.svg" alt="chat">
      </div>
    </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.6.1/socket.io.min.js" integrity="sha512-AI5A3zIoeRSEEX9z3Vyir8NqSMC1pY7r5h2cE+9J6FLsoEmSSGLFaqMQw8SWvoONXogkfFrkQiJfLeHLz3+HOg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
  function scrollToBottom() {
    let chatMessages = document.getElementById("chatcontent");
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  // Gọi hàm scrollToBottom để đặt scroll ở cuối trang khi cần thiết
  scrollToBottom();
  let ip_address = '127.0.0.1';
  let socket_port = '3000';

  let socket = io.connect(ip_address + ':' + socket_port);
  
  let customerId = @json(Auth::guard('cus')->user()->id);
  let room = "chat " + customerId;
  socket.emit('joinroom',room);
  
  $('#customerChatForm').submit(function(e) {
    e.preventDefault();
    let message = $('#chatInput').val();
    socket.emit('customerSendMessage', { customerId: customerId, message: message, room });
    $.ajax({
      url: '/send-message',
      method: 'POST',
      data: { customerId: customerId, message: message },
      success: function(response) {
        // Xử lý thành công
        $('#chatInput').val('');
        $('#chatMessages').append('<li class="customer-message">' + message + '</li><span class="d-flex justify-content-end mb-4"><small>' + moment().format('H:mm:ss DD/MM/YYYY') + '</small></span>');
        scrollToBottom();
      },
      error: function(xhr, status, error) {
        // Xử lý lỗi
        console.log('Error sending message:', error);
      }
    });
  });

  socket.on('adminMessage', function(data) {
    if (data.customerId == customerId) {
      $('#chatMessages').append('<li class="admin-message">' + data.message + '</li><span class="d-flex mb-4"><small>' + moment().format('H:mm:ss DD/MM/YYYY') + '</small></span>');
      scrollToBottom();
    }
  });
</script>
@endsection
