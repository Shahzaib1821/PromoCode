document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('live-search');
    const searchResults = document.getElementById('search-results');
    let debounceTimer;

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            const query = searchInput.value.trim();
            if (query.length > 2) {
                fetch(`/live-search?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        displayResults(data);
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                searchResults.innerHTML = '';
                searchResults.style.display = 'none';
            }
        }, 300);
    });

    function displayResults(data) {
        searchResults.innerHTML = '';
        let hasResults = false;

        if (data.blogs.length > 0) {
            hasResults = true;
            const blogSection = createSection('Blogs', data.blogs, 'blog');
            searchResults.appendChild(blogSection);
        }

        if (data.store.length > 0) {
            hasResults = true;
            const storeSection = createSection('Stores', data.store, 'store');
            searchResults.appendChild(storeSection);
        }

        if (data.category.length > 0) {
            hasResults = true;
            const categorySection = createCategorySearch('Categories', data.category, 'categories');
            searchResults.appendChild(categorySection);
        }

        searchResults.style.display = hasResults ? 'block' : 'none';
    }

    function createSection(title, items, routeName) {
        const section = document.createElement('div');
        section.className = 'search-section';
        section.innerHTML = `<h3>${title}</h3>`;
        const ul = document.createElement('ul');
        items.forEach(item => {
            const li = document.createElement('li');
            // Using the routeName to dynamically generate the URL for each type
            li.innerHTML = `<a href="/${routeName}/${item.slug}">${item.name || item.title}</a>`;
            ul.appendChild(li);
        });
        section.appendChild(ul);
        return section;
    }

    function createCategorySearch(title, items, routeName) {
        const section = document.createElement('div');
        section.className = 'search-section';
        section.innerHTML = `<h3>${title}</h3>`;

        const ul = document.createElement('ul');
        items.forEach(item => {
            const li = document.createElement('li');

            // Create link with the active query parameter based on the slug
            const link = document.createElement('a');
            link.href = `/${routeName}?active=${item.slug}`; // Creates link like 'categories?active=automotive'
            link.textContent = item.name || item.title;

            li.appendChild(link);
            ul.appendChild(li);
        });

        section.appendChild(ul);
        return section;
    }


    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!searchResults.contains(event.target) && event.target !== searchInput) {
            searchResults.style.display = 'none';
        }
    });
});
