<header class="blue">
    <a href="index.php"><img src="images/logo.jpg" alt="Logo" class="main-logo"></a> 
    <!-- search form -->
    <form action="" method="get" class="search-form">
        <input type="text" name="search" id="search-input" class="yellow" placeholder="Search...">
        <!-- hidden submit button for accessibility and to allow form submission with Enter key -->
        <button type="submit" id="search-btn" hidden>Search</button>
    </form>
    <nav>
        <ul id="main-buttons">
            <li><a href="search.php" class="yellow">Search</a></li>
            <li><a href="aboutUs.php" class="yellow">About</a></li>
            <li><a href="#" class="yellow">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- no submit button needed only hit enter to submit the form -->
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