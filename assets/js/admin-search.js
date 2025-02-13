// File: assets/js/admin-search.js

$(document).ready(function() {
    // Initialize search functionality
    initializeSearch();
    
    // Initialize user management
    initializeUserManagement();
    
    // Initialize export functionality
    initializeExport();
});

function initializeSearch() {
    const searchInput = $('input[name="search"]');
    let searchTimer = null;
    
    // Debounced search handler
    searchInput.on('input', function() {
        clearTimeout(searchTimer);
        const searchTerm = $(this).val();
        
        searchTimer = setTimeout(() => {
            performSearch(searchTerm);
        }, 500); // Wait 500ms after user stops typing
    });
    
    // Remove default form submission
    $('form[action*="admin/index"]').on('submit', function(e) {
        e.preventDefault();
    });
    
    // Handle pagination clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const page = $(this).attr('href').split('page=')[1] || 0;
        const searchTerm = searchInput.val();
        performSearch(searchTerm, page);
    });
}

function performSearch(searchTerm, page = 0) {
    // Show loading state
    $('.table-responsive').addClass('loading');
    
    $.ajax({
        url: `${baseUrl}admin/search_series`,
        type: 'GET',
        data: {
            search: searchTerm,
            page: page
        },
        success: function(response) {
            try {
                const result = JSON.parse(response);
                
                // Update the table content
                $('.table-responsive table tbody').html(result.html);
                
                // Update pagination
                $('.pagination-container').html(result.pagination);
                
                // Update URL without page reload
                updateURL(searchTerm);
                
            } catch (e) {
                console.error('Error parsing search results:', e);
                showError('An error occurred while searching');
            }
        },
        error: function(xhr, status, error) {
            console.error('Search failed:', error);
            showError('Search failed. Please try again.');
        },
        complete: function() {
            // Remove loading state
            $('.table-responsive').removeClass('loading');
        }
    });
}

function updateURL(searchTerm) {
    const newUrl = new URL(window.location.href);
    if (searchTerm) {
        newUrl.searchParams.set('search', searchTerm);
    } else {
        newUrl.searchParams.delete('search');
    }
    window.history.pushState({}, '', newUrl);
}

function showError(message) {
    // Add error handling UI logic here
    alert(message);
}