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
      url: '../../templates/ajax.php',
      type: 'post',
      data: { cart_id: $(this).data('cartid'), item_id, count: 1, qtyInc: true },
    });

    // Get item price
    $.ajax({
      url: '../../templates/ajax.php',
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
      url: '../../templates/ajax.php',
      type: 'post',
      data: { cart_id: $(this).data('cartid'), item_id, count: -1, qtyDec: true },
    });

    // Get item price
    $.ajax({
      url: '../../templates/ajax.php',
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

    // Get item price
    console.log(user_id, product_id);
    $.ajax({
      url: '../../templates/ajax.php',
      type: 'post',
      data: { item_id: product_id, getPrice: true },
      success: function (result) {
        console.log(result);
        let obj = JSON.parse(result);
        let price = obj[0].price;

        if (user_id) {
          $.ajax({
            url: '../../templates/ajax.php',
            type: 'post',
            data: {
              product_id: parseInt(product_id),
              user_id: parseInt(user_id),
              price,
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
            url: '../../templates/ajax.php',
            type: 'post',
            data: {
              product_id: parseInt(product_id),
              user_id: null,
              price: parseInt(price),
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
      },
    });
  });

  let rowCount = $('#cart-table tbody tr').length;
  $('button[name="delete-cart-submit"]').click(function (e) {
    e.preventDefault();

    rowCount = rowCount - 1;
    console.log(rowCount);
    if (rowCount === 0) {
      $('#cart-table').removeClass('show').addClass('closed');
      $('#cart-empty').addClass('show');
      $('.checkoutBtn').attr('onclick', 'return confirm_order(0)');
    }

    const product_id = parseInt($(this).data('item'));
    const user_id = parseInt($('input[name="user_id"]').val());
    const price = parseInt($('.productPrice[data-id=' + product_id + ']').html());
    const subTotal = parseInt($('.subTotal').html());
    const totalQty = parseInt($('.totalQty').html());

    if (user_id) {
      $.ajax({
        url: '../../templates/ajax.php',
        type: 'post',
        data: {
          product_id: parseInt(product_id),
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
        url: '../../templates/ajax.php',
        type: 'post',
        data: {
          product_id: product_id,
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
    }
  });

  // Status update
  $('.btn-sts-upt').on('click', function (e) {
    e.preventDefault();
    let order_id = $(this).parent().data('id');
    let status = $(this).attr('data-original-title');
    console.log('Api called', status);

    $.ajax({
      url: '/applabshop/admin/orders/change.php',
      type: 'post',
      data: {
        order_id,
        status,
        updateOrderStatus: true,
      },
      success: function (result) {
        if (status == 'Shipped') {
          $(`td.${order_id}`).removeClass('text-danger text-success').addClass('text-warning').html(status);
        }
        if (status == 'Delivered') {
          $(`td.${order_id}`).removeClass('text-danger text-warning').addClass('text-success').html(status);
        }
        if (status == 'Pending') {
          $(`td.${order_id}`).removeClass('text-warning text-success').addClass('text-danger').html(status);
        }
      },
    });
  });

  $(window).on('load', function () {
    $('.loader-wrapper').fadeOut();
  });
});
