<header class="blue">
    <img src="images/logo.jpg" alt="Logo" class="main-logo">
    <form action="" method="get" class="search-form">
        <input type="text" name="search" id="search-input" class="yellow" placeholder="Search...">
        <button type="submit" id="search-btn" hidden>Search</button>
    </form>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
</header>

<script>
    // Get the input field
var input = document.getElementById("search-input");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("search-btn").click();
  }
});
</script>