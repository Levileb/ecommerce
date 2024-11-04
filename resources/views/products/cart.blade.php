<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100%; /* Full height of the viewport */
        }
        .cart-list {
            height: 80vh; /* Full height minus button space */
            overflow-y: auto; /* Enable vertical scrolling */
            margin-bottom: 20px; /* Space for the button */
        }
        .item-details {
            display: flex;
            justify-content: space-between; /* Aligns children to be spaced evenly */
            width: 100%;
        }
        .list-group-item {
            cursor: pointer; /* Show pointer on hover */
            padding: 10px; /* Adjusted padding */
            margin-top: -12px; /* Adjust the top margin to shift items upward */
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <h2>My Cart</h2>

        @if($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <div class="cart-list">
                <ul class="list-group">
                    @foreach($cartItems as $item)
                        <li class="list-group-item d-flex align-items-center" onclick="toggleCheckbox(this)">
                            <input type="checkbox" class="me-3" value="{{ $item->id }}" />
                            <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 100px; height: auto; margin-right: 15px;">
                            <div class="item-details">
                                <div>
                                    <h5 class="mb-1">{{ $item->product->name }}</h5>
                                </div>
                                <div class="text-end">
                                    <p class="mb-1">Quantity: {{ $item->quantity }}</p>
                                    <p class="mb-0"><strong>Total Price: ${{ $item->product->price * $item->quantity }}</strong></p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- Checkout Button and Total -->
            <div class="d-flex justify-content-end align-items-center">
                <span class="fw-bold me-3" id="total-amount">Total: $0.00</span>
                <button class="btn btn-primary" id="checkout-button">Checkout</button>
            </div>
        @endif
    </div>

    <script>
        // Toggle checkbox when clicking the list item
        function toggleCheckbox(listItem) {
            const checkbox = listItem.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked; // Toggle checked state
            calculateTotal();
        }

        // Calculate total of checked items
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.cart-list input[type="checkbox"]:checked').forEach(checkbox => {
                const listItem = checkbox.closest('.list-group-item');
                const priceText = listItem.querySelector('.item-details strong').textContent;
                const price = parseFloat(priceText.replace(/[^0-9.-]+/g, '')); // Extract price
                total += price; // Accumulate total
            });
            document.getElementById('total-amount').textContent = 'Total: $' + total.toFixed(2); // Update total display
        }

        // Placeholder for checkout functionality
        document.getElementById('checkout-button').addEventListener('click', function() {
            const selectedItems = [];
            document.querySelectorAll('.cart-list input[type="checkbox"]:checked').forEach(checkbox => {
                selectedItems.push(checkbox.value); // Collect selected item IDs
            });

            if (selectedItems.length > 0) {
                // For now, show a message indicating which items are selected
                alert('Items ready for checkout: ' + selectedItems.join(', '));
            } else {
                alert('Please select at least one item to checkout.');
            }
        });
    </script>
</body>
</html>
