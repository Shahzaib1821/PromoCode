document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("live-search");
    const searchResults = document.getElementById("search-results");
    let debounceTimer;

    searchInput.addEventListener("input", function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            const query = searchInput.value.trim();
            if (query.length > 0) {
                fetch(`/live-search?query=${encodeURIComponent(query)}`)
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then((data) => {
                        displayResults(data);
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        searchResults.innerHTML =
                            "<p>An error occurred while searching. Please try again.</p>";
                        searchResults.style.display = "block";
                    });
            } else {
                searchResults.innerHTML = "";
                searchResults.style.display = "none";
            }
        }, 300);
    });

    function displayResults(data) {
        searchResults.innerHTML = "";
        let hasResults = false;

        const sections = [
            { title: "Stores", data: data.store || [], routeName: "store" },
        ];

        sections.forEach((section) => {
            if (section.data.length > 0) {
                hasResults = true;
                const sectionElement = createSection(section.title, section.data, section.routeName);
                searchResults.appendChild(sectionElement);
            }
        });

        if (!hasResults) {
            searchResults.innerHTML = "<p>No results found.</p>";
        }

        searchResults.style.display = "block";
    }

    function createSection(title, items, routeName) {
        const section = document.createElement("div");
        section.className = "search-section";
        const ul = document.createElement("ul");
        items.forEach((item) => {
            const li = document.createElement("li");
            li.innerHTML = `<a href="/${routeName}/${item.slug}">${
                item.name || item.title
            }</a>`;
            ul.appendChild(li);
        });
        section.appendChild(ul);
        return section;
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", function (event) {
        if (
            !searchResults.contains(event.target) &&
            event.target !== searchInput
        ) {
            searchResults.style.display = "none";
        }
    });
});
