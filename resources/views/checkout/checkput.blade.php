<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Select Items</h1>
    <form id="checkoutForm" method="post" action="{{ route('checkout') }}">
        @csrf
        <label for="numItems">Number of Items:</label>
        <input type="number" name="numItems" id="numItems" min="1" max="40" required><br><br>

        <div id="itemsContainer"></div>

        <button type="submit">Checkout</button>
    </form>

    <script>
        document.getElementById('numItems').addEventListener('input', function() {
            var numItems = parseInt(this.value);
            var itemsContainer = document.getElementById('itemsContainer');
            itemsContainer.innerHTML = '';

            for (var i = 0; i < numItems; i++) {
                var nameLabel = document.createElement('label');
                nameLabel.textContent = 'Item ' + (i + 1) + ' Name:';

                var nameInput = document.createElement('input');
                nameInput.type = 'text';
                nameInput.name = 'item' + (i + 1) + '_name';
                nameInput.required = true;

                var priceLabel = document.createElement('label');
                priceLabel.textContent = 'Item ' + (i + 1) + ' Price:';

                var priceInput = document.createElement('input');
                priceInput.type = 'number';
                priceInput.name = 'item' + (i + 1) + '_price';
                priceInput.min = '0';
                priceInput.step = '0.01';
                priceInput.required = true;

                itemsContainer.appendChild(nameLabel);
                itemsContainer.appendChild(nameInput);
                itemsContainer.appendChild(document.createElement('br'));
                itemsContainer.appendChild(priceLabel);
                itemsContainer.appendChild(priceInput);
                itemsContainer.appendChild(document.createElement('br'));
            }
        });

        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            // Submit the form using fetch
            fetch(this.action, {
                method: this.method,
                body: new URLSearchParams(new FormData(this))
            })
            .then(response => response.json())
            .then(data => {
                // Handle the API response data here
                console.log(data);
                alert('API Response:\n' + JSON.stringify(data, null, 2));
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error:\n' + error.message);
            });

            // Prevent the form from submitting
            event.preventDefault();
        });
    </script>
</body>
</html>
