document.addEventListener('DOMContentLoaded', function () {
    const searchBar = document.getElementById('searchBar');
    const searchForm = document.getElementById('searchForm');
    const resultsContainer = document.getElementById('recipes-container');
    const searchMessageContainer = document.getElementById('searchMessage');
    const sortDropdown = document.getElementById('dropdownSort');
    const paginationContainer = document.getElementById('pagination-container');
    const categoryDropdown = document.getElementById('dropdownCategory');
    const cuisineDropdown = document.getElementById('dropdownCuisine'); 
    
    if (!searchBar || !resultsContainer || !searchForm || !sortDropdown || !paginationContainer || !categoryDropdown || !cuisineDropdown) return;

    const fetchRecipes = (url = null) => {
        const query = searchBar.value.trim();
        const sortBy = sortDropdown.value;
        const category = categoryDropdown.value;
        const cuisine = cuisineDropdown.value;

        // If no URL is provided, construct it with the current filters
        const apilink = url || `/recipesbook/getRecipes?search=${encodeURIComponent(query)}&sort_by=${encodeURIComponent(sortBy)}&category=${encodeURIComponent(category)}&cuisine=${encodeURIComponent(cuisine)}`;

        fetch(apilink, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                resultsContainer.innerHTML = '';

                if (Array.isArray(data.recipes) && data.recipes.length > 0) {
                    const listMain = document.createElement('div');
                    listMain.className = 'listmain';

                    data.recipes.forEach(recipe => {
                        const recipeItem = document.createElement('div');
                        recipeItem.className = 'recipelist-item';

                        recipeItem.innerHTML = `
                            <a href="/recipesbook/${recipe.id}">
                                <img class="list-poster" src="${recipe.image}" alt="${recipe.name}">
                            </a>
                            <p class="recipe-name"><b>${recipe.name}</b></p>
                        `;

                        listMain.appendChild(recipeItem);
                    });

                    resultsContainer.appendChild(listMain);

                    if (paginationContainer) {
                        paginationContainer.innerHTML = data.pagination || '';
                        attachPaginationListeners();
                    }

                    if (searchMessageContainer && query) {
                        searchMessageContainer.innerHTML = `<p>You searched for: <b>${query}</b></p>`;
                    } else if (searchMessageContainer) {
                        searchMessageContainer.innerHTML = '';
                    }
                } else {
                    resultsContainer.innerHTML = `<p>No recipes found.</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                resultsContainer.innerHTML = '<p>Sorry, there was a problem finding the recipe.</p>';
            });
    };

    const attachPaginationListeners = () => {
        const paginationLinks = paginationContainer.querySelectorAll('a.directpag');
        paginationLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const url = link.getAttribute('href');

                const query = searchBar.value.trim();
                const sortBy = sortDropdown.value;
                const category = categoryDropdown.value;
                const cuisine = cuisineDropdown.value;

                const fullUrl = `${url}&search=${encodeURIComponent(query)}&sort_by=${encodeURIComponent(sortBy)}&category=${encodeURIComponent(category)}&cuisine=${encodeURIComponent(cuisine)}`;
                if (url) {
                    fetchRecipes(fullUrl);
                }
            });
        });
    };

    // Event listener for category dropdown change
    categoryDropdown.addEventListener('change', () => fetchRecipes());

    // Event listener for cuisine dropdown change
    cuisineDropdown.addEventListener('change', () => fetchRecipes());

    // Trigger fetch on form submission
    searchForm.addEventListener('submit', function (e) {
        e.preventDefault();
        fetchRecipes();
    });

    // Trigger fetch on sort dropdown change
    sortDropdown.addEventListener('change', () => fetchRecipes());

    // Initial fetch
    fetchRecipes();
});
