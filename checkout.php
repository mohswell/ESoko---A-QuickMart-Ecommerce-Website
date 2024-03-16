<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        /* Styling for the Order notes section */
        .checkout__input {
            margin-bottom: 20px;
        }

        .checkout__input label {
            margin-bottom: 5px;
        }

        /* Hover effect */
        .checkout__input textarea:hover {
            border-color: #ced4da;
        }
        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <!-- Trigger for Modal -->
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Enter your details below to proceed with your order</h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form id="checkout-form" action="checkout_process.php" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="first_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add" required>
                                <input type="text" placeholder="Apartment, suite, unit, etc. (optional)" name="apartment">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" required>
                                    </div>
                                </div>
                                <!-- Use this section to add a form input right next to another input
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                -->
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Existing User?
                                    <input type="checkbox" id="acc" name="create_account">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>If you are a returning customer, please enter your email address to place your order.</p>
                            <div class="checkout__input">
                                <p>Email Address<span>*</span></p>
                                <input type="email" name="email" required>
                                <span id="email-error" class="error-message"></span><br>
                            </div>
                            <div class="checkout__input">
                                <label class="font-weight-bold">Order notes<span>*</span></label>
                                <textarea class="form-control col-10" name="order_notes" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <!-- Your order summary -->
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul id="order-details-list"></ul>
                                <div class="checkout__order__subtotal" >Subtotal<span id="subtotal">Ksh0.00</span></div>
                                <div class="checkout__order__discount">Discount <span id="discount" class="text-danger">Ksh0.00</span></div>
                                <div class="checkout__order__total">Total <span id="total">Ksh0.00</span></div>
                                <!-- Payment methods -->
                                <div class="checkout__input__checkbox">
                                    <label for="cash">
                                        Cash on Delivery
                                        <input type="radio" id="cash" name="payment_method" value="Cash">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="mpesa">
                                        MPesa
                                        <input type="checkbox" id="mpesa" name="payment_method" value="MPesa" onclick="handleMpesaCheckbox()">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!--<div class="checkout__input__checkbox">
                                    <label for="money">
                                        Money on Delivery
                                        <input type="radio" id="moneyOnDelivery" name="payment_method" value="MoneyOnDelivery">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                                <!-- Hidden input field to store selected payment method and total value -->
                                <input type="hidden" id="selected_payment_method" name="selected_payment_method">
                                <input type="hidden" name="total" id="total-value" value="">
                                <input type="hidden" id="cartItemsInput" name="cartItems">
                                <!-- Submit button -->
                                <button type="button" class="site-btn" onclick="submitForm()">PLACE ORDER</button>
                            </div>
                        </div>             
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: P.O.Box 2361, 00621 Village Market Nairobi</li>
                            <li>Phone: 0726666900/0726666699</li>
                            <li>Email: admin@quickmart.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="https://quickmart.co.ke/about-us/">About Us</a></li>
                            <li><a href="https://quickmart.co.ke/returns-policy/">Returns Ploicy</a></li>
                            <li><a href="https://quickmart.co.ke/corporate-governance/">Corporate Governance</a></li>
                            <li><a href="https://quickmart.co.ke/supplier-relations/">Supplier Relations</a></li>
                            <li><a href="https://quickmart.co.ke/corporate-policies/">Corporate Policies</a></li>
                            <li><a href="https://quickmart.co.ke/branch-network/">Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="https://quickmart.co.ke/about-us/">Who We Are</a></li>
                            <li><a href="https://quickmart.co.ke/community/">Community</a></li>
                            <li><a href="https://quickmart.co.ke/careers/">Jobs & Careers</a></li>
                            <li><a href="https://quickmart.co.ke/talk-to-us/">Contact</a></li>
                            <li><a href="https://quickmart.co.ke/talk-to-us/">Talk to us</a></li>
                            <li><a href="https://quickmart.co.ke/privacy-policy/">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="controller/subscribe.php" method="post">
                            <input type="text" name="email" placeholder="Enter your mail">
                            <button type="submit" class="site-btn" name="subscribe">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="https://www.facebook.com/quickmartkenya?_rdc=1&_rdr"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/quickmartkenya/?hl=en"><i class="fa fa-instagram"></i></a>
                            <a href="https://twitter.com/QuickmartKenya"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.youtube.com/channel/UCqWdqywf4fLaaL5rMP36xFQ?themeRefresh=1"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
                .
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>
    <script src="js/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript code for form submission for checkout order -->
    <script>
        // Function to handle form submission
        function submitForm() {
            // Retrieve cart items from session storage
            var cartItems = JSON.parse(sessionStorage.getItem('cartItems'));

            // Set the value of cartItems input field in the form
            document.getElementById('cartItemsInput').value = JSON.stringify(cartItems);

            // Update the hidden input field with the selected payment method value
            var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (selectedPaymentMethod) {
                document.getElementById('selected_payment_method').value = selectedPaymentMethod.value;
            }

            // Check if all required fields are filled
            var form = document.getElementById('checkout-form');
            if (form.checkValidity()) {
                // Submit the form
                form.submit();
            } else {
                // If any required fields are empty, show an alert
                alert('Please fill in all required fields.');
            }
        }
    </script>

    <!-- JavaScript code to initiate redirect to mpesa folder -->
    <script>
        function handleMpesaCheckbox() {
            var mpesaCheckbox = document.getElementById('mpesa');
            // Check if the checkbox is checked and if all required fields are filled
            if (mpesaCheckbox.checked) {
                var form = document.getElementById('checkout-form');
                if (!form.checkValidity()) {
                    // If any required fields are empty, show an alert and return
                    alert('Please fill in all required fields.');
                    mpesaCheckbox.checked = false; // Reset the checkbox
                    return;
                }

                // If the checkbox is checked and all required fields are filled, proceed with redirection
                var total = parseFloat(document.getElementById('total-value').value);
                sessionStorage.setItem('mpesaTotal', total.toFixed(2));
                console.log(total);

                // Store form data in localStorage before redirecting for payment
                storeFormData();

                // Send total to PHP session using AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../daraja/storeTotal.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Redirect to STK push initiation file
                            window.location.href = '../payment/index.php';
                        } else {
                            // Handle error
                            console.error('Failed to store total in session');
                        }
                    }
                };
                xhr.send('total=' + total.toFixed(2));
            }
        }

        // Function to store form data in localStorage
        function storeFormData() {
            var formData = {};
            var form = document.getElementById('checkout-form');
            for (var i = 0; i < form.elements.length; i++) {
                var element = form.elements[i];
                if (element.type !== 'button' && element.type !== 'submit') {
                    formData[element.name] = element.value;
                }
            }
            localStorage.setItem('formData', JSON.stringify(formData));
        }
    </script>

    <!-- JavaScript code for the handleRedirect function -->
    <script>
        $(document).ready(function() {
            // Function to handle the M-Pesa checkbox
            function handleMpesaCheckbox() {
                // Disable all checkboxes
                $('input[name="payment_method"]').prop('disabled', true);
                // Enable the M-Pesa checkbox
                $('#mpesa').prop('disabled', false);
                // Check the M-Pesa checkbox
                $('#mpesa').prop('checked', true);
                // Store the selected payment method in a hidden input field
                $('#selected_payment_method').val('MPesa');
            }

            // Check if the M-Pesa payment was successful
            const urlParams = new URLSearchParams(window.location.search);
            const mpesaSuccess = urlParams.get('mpesa_success');
            if (mpesaSuccess === 'true') {
                // Call the function to handle the M-Pesa checkbox
                handleMpesaCheckbox();

                // Check if there is any stored form data in localStorage
                var formData = localStorage.getItem('formData');
                if (formData) {
                    // Populate the form fields with stored form data
                    var parsedFormData = JSON.parse(formData);
                    for (var key in parsedFormData) {
                        if (parsedFormData.hasOwnProperty(key)) {
                            var element = document.querySelector('[name="' + key + '"]');
                            if (element) {
                                element.value = parsedFormData[key];
                            }
                        }
                    }
                }
            }
        });
    </script>

<script>
// Function to populate the order summary card with cart items and apply discount
function populateOrderSummary() {
    // Retrieve cart items from session storage
    var cartItems = JSON.parse(sessionStorage.getItem('cartItems'));

    // Retrieve discount from session storage
    var discount = parseFloat(sessionStorage.getItem('discount')) || 0; // Default to 0 if discount is not found

    // Render cart items in the order summary
    var orderDetailsList = document.getElementById('order-details-list');
    orderDetailsList.innerHTML = ''; // Clear existing items

    var subtotal = 0; // Variable to calculate the subtotal amount

    cartItems.forEach(function(item) {
        var li = document.createElement('li');
        li.textContent = item.name + ' x ' + item.quantity + ' - Ksh' + item.price.toFixed(2);
        orderDetailsList.appendChild(li);

        subtotal += item.price * item.quantity; // Update the subtotal amount
    });

    // Calculate the discount amount
    var discountAmount = (subtotal * (discount)).toFixed(2);

    // Apply discount to the subtotal
    var total = subtotal - discountAmount; //

    // Update the subtotal, discount, and total in the order summary
    document.getElementById('subtotal').textContent = 'Ksh' + subtotal.toFixed(2);
    document.getElementById('discount').textContent = '-Ksh' + discountAmount;
    document.getElementById('total').textContent = 'Ksh' + total.toFixed(2);

    // Set the total value in the hidden input field
    document.getElementById('total-value').value = total.toFixed(2);
}

// Call the function when the page is loaded
populateOrderSummary();

</script>

</body>

</html>