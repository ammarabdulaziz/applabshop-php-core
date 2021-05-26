<?php

require_once(dirname(__DIR__) . '/../database/Product.php');
require_once(dirname(__DIR__) . '/../database/Cart.php');
require_once(dirname(__DIR__) . '/../database/User.php');

class cartController
{
    public $Product;
    public $Cart;
    public function __construct()
    {
        $this->Product = new Product();
        $this->Cart = new Cart();
        $this->User = new User();
    }

    public function read()
    {
        $cart = $this->Product->getData('cart');

        if (count($cart) != 0) {
            http_response_code(200);
            return print_r(json_encode($cart));
        }
        http_response_code(404);
        return print_r(json_encode(['message' => 'No products found']));
    }

    public function readOne()
    {
        if (!isset($_GET['id'])) return print_r(json_encode(['message' => 'Invalid pramater key']));
        if (!is_numeric($_GET['id'])) return print_r(json_encode(['message' => 'Id should be numeric']));
        $user = $this->User->getUser($_GET['id']);
        if (!isset($user)) return print_r(json_encode(['message' => 'No user found for this used_id']));

        $_SESSION['user_id'] = $_GET['id'];
        $cart = $this->Cart->getCart();

        if (count($cart) != 0) {
            http_response_code(200);
            unset($_SESSION['user_id']);
            return print_r(json_encode($cart));
        }

        http_response_code(404);
        unset($_SESSION['user_id']);
        return print_r(json_encode(['message' => 'No cart found for this user']));
    }

    public function create()
    {
        $error = [];
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) array_push($error, 'id (user-id)');
        if (!isset($_GET['item_id']) || !is_numeric($_GET['item_id'])) array_push($error, 'item_id');
        if (!isset($_GET['qty']) || !is_numeric($_GET['qty'])) array_push($error, 'qty');

        $params = implode(', ', $error);
        if (count($error) > 0) return print_r(json_encode(['message' => 'Errors on ' . $params . ' parameters']));

        $user = $this->User->getUser($_GET['id']);
        if (!isset($user)) return print_r(json_encode(['message' => 'No user found for this used_id']));

        $product = $this->Product->getProduct($_GET['item_id']);
        if (count($product) == 0) return print_r(json_encode(['message' => 'No products found for this item_id']));

        $price = $product[0]['price'];
        $item_id = $product[0]['item_id'];
        $qty = $_GET['qty'];
        $_SESSION['user_id'] = $_GET['id'];

        $cart = $this->Cart->addToCart($item_id, $price, $qty);

        if (isset($cart)) {
            http_response_code(200);
            unset($_SESSION['user_id']);
            return print_r(json_encode([
                'message' => 'Cart item added successfully',
                'result' => ['user_id' => $_GET['id'], 'item_id' => $item_id, 'qty' => $qty, 'price' => $price]
            ]));
        }

        http_response_code(404);
        unset($_SESSION['user_id']);
        return print_r(json_encode(['message' => 'Unsuccess']));
    }

    public function update()
    {
        $error = [];
        if (!isset($_GET['cart_id']) || !is_numeric($_GET['id'])) array_push($error, 'cart_id');
        if (!isset($_GET['qty']) || !is_numeric($_GET['id'])) array_push($error, 'qty');

        $params = implode(', ', $error);
        if (count($error) > 0) return print_r(json_encode(['message' => 'Errors on ' . $params . ' parameters']));

        $cart_item = $this->Cart->getCartItem($_GET['cart_id']);
        if (count($cart_item) == 0) return print_r(json_encode(['message' => 'No cart item found for this cart_id']));

        $_SESSION['user_id'] = true;
        $cart_id = $cart_item[0]['cart_id'];
        $item_id = $cart_item[0]['item_id'];
        $count = $_GET['qty'];

        $result = $this->Cart->updateQty($cart_id, $count, $item_id);

        if (isset($result)) {
            http_response_code(200);
            unset($_SESSION['user_id']);
            return print_r(json_encode([
                'message' => 'Cart item updated successfully',
                'result' => ['cart_id' => $cart_id, 'item_id' => $item_id, 'qty' => $count]
            ]));
        }

        http_response_code(404);
        unset($_SESSION['user_id']);
        return print_r(json_encode(['message' => 'Unsuccess']));
    }

    public function delete()
    {
        $error = [];
        if (!is_numeric($_GET['id']) || !is_numeric($_GET['id'])) return print_r(json_encode(['message' => 'Id should be numeric']));
        if (!isset($_GET['cart_id']) || !is_numeric($_GET['cart_id'])) array_push($error, 'cart_id');

        $params = implode(', ', $error);
        if (count($error) > 0) return print_r(json_encode(['message' => 'Errors on ' . $params . ' parameters']));

        $cart_item = $this->Cart->getCartItem($_GET['cart_id']);
        if (count($cart_item) == 0) return print_r(json_encode(['message' => 'No cart item found for this cart_id']));

        $cart_id = $cart_item[0]['cart_id'];
        $result = $this->Cart->deleteCartApi($cart_id);

        if (isset($result)) {
            http_response_code(200);
            unset($_SESSION['user_id']);
            return print_r(json_encode([
                'message' => 'Cart item deleted successfully',
                'result' => ['cart_id' => $cart_id]
            ]));
        }

        http_response_code(404);
        unset($_SESSION['user_id']);
        return print_r(json_encode(['message' => 'Unsuccess']));
    }
}
