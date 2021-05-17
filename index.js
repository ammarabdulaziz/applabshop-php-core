$(document).ready(function () {
  $('.btnInc').click(function (e) {
    let item_id = $(this).data('id');
    let quantity = $(this).val();

    $('.btnDec[data-id=' + item_id + ']').removeClass('disabled');
    quantity = parseInt(quantity) + 1;

    $('.btnInc[data-id=' + item_id + '], .btnDec[data-id=' + item_id + ']').attr('value', quantity);
    $('.qtyVal[data-id=' + item_id + ']').html(quantity);

    // let item_price = $('.productPrice').html();
    // console.log($(this).data('cartid'));
    // Update db Qty
    $.ajax({
      url: 'templates/ajax.php',
      type: 'post',
      data: { cart_id: $(this).data('cartid'), count: 1 },
    });

    // Get item price
    $.ajax({
      url: 'templates/ajax.php',
      type: 'post',
      data: { item_id: $(this).data('id') },
      success: function (result) {
        let obj = JSON.parse(result);
        let newPrice = obj[0].price * quantity;
        $('.productPrice[data-id=' + item_id + ']').html(newPrice);
        $('.subTotal').html(parseFloat($('.subTotal').html()) + parseFloat(obj[0].price));
      },
    });
  });

  $('.btnDec').click(function (e) {
    let item_id = $(this).data('id');
    let quantity = $(this).val();

    quantity = parseInt(quantity) - 1;

    $('.btnInc[data-id=' + item_id + '], .btnDec[data-id=' + item_id + ']').attr('value', quantity);
    $('.qtyVal[data-id=' + item_id + ']').html(quantity);

    if (parseInt(quantity) == 1) $(this).addClass('disabled');

    // Update db Qty
    $.ajax({
      url: 'templates/ajax.php',
      type: 'post',
      data: { cart_id: $(this).data('cartid'), count: -1 },
    });

    // Get item price
    $.ajax({
      url: 'templates/ajax.php',
      type: 'post',
      data: { item_id: $(this).data('id') },
      success: function (result) {
        let obj = JSON.parse(result);
        let newPrice = obj[0].price * quantity;
        $('.productPrice[data-id=' + item_id + ']').html(newPrice);
        $('.subTotal').html(parseFloat($('.subTotal').html()) - parseFloat(obj[0].price));
      },
    });
  });
});
