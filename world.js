document.addEventListener("DOMContentLoaded", function() {
    const btn = document.getElementById("lookup");

    btn.addEventListener("click", function() {
        const country = document.getElementById("country").value;

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(response => response.text())
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(err => console.error("Fetch error:", err));
    });
});