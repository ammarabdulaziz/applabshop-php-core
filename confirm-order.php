<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Comfirmed</title>
</head>

<style>
    @import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css";

    body {
        background: #2C3E50;
        font-family: "Poppins";
    }

    .center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .popup {
        width: 650px;
        height: 355px;
        padding: 67px 20px;
        background: #fff;
        border-radius: 10px;
        box-sizing: border-box;
        z-index: 2;
        text-align: center;
        opacity: 0;
        top: -200%;
        transform: translate(-50%, -50%) scale(0.5);
        transition: opacity 300ms ease-in-out,
            top 1000ms ease-in-out,
            transform 1000ms ease-in-out;
    }

    .popup.active {
        opacity: 1;
        top: 50%;
        transform: translate(-50%, -50%) scale(1);
        transition: transform 300ms cubic-bezier(0.18, 0.89, 0.43, 1.19);
    }

    .popup .icon {
        margin: 5px 0px;
        width: 50px;
        height: 50px;
        border: 2px solid #34f234;
        text-align: center;
        display: inline-block;
        border-radius: 50%;
        line-height: 60px;
    }

    .popup .icon i.fa {
        font-size: 30px;
        color: #34f234;
    }

    .popup .title {
        margin: 5px 0px;
        font-size: 30px;
        font-weight: 600;
    }

    .popup .description {
        color: #222;
        font-size: 15px;
        padding: 5px;
    }

    .popup .dismiss-btn {
        margin-top: 15px;
    }

    .popup .dismiss-btn button {
        padding: 10px 30px;
        margin-top: 5px;
        background: #2C3E50;
        color: #f5f5f5;
        border: 2px solid #2C3E50;
        font-size: 16px;
        font-weight: 600;
        outline: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 300ms ease-in-out;
        font-family: "Poppins";
    }

    .popup .dismiss-btn button:hover {
        color: #2C3E50;
        background: #f5f5f5;
    }

    .popup>div {
        position: relative;
        top: 10px;
        opacity: 0;
    }

    .popup.active>div {
        top: 0px;
        opacity: 1;
    }

    .popup.active .icon {
        transition: all 300ms ease-in-out 250ms;
    }

    .popup.active .title {
        transition: all 300ms ease-in-out 300ms;
    }

    .popup.active .description {
        transition: all 300ms ease-in-out 350ms;
        margin-top: 10px;
    }

    .popup.active .dismiss-btn {
        transition: all 300ms ease-in-out 400ms;
    }
</style>

<body>
    <div class="popup center">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="title">
            Success !
        </div>
        <div class="description"><b>
                Thank You. <b></b></b><br> Your order has been successfully confirmed.
        </div>
        <div class="dismiss-btn">
            <button id="dismiss-popup-btn">
                Home
            </button>
        </div>
    </div>

</body>


<script>
    window.addEventListener('load', (event) => {
        document.getElementsByClassName("popup")[0].classList.add("active");
    });

    document.getElementById("dismiss-popup-btn").addEventListener("click", function() {
        document.getElementsByClassName("popup")[0].classList.remove("active");
    });

    document.getElementById("dismiss-popup-btn").addEventListener("click", function() {
        window.location.replace("index.php");
        // window.location.href = "http://www.w3schools.com";
    });
</script>

</html>