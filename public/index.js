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
      data: { cart_id: $(this).data('cartid'), item_id, count: 1, qtyInc: true },
    });

    // Get item price
    $.ajax({
      url: 'templates/ajax.php',
      type: 'post',
      data: { item_id: $(this).data('id'), getPrice: true },
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
      data: { cart_id: $(this).data('cartid'), item_id, count: -1, qtyDec: true },
    });

    // Get item price
    $.ajax({
      url: 'templates/ajax.php',
      type: 'post',
      data: { item_id: $(this).data('id'), getPrice: true },
      success: function (result) {
        let obj = JSON.parse(result);
        let newPrice = obj[0].price * quantity;
        $('.productPrice[data-id=' + item_id + ']').html(newPrice);
        $('.subTotal').html(parseFloat($('.subTotal').html()) - parseFloat(obj[0].price));
      },
    });
  });

  $('button[name="cart_submit"]').click(function (e) {
    e.preventDefault();

    const product_id = $(this).data('item');
    const user_id = $('input[name="user_id"]').val();

    console.log(parseInt(user_id));
    console.log(parseInt(product_id));

    if (user_id) {
      $.ajax({
        url: 'templates/ajax.php',
        type: 'post',
        data: {
          product_id: parseInt(product_id),
          user_id: parseInt(user_id),
          addCart: true,
        },
        success: function (result) {
          $(this).addClass('disabled');

          $(`[data-item="${product_id}"]`).addClass('btn-dark').addClass('disabled');
          $(`[data-item="${product_id}"]`).html('Added to cart');

          let qty = $('.qty-badge').html();
          $('.qty-badge').html(parseInt(qty) + 1);
        },
      });
    } else {
      $.ajax({
        url: 'templates/ajax.php',
        type: 'post',
        data: {
          product_id: parseInt(product_id),
          user_id: null,
          addCart: true,
        },
        success: function (result) {
          $(this).addClass('disabled');

          $(`[data-item="${product_id}"]`).addClass('btn-dark').addClass('disabled');
          $(`[data-item="${product_id}"]`).html('Added to cart');

          let qty = $('.qty-badge').html();
          $('.qty-badge').html(parseInt(qty) + 1);
        },
      });
    }
  });

  $('button[name="delete-cart-submit"]').click(function (e) {
    e.preventDefault();

    const product_id = parseInt($(this).data('item'));
    const user_id = parseInt($('input[name="user_id"]').val());
    const price = parseInt($('.productPrice[data-id=' + product_id + ']').html());
    const subTotal = parseInt($('.subTotal').html());
    const totalQty = parseInt($('.totalQty').html());

    console.log(user_id);
    console.log(product_id);
    console.log(price);
    console.log(subTotal);
    console.log(totalQty);

    if (user_id) {
      $.ajax({
        url: 'templates/ajax.php',
        type: 'post',
        data: {
          product_id: parseInt(product_id),
          user_id: parseInt(user_id),
          deleteCart: true,
        },
        success: function (result) {
          $(`tr[data-id=${product_id}]`).hide();
          let qty = $('.qty-badge').html();
          $('.qty-badge').html(parseInt(qty) - 1);
          let newSubTotal = subTotal - price;
          $('.subTotal').html(newSubTotal);
          let newTotalQty = totalQty - 1;
          $('.totalQty').html(newTotalQty);
        },
      });
    } else {
      $.ajax({
        url: 'templates/ajax.php',
        type: 'post',
        data: {
          product_id: product_id,
          deleteCart: true,
          user_id: null,
        },
        success: function (result) {
          $(`tr[data-id=${product_id}]`).hide();
          let qty = $('.qty-badge').html();
          $('.qty-badge').html(parseInt(qty) - 1);
          let newSubTotal = subTotal - price;
          $('.subTotal').html(newSubTotal);
          let newTotalQty = totalQty - 1;
          $('.totalQty').html(newTotalQty);
        },
      });
    }
  });
});
