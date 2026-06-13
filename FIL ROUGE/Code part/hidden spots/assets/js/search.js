// Live search functionality
const searchInput = document.getElementById('searchInput');
const placesGrid = document.getElementById('placesGrid');
const filterTabs = document.querySelectorAll('.filter-tab');

let currentCategory = 'all';
let searchTimeout;

// Search input handler
if (searchInput) {
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch(this.value, currentCategory);
        }, 300);
    });
}

// Filter tabs handler
filterTabs.forEach(tab => {
    tab.addEventListener('click', function() {
        filterTabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');

        currentCategory = this.dataset.category;

        if (searchInput) {
            performSearch(searchInput.value, currentCategory);
        }
    });
});

// Perform search via API
function performSearch(keyword, categoryId) {
    let url = '../../actions/search_api.php?keyword=' + encodeURIComponent(keyword);

    if (categoryId && categoryId !== 'all') {
        url += '&category_id=' + encodeURIComponent(categoryId);
    }

    fetch(url)
        .then(response => response.json())
        .then(response => {
            if (response.success) {
                displayResults(response.data);
            } else {
                console.error('Search failed:', response.error);
            }
        })
        .catch(error => {
            console.error('Search error:', error);
        });
}

// Display search results
function displayResults(places) {
    if (!placesGrid) return;

    if (places.length === 0) {
        placesGrid.innerHTML = '<div class="empty-state" style="grid-column: 1 / -1;"><p>No places found.</p></div>';
        return;
    }

    placesGrid.innerHTML = places.map(place => `
        <div class="place-card" data-category="${escapeHtml(place.category_id)}">
            <a href="details.php?id=${escapeHtml(place.id)}">
                <img src="${place.image ? '../../' + escapeHtml(place.image) : '../../assets/images/placeholder.jpg'}"
                     alt="${escapeHtml(place.name)}"
                     class="place-card-img">
            </a>
            <div class="place-card-body">
                <h3 class="place-card-title">
                    <a href="details.php?id=${escapeHtml(place.id)}">${escapeHtml(place.name)}</a>
                </h3>
                <div class="place-card-info">
                    <span>📍</span>
                    <span>${escapeHtml(place.location_name || 'Unknown')}</span>
                </div>
                <span class="card-category mt-1">${escapeHtml(place.category_name || '')}</span>
            </div>
        </div>
    `).join('');
}

// Escape HTML to prevent XSS
function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}
