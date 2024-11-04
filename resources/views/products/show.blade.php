<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .product-card {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }
        .product-card img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
            border-right: 1px solid #ddd;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }
        .quantity-controls button {
            width: 40px;
            height: 40px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Rise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.view') }}">
                            <i class="bi bi-cart"></i> Cart
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('checkout.preview') }}" id="checkout-nav-link">
                            <i class="bi bi-box-arrow-right"></i> Checkout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card product-card p-3">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="{{ asset('images/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>${{ $product->price }}</strong></p>

                                <!-- Add to Cart Form -->
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="quantity-controls">
                                        <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">-</button>
                                        <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1" style="width: 60px;">
                                        <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Add to Cart</button>
                                </form>
                                <!-- End of Add to Cart Form -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
    </script>
    <script>
    document.getElementById('checkout-nav-link').addEventListener('click', function (event) {
        event.preventDefault();  // Prevent the default link behavior

        // Get all selected item IDs from the checkboxes
        const selectedItems = Array.from(document.querySelectorAll('input[name="selected_items[]"]:checked'))
            .map(checkbox => checkbox.value);

        // Check if there are selected items
        if (selectedItems.length === 0) {
            alert('Please select items to preview for checkout.');
            return;
        }

        // Create the URL with selected item IDs as query parameters
        const url = new URL("{{ route('checkout.preview') }}", window.location.origin);
        url.searchParams.set('items', selectedItems.join(','));

        // Open the checkout preview page in a new tab
        window.open(url.toString(), '_blank');
    });
</script>

</body>
</html>
