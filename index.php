<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <!-- Include Bootstrap CSS and Font Awesome for icons -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>

  <div class="container-fluid mt-5">

    <h2 class="alert alert-danger text-center mb-5">Add To Cart Using JS</h2>

    <div class="row">
      <div class="col-8">
        <div class="row">
          <div class="col-lg-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="product" data-name="Product 01" data-price="50.00">
                  <h2>Product 01</h2>
                  <p>Price: $50.00</p>
                  <button class="btn btn-success addToCartBtn">Add to Cart</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="product" data-name="Product 02" data-price="30.00">
                  <h2>Product 02</h2>
                  <p>Price: $30.00</p>
                  <button class="btn btn-success addToCartBtn">Add to Cart</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="product" data-name="Product 03" data-price="80.00">
                  <h2>Product 03</h2>
                  <p>Price: $80.00</p>
                  <button class="btn btn-success addToCartBtn">Add to Cart</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="product" data-name="Product 04" data-price="130.00">
                  <h2>Product 04</h2>
                  <p>Price: $130.00</p>
                  <button class="btn btn-success addToCartBtn">Add to Cart</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="product" data-name="Product 05" data-price="330.00">
                  <h2>Product 05</h2>
                  <p>Price: $330.00</p>
                  <button class="btn btn-success addToCartBtn">Add to Cart</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="product" data-name="Product 06" data-price="230.00">
                  <h2>Product 06</h2>
                  <p>Price: $230.00</p>
                  <button class="btn btn-success addToCartBtn">Add to Cart</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Repeat similar blocks for other products -->
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-success mb-3 d-flex align-items-center justify-content-between">
              <h4>Add To Cart</h4>
              <span class="badge bg-danger text-white p-2"><i class="fas fa-shopping-cart"></i> <span id="cart-item-count">0</span></span>
            </div>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="cart-items">
                <!-- Cart items will be added dynamically here -->
              </tbody>
            </table>

            <div class="summary text-end">
              <span>Subtotal: $<span id="subtotal">0.00</span></span><br>
              <span>Total: $<span id="total">0.00</span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Include Bootstrap JS and your custom script -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Initialize variables
    let cart = [];
    let cartItemCount = 0;
    let subtotal = 0;

    // Function to update the cart and display
    function updateCart() {
      const cartItemsContainer = document.getElementById('cart-items');
      const subtotalElement = document.getElementById('subtotal');
      const totalElement = document.getElementById('total');
      const cartItemCountElement = document.getElementById('cart-item-count');

      // Clear previous items
      cartItemsContainer.innerHTML = '';

      // Update cart items and calculate subtotal
      subtotal = 0;
      cart.forEach(item => {
        const {
          name,
          price,
          quantity
        } = item;
        const total = price * quantity;
        subtotal += total;

        // Display cart item
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>${name}</td>
        <td>$${price.toFixed(2)}</td>
        <td>
          <button class="decrement" onclick="decrementQuantity('${name}')"><i class="fas fa-minus"></i></button>
          <span class="quantity">${quantity}</span>
          <button class="increment" onclick="incrementQuantity('${name}')"><i class="fas fa-plus"></i></button>
        </td>
        <td>$${total.toFixed(2)}</td>
        <td><button class="remove" onclick="removeFromCart('${name}')">Remove</button></td>
      `;
        cartItemsContainer.appendChild(row);
      });

      // Update subtotal, total, and cart item count
      totalElement.textContent = subtotal.toFixed(2);
      subtotalElement.textContent = subtotal.toFixed(2);
      cartItemCountElement.textContent = cartItemCount;
    }

    // Function to add a product to the cart
    function addToCart(productName) {
      const product = cart.find(item => item.name === productName);

      if (product) {
        // If the product is already in the cart, increment its quantity
        product.quantity++;
      } else {
        // If the product is not in the cart, add it
        const productElement = document.querySelector(`.product[data-name="${productName}"]`);
        const price = parseFloat(productElement.getAttribute('data-price'));
        cart.push({
          name: productName,
          price,
          quantity: 1
        });
      }

      // Update cart and display
      cartItemCount++;
      updateCart();
    }

    // Function to increment the quantity of a product in the cart
    function incrementQuantity(productName) {
      const product = cart.find(item => item.name === productName);
      if (product) {
        product.quantity++;
        cartItemCount++;
        updateCart();
      }
    }

    // Function to decrement the quantity of a product in the cart
    function decrementQuantity(productName) {
      const product = cart.find(item => item.name === productName);
      if (product && product.quantity > 1) {
        product.quantity--;
        cartItemCount--;
        updateCart();
      }
    }

    // Function to remove a product from the cart
    function removeFromCart(productName) {
      const productIndex = cart.findIndex(item => item.name === productName);
      if (productIndex !== -1) {
        const removedItem = cart.splice(productIndex, 1)[0];
        cartItemCount -= removedItem.quantity;
        updateCart();
      }
    }

    // Add click event listeners to "Add to Cart" buttons
    document.querySelectorAll('.addToCartBtn').forEach(button => {
      button.addEventListener('click', function() {
        const productName = this.closest('.product').getAttribute('data-name');
        addToCart(productName);
      });
    });
  </script>

</body>

</html>