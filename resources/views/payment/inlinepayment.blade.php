<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="centered d-block align-content-center justify-center" style="width: 50%; margin:10px; padding:20px;">
        <div>
            <h1 class="text-center">Paystack payment</h1>
        </div>
        <div class="p-10 bg-info mt-10">
            @if(Session::has('error'))
            <div class="text-danger">{{ Session::get('error') }}</div>
            @endif
            <form action="" method="POST" id="paymentForm"> 
                <input type="email" name="user_email" id="email" value="" placeholder="email" required> 
                <input type="number" name="amount" id="amount" value="" placeholder="amount" required> 
                <button type="submit" name="pay_now" id="pay-now" title="Pay now">Pay now</button>
              </form>
        </div>
    </div>

    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        let paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", pay, false);

        function pay(e){
            e.preventDefault();
            let email = document.getElementById('email').value;
            let amount = document.getElementById('amount').value * 100; // Convert to kobo
            let handler = PaystackPop.setup({
                key: 'pk-test_xxxxxxxxx', // Replace with your public test key
                email: email,
                amount: amount,
                ref: Math.floor((Math.random() * 1000000000)), // Generate random reference number
                onClose: function(){
                    alert('Payment window closed.');
                },
                callback: function(response){
                    let reference = response.reference;
                    alert('Payment complete! Reference: ' + reference);
                    console.log('Reference:', reference);
                    // Perform any other operations such as sending the reference to your server
                }
            });
            handler.openIframe();
        }
    </script>
</body>

</html>
