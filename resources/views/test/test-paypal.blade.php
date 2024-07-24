<!-- resources/views/paypal.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>PayPal Payment</title>
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}&currency=USD"></script>
    <!-- Replace 'YOUR_CLIENT_ID' with your actual PayPal client ID -->
</head>
<body>
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return fetch('{{ route('createTransactionCard') }}', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id; // Use the same key name for order ID in the response
                });
            },
            onApprove: function(data, actions) {
                return fetch('{{ route('captureTransaction') }}?token=' + data.orderID, {
                    method: 'get',
                }).then(function(res) {
                    return res.json();
                }).then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    // Optionally, you can redirect the user or display a message
                });
            }
        }).render('#paypal-button-container'); // Display payment options on your web page
    </script>
</body>
</html>
