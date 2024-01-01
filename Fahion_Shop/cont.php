<!DOCTYPE html>
<html>
	<head>
		<title>Gadgets Ache | Contact Us</title>
	</head>
	<body>
		<header>
        <button onclick="window.location.href='index.php';">
          Home
          </button>
        
          <button onclick="window.location.href='login.php';">
        Login
          </button>
          <button onclick="window.location.href='reg.php';">
          Registration
          </button>
		  <button onclick="window.location.href='products.php';">
        Products
          </button>
		  <button onclick="window.location.href='orders.php';">
        My Orders
          </button>
		  <button onclick="window.location.href='cart.php';">
        Shopping Cart
          </button>
          <button onclick="window.location.href='about.php';">
        About us
          </button>
		</header>

<main>
		<h1>Contact Us</h1>
		<p>Have a question or need some help? Get in touch with us!</p>
		<div>
			<h2>Address</h2>
			<p>408/1, Kuratoli, Khilkhet, Dhaka 1229, Bangladesh</p>
		</div>
		<div>
			<h2>Email</h2>
			<p><a href="mailto:gadgetsache@email.com">gadgetsache@email.com</a></p>
		</div>
		<div>
			<h2>Phone</h2>
			<p>01111111111</p>
		</div>
		<form>
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
			<label for="message">Message:</label>
			<textarea id="message" name="message" rows="4" required></textarea>
			<input type="submit" value="Send">
		</form>
	</main>
</body>
