window.onload = () => {
    var country = document.getElementById("country")
    var button = document.getElementById("lookup")
    button.addEventListener('click', () => {
        var sanitizedSearchValue =  country.value.trim()
        this.fetch('http://localhost:8080/info2180-lab5/info2180-lab5-master/world.php?' + new URLSearchParams({
            country: sanitizedSearchValue
        }))
        .then(response => response.text())
        .then(data => {
            this.document.getElementById("result").innerHTML = data;
        })
        .catch(error => {
            this.alert(error);
        });
    })
}