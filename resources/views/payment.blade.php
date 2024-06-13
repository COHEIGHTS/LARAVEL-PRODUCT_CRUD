<!DOCTYPE html>
<html>
<head>
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-image: url('https://www.google.com/imgres?q=safaricom%20%20payment%20logo&imgurl=https%3A%2F%2Ftechnext24.com%2Fwp-content%2Fuploads%2F2023%2F06%2FSafaricom-logo.jpg&imgrefurl=https%3A%2F%2Ftechnext24.com%2F2023%2F06%2F29%2Fsafaricom-payment-kenyans-data-goods%2F&docid=kQW2gfxtE7fJXM&tbnid=dx0Psk8r86_FKM&vet=12ahUKEwi1nuWixcuGAxWb8rsIHREqOHEQM3oECGUQAA..i&w=900&h=450&hcb=2&ved=2ahUKEwi1nuWixcuGAxWb8rsIHREqOHEQM3oECGUQAA');
            background-size: cover;
            background-position: center;
            opacity: 0.9; /* Set transparency level here */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: green; /* Set title color */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Form</h1>
        <form action="{{ route('initiate.payment') }}" method="POST">
            @csrf
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number">
            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>
</html>
