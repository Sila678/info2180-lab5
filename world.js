document.addEventListener("DOMContentLoaded", function() {
    const btn = document.getElementById("lookup");
    const cityBtn = document.getElementById('lookup-cities')

    btn.addEventListener("click", function() {
        const country = document.getElementById("country").value;

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(response => response.text())
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(err => console.error("Fetch error:", err));
    });

    cityBtn.addEventListener("click", function() {
        const country = document.getElementById("country").value;

        fetch("world.php?country=" + encodeURIComponent(country) + "&lookup=cities")
            .then(response => response.text())
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(err => console.error("Fetch error:", err));
    });
});