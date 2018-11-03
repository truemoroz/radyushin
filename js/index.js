$(document).ready(function () {

  $('.js-add-goods').click(function (e) {
    // let data = $('.js-form').serialize();
    e.preventDefault();
    let data = $(this).data('id');
    // console.log(data);
    $table = $('#basket tbody');
    $.ajax({
      type: "POST",
      url: "./api/basket.php",
      dataType: "json",
      data: {id: data},
      success: function (response) {
        // console.log('ok');
        // console.log(response);
      },
      error: function (response) {
        // console.log('error');
        // console.log(response);
      }
      // data: {fname: name}
      // data: {fname:name, id:rno}
    });
    $table.children('tr:nth-child(n+2)').remove();
    // window.location.reload(false);
    let sum = 0;
    $.getJSON("./api/get_basket.php", function (data) {
      $.each(data, function (key, value) {
        $table.append('<tr><td>' + value.name + '</td><td>' + value.price + '</td><td>' + value.quantity + '</td><td>' + value.price + '</td></tr>');
        // console.log(key, value.name, value.price, value.quantity);
        // console.log('-----');
        sum += Number(value.price);
      });
      $table.append('<tr class="table__sum"><td colspan="2"><button class="js-send">Оформить</button></td><td>Итого</td><td>' + sum + '</td></tr>')

      // console.log(sum);
    });
  });

  $('.js-send').click(function () {
    $.ajax({
      type: "POST",
      url: "./api/send_mail.php",
      dataType: "json",
      data: '',
      success: function (response) {
         console.log('ok');
        // console.log(response);
      },
      error: function (response) {
         console.log('error');
        // console.log(response);
      }

    });
  });
});