$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

function removeRow(id, url) {
  $.ajax({
    type: "DELETE",
    datatype: "JSON",
    data: { id },
    url: url,
    success: function (result) {
      if (result.error === false) {
        alert(result.message);
        location.reload();
      } else {
        alert('Xoá lỗi vui lòng thử lại');
      }
    },
  });
}

/*Upload File */
$('#upload').change(function () {
  let form = new FormData();
  form.append('file', $(this)[0].files[0]);

  $.ajax({
    processData: false,
    contentType: false,
    type: 'POST',
    datatype: 'JSON',
    data: form,
    url: '/admin/upload/services',
    success: function (results) {
      if (results.error === false) {
        $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
          '<img src="' + results.url + '" width="100px"></a>');

        $('#thumb').val(results.url);
      } else {
        alert('Upload File Lỗi');
      }
    }
  })
});

$('#province-select').change(function () {
  let provinceId = $(this).val();
  if (provinceId) {
    // Gửi request AJAX để lấy danh sách thành phố
    $.get('/api/provinces/' + provinceId + '/cities', function (cities) {
      // Xóa danh sách thành phố cũ
      $('#city-select').find('option').remove();

      // Thêm các option mới vào danh sách thành phố
      $.each(cities, function (i, city) {
        let option = $('<option>');
        option.attr('value', city.id).text(city.name);
        $('#city-select').append(option);
      });
    });
  } else {
    // Nếu không chọn tỉnh, xóa danh sách thành phố
    $('#city-select').find('option').remove();
  }
});

$('#status').hide();
$('#token').hide();

$('#checkCus').change(function () {
  if (this.checked) {
    $('#status').show();
    $('#token').show();
  }
  else {
    $('#status').hide();
    $('#token').hide();
  }
});



