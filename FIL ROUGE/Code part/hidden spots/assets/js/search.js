
const keywordInput = document.getElementById("keyword");
const categorySelect = document.getElementById("category_id");
const container = document.getElementById("placesContainer");

// simple debounce timer
let timer = null;

// Escape HTML to prevent XSS
function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

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

        fetch(`../../actions/search_api.php?keyword=${encodeURIComponent(keyword)}&category_id=${encodeURIComponent(category)}`)
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
            ? `../../${escapeHtml(place.image)}` 
            : "../../assets/images/placeholder.jpg";

        const div = document.createElement('div');
        div.style.cssText = 'border:1px solid #ccc; padding:10px; margin:10px; width:300px; display:inline-block;';

        div.innerHTML = `
            <img src="${image}" width="100%" height="150">
            <h3>${escapeHtml(place.name)}</h3>
            <p>${escapeHtml(place.category_name)}</p>
            <small>By ${escapeHtml(place.username)}</small>
            <br><br>
            <a href="details.php?id=${parseInt(place.id, 10)}">
                View Details →
            </a>
        `;

        container.appendChild(div);
    });
}