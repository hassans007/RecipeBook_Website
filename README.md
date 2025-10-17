# Recipes Book Web Application

## Features and Functionality

### Navigation Bar
- Links to **Home**, **Recipes List**, **Saved Recipes**, **Add New Recipe**, and **About** pages.
- Includes a **Search Bar** for filtering recipes by name or preparation time with advanced search functionality.
- Provides an Authentication system for existing users to LogIn and new users to SignUp.
- Optimized for mobile devices with a responsive design, where the navigation bar collapses into a **hamburger menu**. Clicking the hamburger icon reveals the navigation links.
##### Currently there are two users added by default in the seeder.
Admin Credentials
- email: admin@gmail.com
- password: admin123

User Credentials
- email: user@gmail.com
- password: user123
### Main Pages

#### Home Page
- Displays featured, popular and recently added recipes.
- Users can view recipe details by hovering over the featured images.

#### Recipes List
- Display recipes in a paginated format with wide variety of sorting options
- Provided Search functionality to filter out recipes

#### Create Page
- Allows users to add new recipes with robust form validation to ensure consistency and accuracy.

#### Saved Recipes Page
- A dedicated section to manage saved recipes, featuring a toggle system for quick addition or removal.
- Also provide search and sorting to filter out your favourite recipes.

### Sub-Pages

#### Detail Page
- Displays a comprehensive view of a recipe, including its image, ingredients, preparation steps, and required time.
- Includes options to edit or delete the recipe directly from this page.

#### Edit Page
- Allows users to modify existing recipes with the same validation rules as the create page.

---

## Additional Features

### Advanced Filtering and Sorting
Users can filter recipes by **Category** and **Cuisine** using dropdown menus and sort results dynamically with a **Sort By** feature. This functionality is powered by AJAX for seamless interaction.

#### Key Code Snippet
```javascript
categoryDropdown.addEventListener('change', () => fetchRecipes());
cuisineDropdown.addEventListener('change', () => fetchRecipes());
sortDropdown.addEventListener('change', () => fetchRecipes());

searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
    fetchRecipes();
});

fetchRecipes();
```
### Why is this important 
This code enables real-time updates for filtering and sorting recipes without needing a page reload, making the user experience much smoother and more interactive.

#### Benefits
- Reduces server load by targeting only the required data.
- Provides instant feedback to users, improving usability.

---

### JavaScript Based Recipe Loading
The application dynamically loads recipes via AJAX calls, eliminating the need for full-page reloads.

#### Key Code Snippet
```javascript
fetch(apilink, { method: 'GET', headers: { 'Content-Type': 'application/json' } })
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
        } else {
            resultsContainer.innerHTML = `<p>No recipes found.</p>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        resultsContainer.innerHTML = '<p>Sorry, there was a problem finding the recipe.</p>';
    });
```
### Highlights
- Keeps backend and frontend responsibilities cleanly separated.
- Provides clear error messages and fallback mechanisms for reliability.

---

### Save Button Toggle with Success Message
The **Save Recipe** feature allows users to toggle between "Save Recipe" and "Remove Recipe" while providing real-time feedback.

#### Key Code Snippet
```javascript
const saveForms = document.querySelectorAll(".save-form");
saveForms.forEach(form => {
    form.addEventListener("submit", e => {
        e.preventDefault();
        const button = form.querySelector(".save-button");
        const isSaving = button.textContent.includes("Remove");

        button.textContent = isSaving ? "Save Recipe" : "Remove Recipe";

        fetch(form.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessMessage(data.success); 
                } else if (data.error) {
                    console.error(data.error);
                }
            })
            .catch(error => {
                console.error("Failed to toggle save:", error);
                button.textContent = isSaving ? "Remove Recipe" : "Save Recipe";
            });
    });
});
```
### Success Message Feature
This code snippet ensures users are notified when their action is successful:

```javascript
const showSuccessMessage = (message) => {
    const messageContainer = document.getElementById("success-message");
    if (messageContainer) {
        messageContainer.textContent = message;
        messageContainer.style.display = "block";
        setTimeout(() => {
            messageContainer.style.display = "none";
        }, 2500);
    }
};
```
### Why is this important
- Provides instant updates without a page reload.
- Enhances user experience by confirming actions in a clear and timely manner.

---

### Mobile-First Design
The navigation bar transitions into a **hamburger menu** on smaller screens. Clicking the menu icon reveals the navigation links.  
This ensures a smooth and accessible user experience on mobile devices.

---

### Unit Testing
The application includes robust unit tests to validate critical functionalities like recipe creation, editing, deletion, and filtering.

#### Example Test
```php
public function testRecipeCreation()
{
    $response = $this->post('/recipes', [
        'name' => 'Test Recipe',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'preparation_time' => 30,
        'category' => 'Dessert',
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('recipes', ['name' => 'Test Recipe']);
}
```
#### Benefits of Unit Testing
- Increases reliability by catching bugs early.
- Simplifies debugging by isolating issues in specific tests.
- Ensures features continue to work as expected during future development.

---

### Summary
By combining advanced filtering and sorting, JavaScript-based interactions, responsive mobile-first design, and robust unit testing, the **Recipes Book Web Application** delivers a seamless, user-friendly, and scalable platform for managing recipes. These features and optimizations make the application modern, efficient, and ready for future enhancements.
