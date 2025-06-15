document.addEventListener('DOMContentLoaded', function () {
    const searchBar = document.getElementById('searchBarSaved');
    const searchForm = document.getElementById('searchFormSaved');
    const resultsContainer = document.getElementById('recipes-container-saved');
    const searchMessageContainer = document.getElementById('searchMessageSaved');
    const sortDropdown = document.getElementById('dropdownSortSaved');
    const paginationContainer = document.getElementById('pagination-container-saved');
    const categoryDropdown = document.getElementById('dropdownCategorySaved');
    const cuisineDropdown = document.getElementById('dropdownCuisineSaved'); 

    if (!searchBar || !resultsContainer || !searchForm || !sortDropdown || !paginationContainer || !categoryDropdown || !cuisineDropdown) return;

    const fetchUserRecipes = (url = null) => {
        // Default values for search, sort, category, and cuisine
        const query = searchBar.value.trim();
        const sortBy = sortDropdown.value || 'id';
        const category = categoryDropdown.value || 'none'; 
        const cuisine = cuisineDropdown.value || 'none'; 

        const apilink = url || `/recipesbook/getSavedRecipes?search=${encodeURIComponent(query)}&sort_by=${encodeURIComponent(sortBy)}&category=${encodeURIComponent(category)}&cuisine=${encodeURIComponent(cuisine)}`;

        fetch(apilink, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(`Error! ${err.message || `Status: ${response.status}`}`);
                    });
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
                    resultsContainer.innerHTML = `<p>No saved recipes found.</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error.message);
                resultsContainer.innerHTML = '<p>Sorry, there was an error finding the recipe. Please try again later.</p>';
            });
    };

    const attachPaginationListeners = () => {
        const paginationLinks = paginationContainer.querySelectorAll('a.directpag');
        paginationLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const url = link.getAttribute('href');

                if (url) {
                    fetchUserRecipes(url);
                }
            });
        });
    };

    categoryDropdown.addEventListener('change', () => fetchUserRecipes());
    cuisineDropdown.addEventListener('change', () => fetchUserRecipes());

    searchForm.addEventListener('submit', function (e) {
        e.preventDefault();
        fetchUserRecipes();
    });

    sortDropdown.addEventListener('change', () => fetchUserRecipes());

    fetchUserRecipes();
});
