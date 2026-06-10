
const keywordInput = document.getElementById("keyword");
const categorySelect = document.getElementById("category_id");
const container = document.getElementById("placesContainer");

// simple debounce timer
let timer = null;

// listen to typing in search box
keywordInput.addEventListener("input", function () {
    triggerSearch();
});

// listen to category change
categorySelect.addEventListener("change", function () {
    triggerSearch();
});

// main function
function triggerSearch() {

    // clear old timer (debounce)
    clearTimeout(timer);

    timer = setTimeout(() => {

        const keyword = keywordInput.value;
        const category = categorySelect.value;

        fetch(`../../actions/search_api.php?keyword=${keyword}&category_id=${category}`)
            .then(response => response.json())
            .then(data => {

                if (data.success) {
                    renderPlaces(data.data);
                }
            })
            .catch(error => {
                console.log("Search error:", error);
            });

    }, 300); // wait 300ms after typing
}

// render results in HTML
function renderPlaces(places) {

    container.innerHTML = ""; // clear old results

    if (places.length === 0) {
        container.innerHTML = "<p>No places found.</p>";
        return;
    }

    places.forEach(place => {

        const image = place.image 
            ? `../../${place.image}` 
            : "../../assets/images/placeholder.jpg";

        const html = `
            <div style="border:1px solid #ccc; padding:10px; margin:10px; width:300px; display:inline-block;">

                <img src="${image}" width="100%" height="150">

                <h3>${place.name}</h3>

                <p>${place.category_name}</p>

                <small>By ${place.username}</small>

                <br><br>

                <a href="details.php?id=${place.id}">
                    View Details →
                </a>

            </div>
        `;

        container.innerHTML += html;
    });
}