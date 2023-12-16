// Get all the li elements within the ul with the class "collapsible"
var coll = document.querySelectorAll("ul.collapsible li.toggle > a");

// Add click event listeners to each li element to toggle the nested ul
coll.forEach(function(a) {
  a.addEventListener("click", function() {
    this.classList.toggle("active");
    var ul = this.parentElement.querySelector("ul");
    if (ul.style.display === "block") {
      ul.style.display = "none";
    } else {
      ul.style.display = "block";
    }
  });
});