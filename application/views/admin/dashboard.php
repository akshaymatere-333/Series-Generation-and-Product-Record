<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Sahyadri Farm Machinery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>"/>
</head>
<body>
    <div class="header">
        <div class="header-title">Admin Dashboard</div>
        <a href="<?= site_url('auth/logout') ?>" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="container">
        <!-- Dashboard Overview Section -->
        <div class="card">
    <h2>Dashboard Overview</h2>
    <div class="dashboard-stats">
        <div class="stat-card">
            <i class="fas fa-hashtag"></i>
            <h3>Total Generated</h3>
            <p><?= $total_series ?: '0' ?></p>
            <h3>Series</h3>

        </div>
        <div class="stat-card">
            <i class="fas fa-box"></i>
            <h3>Total Products</h3>
            <p><?= $total_products ?: '0' ?></p>
            <h3>Types</h3>

        </div>
        <div class="stat-card">
            <i class="fas fa-users-cog"></i>
            <h3>Total Helping</h3>
            <p><?= $total_users ?: '0' ?></p>
            <h3>Users</h3>
        

        </div>
        
        <div class="stat-card">
            <i class="fas fa-cogs"></i>
            <h3>Total Manufactured</h3>
            <p><?= $total_machines ?: '0' ?></p>
            <h3>Machines</h3>

        </div>
        <div class="stat-card">
            <i class="fas fa-shipping-fast"></i>
            <h3>Total Selled</h3>
            <p><?= $total_customers ?: '0' ?></p>
            <h3>Machines</h3>
        </div>
        <div class="stat-card">
            <i class="fas fa-wrench"></i>
            <h3>Onfield Working</h3>
            <p><?= $total_installations ?: '0' ?></p>
            <h3>Machines</h3>
        </div>
        </div>
</div>
<div>
        <div class="card">
            <div class="tab-navigation">
                <button class="tab-button active" data-tab="users">
                    <i class="fas fa-users"></i> Users
                </button>
               
                <button class="tab-button" data-tab="series">
                    <i class="fas fa-list-ol"></i> Series
                </button>

                <button class="tab-button" data-tab="product">
    <i class="fas fa-box"></i> Products
</button>
            </div>
        <!-- </div> -->
     

        <!-- <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h2>Users Management</h2>
                    <button class="generate-btn" id="addUserBtn">
                        <i class="fas fa-plus"></i> Add New User
                    </button>
                </div> -->
                <div class="tab-content active" id="users-tab">
    <div class="card recent-series">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h2>Users Management</h2>
                    <button class="generate-btn" id="addUserBtn">
                        <i class="fas fa-plus"></i> Add New User
                    </button>
                </div>
    <div class="table-responsive">
        <!-- Rest of the table remains the same -->
   
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th>Sr No.</th>

                            <th>Username</th>
                            <th>Employee Name</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $serial = 1; // Start serial number from 1 ?>

                        <?php if(isset($users) && !empty($users)): ?>
                            <?php foreach($users as $user): ?>
                            <tr>
                            <td><?php echo $serial++; // Automatically increment the serial number ?></td>

                                <td><?= $user->username ?></td>
                                <td><?= $user->employee_name ?></td>
                                <td><?= $user->role ?></td>
                                <td><?= date('d M Y H:i', strtotime($user->created_at)) ?></td>
                                <td>
                                    <button onclick="editUser(<?= $user->id ?>)" class="btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteUser(<?= $user->id ?>)" class="btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">No users found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
                        </div>
                                   
        
    </tbody>
    </div>
    
    
    <div class="tab-content" id="product-tab">
    <div class="card recent-series">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h2>Products Management</h2>
            <button class="generate-btn" id="addProductBtn">
                <i class="fas fa-plus"></i> Add New Product
            </button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Product Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($products) && !empty($products)): ?>
                        <?php $serial = 1; ?>
                        <?php foreach($products as $product): ?>
                        <tr>
                            <td><?php echo $serial++; ?></td>
                            <td><?= $product->product_name ?></td>
                            <td>
                                <button onclick="editProduct(<?= $product->id ?>)" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteProduct(<?= $product->id ?>)" class="btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">No products found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Product Modal -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <h2 id="productModalTitle">Add/Edit Product</h2>
        <form id="productForm">
            <input type="hidden" id="productId">
            <input type="text" id="productName" placeholder="Product Name" required>
            <button type="submit" class="generate-btn">Save Product</button>
        </form>
    </div>
</div>

    <!-- User Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <h2 id="modalTitle">Add/Edit User</h2>
            <form id="userForm">
                <input type="hidden" id="userId">
                <input type="text" id="username" placeholder="Username" required>
                <input type="text" id="employeeName" placeholder="Employee Name">
                <input type="password" id="password" placeholder="Password">
                <select id="userRole" required>
                    <option value="">Select Role</option>
                    <option value="mseries">M-Series</option>
                    <option value="machine">Machine</option>
                    <option value="customer">Customer</option>
                    <option value="installation">Installation</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" class="generate-btn">Save User</button>
            </form>
        </div>
    </div>
    <!-- Export Modal -->
    <div id="exportModal" class="modal">
    <div class="modal-content">
        <h2>Export Series Details</h2>
        <form id="exportForm">
            <div style="margin-bottom: 20px;">
                <label><strong>Select Export Format:</strong></label><br>
                <select id="exportFormat" class="input-field" style="margin-top: 10px;">
                    <option value="">Choose Format</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                </select>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label><strong>Select Columns to Export:</strong></label><br>
                <div style="margin-top: 10px;">
                    <label><input type="checkbox" value="mseries"> M-Series</label><br>
                    <label><input type="checkbox" value="product_name"> Product Name</label><br>
                    <label><input type="checkbox" value="pump_detail"> Pump Detail</label><br>
                    <label><input type="checkbox" value="pump_maker"> Pump Maker</label><br>
                    <label><input type="checkbox" value="pump_series"> Pump Series</label><br>
                    <label><input type="checkbox" value="customer_name"> Customer Name</label><br>
                    <label><input type="checkbox" value="customer_phone"> Customer Phone</label><br>
                    <label><input type="checkbox" value="customer_email"> Customer Email</label><br>
                    <label><input type="checkbox" value="dealer"> Dealer</label><br>
                    <label><input type="checkbox" value="purchase_date"> Purchase Date</label><br>
                    <label><input type="checkbox" value="installation_date"> Installation Date</label><br>
                </div>
            </div>
            
            <button type="submit" class="generate-btn">Export</button>
        </form>
    </div>
</div>

    <!-- Series Details Section -->
    <div class="tab-content" id="series-tab">
        <div class="card recent-series">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h2>Series Details</h2>
                    <div style="display: flex; gap: 10px;">
    <div style="display: flex; gap: 10px;">
        <form action="<?= site_url('admin/index') ?>" method="GET" style="display: flex; gap: 10px;">
    <input 
        type="text" 
        name="search" 
        class="input-field" 
        placeholder="Search" 
        value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
        style="min-width: 250px;"
    >
</form>
        <button id="showExportModal" class="generate-btn">
            <i class="fas fa-file-export"></i> Export Data
        </button>
    </div>
</div>
                        </div>
    <div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
            <th>Sr No.</th>
            <th>M-Series</th>
            <th>Product Name</th>
            <th>Machine Pump</th>
            <th>Customer</th>
            <th>Installation</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php $serial = 1; ?>
        <?php if(!empty($series_details)): ?>
            <?php foreach($series_details as $series): ?>
            <tr>
                <td><?php echo $serial++; ?></td>
                <td><?= $series->mseries ?></td>
                <td><?= $series->product_name ?></td>
                <td>
                    <?php if($series->machine_pump_detail): ?>
                        <strong><i>Series:</i></strong> <?= $series->machine_pump_series ?><br>
                        <strong><i>Maker:</i> </strong><?= $series->machine_pump_maker ?><br>
                        <strong><i>Detail:</i></strong> <?= $series->machine_pump_detail ?>
                    <?php else: ?>
                        <i>Machine detail not available</i>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($series->customer_name): ?>
                        <strong><i>Name:</i></strong> <?= $series->customer_name ?><br>
                        <strong><i>Phone: </i></strong><?= $series->customer_phone ?><br>
                    <?php else: ?>
                        <i>Customer detail not available</i>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($series->installation_date): ?>
                        <strong><i>Dealer: </i></strong><?= $series->installation_dealer ?><br>
                        <strong><i>Purchase Date: </i></strong><?= $series->installation_purchase_date ?><br>
                        <strong><i>Install By: </i></strong><?= $series->installation_installed_by ?><br>
                        <strong><i>Date: </i></strong><?= $series->installation_date ?>
                    <?php else: ?>
                        <i>Installation detail not available</i>
                    <?php endif; ?>
                </td>
                <td>
                    <span class="status-<?= $series->status_color ?>"><?= $series->status ?></span>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No series details found</td>
            </tr>
        <?php endif; ?>
        <!-- Users Management Section -->
        <!-- Pagination -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        // User Management JavaScript
        function addUser() {
            $.ajax({
                url: '<?= site_url('admin/add_user') ?>',
                type: 'POST',
                data: {
                    username: $('#username').val(),
                    employee_name: $('#employeeName').val(),
                    password: $('#password').val(),
                    role: $('#userRole').val()
                },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        alert(result.message);
                        location.reload();
                    } else {
                        alert('Error: ' + result.message);
                    }
                }
            });
        }

        function editUser(id) {
            $.ajax({
                url: '<?= site_url('admin/get_user') ?>',
                type: 'GET',
                data: { id: id },
                success: function(response) {
                    const user = JSON.parse(response);
                    $('#userId').val(user.id);
                    $('#username').val(user.username);
                    $('#employeeName').val(user.employee_name);
                    $('#userRole').val(user.role);
                    $('#modalTitle').text('Edit User');
                    $('#userModal').show();
                }
            });
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '<?= site_url('admin/delete_user') ?>',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    }
                });
            }
        }

        $(document).ready(function() {
            $('#addUserBtn').click(function() {
                $('#userId').val('');
                $('#username').val('');
                $('#employeeName').val('');
                $('#password').val('');
                $('#userRole').val('');
                $('#modalTitle').text('Add New User');
                $('#userModal').show();
            });

            $('#userForm').submit(function(e) {
                e.preventDefault();
                const userId = $('#userId').val();

                if (userId) {
                    // Edit user
                    $.ajax({
                        url: '<?= site_url('admin/edit_user') ?>',
                        type: 'POST',
                        data: {
                            id: userId,
                            username: $('#username').val(),
                            employee_name: $('#employeeName').val(),
                            password: $('#password').val(),
                            role: $('#userRole').val()
                        },
                        success: function(response) {
                            const result = JSON.parse(response);
                            if (result.success) {
                                alert(result.message);
                                location.reload();
                            } else {
                                alert('Error: ' + result.message);
                            }
                        }
                    });
                } else {
                    // Add user
                    addUser();
                }
            });
            $(window).click(function(e) {
            if (e.target.id == 'userModal') {
                $('#userModal').hide();
            }
        });
       
    // // Add export button to the Series Details section
    // $('.card.recent-series h2').first().after(
    //     '<button id="showExportModal" class="generate-btn" style="margin-left: 10px;">' +
    //     '<i class="fas fa-file-export"></i> Export Data</button>'
    // );
    
    // Show export modal
    $('#showExportModal').on('click', function() {
        $('#exportModal').show();
    });

    // Replace the existing exportForm submit handler with this updated version
$('#exportForm').on('submit', function(e) {
    e.preventDefault();
    
    const format = $('#exportFormat').val();
    const columns = [];
    const searchTerm = $('input[name="search"]').val(); // Get current search term
    
    $('input[type="checkbox"]:checked').each(function() {
        columns.push($(this).val());
    });
    
    if (!format) {
        alert('Please select an export format');
        return;
    }
    if (columns.length === 0) {
        alert('Please select at least one column to export');
        return;
    }
    
    // Show loading message
    const $submitBtn = $(this).find('button[type="submit"]');
    const originalText = $submitBtn.html();
    $submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Exporting...');
    
    $.ajax({
        url: '<?= site_url("admin/export_filtered_series") ?>',
        type: 'POST',
        data: {
            format: format,
            columns: columns,
            search: searchTerm // Include search term in the request
        },
        success: function(response) {
            try {
                const result = JSON.parse(response);
                if (result.success) {
                    // Create temporary link and trigger download
                    const link = document.createElement('a');
                    link.href = result.file;
                    link.download = result.filename;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    
                    // Show success message
                    alert('File exported successfully!');
                    $('#exportModal').hide();
                } else {
                    alert('Export failed: ' + result.message);
                }
            } catch (e) {
                alert('Export failed: Invalid response format');
                console.error(e);
            }
        },
        error: function(xhr, status, error) {
            alert('Export failed: ' + error);
            console.error(xhr.responseText);
        },
        complete: function() {
            // Reset button text
            $submitBtn.html(originalText);
        }
    });
});

    // Close export modal when clicking outside
    $(window).click(function(e) {
        if (e.target.id === 'exportModal') {
            $('#exportModal').hide();
        }
    });

    // Remove any existing export button initialization
    $('.remove-export-btn').remove();
});
// Add this code after the existing document.ready function in dashboard.php
$(document).ready(function() {
    // Convert the search form to use real-time search
    $('input[name="search"]').on('input', function() {
        const searchTerm = $(this).val();
        performSearch(searchTerm);
    });

    // Remove the form submission event
    $('form[action*="admin/index"]').on('submit', function(e) {
        e.preventDefault();
    });

    // Function to handle the search
    function performSearch(searchTerm) {
        $.ajax({
            url: '<?= site_url("admin/search_series") ?>',
            type: 'GET',
            data: {
                search: searchTerm,
                page: 0
            },
            success: function(response) {
                try {
                    const result = JSON.parse(response);
                    
                    // Update the table body
                    $('.table-responsive table tbody').html(result.html);
                    
                    // Update pagination
                    $('.pagination-container').html(result.pagination);
                    
                    // Update the URL without reloading the page
                    const newUrl = new URL(window.location.href);
                    if (searchTerm) {
                        newUrl.searchParams.set('search', searchTerm);
                    } else {
                        newUrl.searchParams.delete('search');
                    }
                    window.history.pushState({}, '', newUrl);
                    
                } catch (e) {
                    console.error('Error parsing search results:', e);
                }
            },
            error: function(xhr, status, error) {
                console.error('Search failed:', error);
            }
        });
    }

    // Handle pagination clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const page = $(this).attr('href').split('page=')[1] || 0;
        const searchTerm = $('input[name="search"]').val();
        
        $.ajax({
            url: '<?= site_url("admin/search_series") ?>',
            type: 'GET',
            data: {
                search: searchTerm,
                page: page
            },
            success: function(response) {
                const result = JSON.parse(response);
                $('.table-responsive table tbody').html(result.html);
                $('.pagination-container').html(result.pagination);
            }
        });
    });
});
$(document).ready(function() {
            // Tab switching
            $('.tab-button').click(function() {
                const tabId = $(this).data('tab');
                
                // Update active states
                $('.tab-button').removeClass('active');
                $(this).addClass('active');
                
                // Show/hide content with animation
                $('.tab-content').removeClass('active');
                $(`#${tabId}-tab`).addClass('active');
            });
        });
        $(document).ready(function() {
    // Function to refresh users data
    function refreshUsersData() {
        $.ajax({
            url: '<?= site_url("admin/get_users_data") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let tableBody = '';
                    let serial = 1;
                    
                    response.users.forEach(function(user) {
                        tableBody += `
                            <tr>
                                <td>${serial++}</td>
                                <td>${user.username}</td>
                                <td>${user.employee_name}</td>
                                <td>${user.role}</td>
                                <td>${user.created_at}</td>
                                <td>
                                    <button onclick="editUser(${user.id})" class="btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteUser(${user.id})" class="btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    
                    $('#users-tab .table tbody').html(tableBody);
                } else {
                    console.error('Failed to refresh users:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    // Modified tab click handler
    $('.tab-button').click(function() {
        const tabId = $(this).data('tab');
        
        // Update active states
        $('.tab-button').removeClass('active');
        $(this).addClass('active');
        
        // Show/hide content with animation
        $('.tab-content').removeClass('active');
        $(`#${tabId}-tab`).addClass('active');
        
        // Refresh users data when users tab is clicked
        if (tabId === 'users') {
            refreshUsersData();
        }
       
    });
});
// Product Management - Updated version
$(document).ready(function() {
    // Show add product modal
    $('#addProductBtn').off('click').on('click', function() {
        $('#productId').val('');
        $('#productName').val('');
        $('#productModalTitle').text('Add New Product');
        $('#productModal').show();
    });

    // Handle product form submission
    $('#productForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        const productId = $('#productId').val();
        const productName = $('#productName').val();

        $.ajax({
            url: '<?= site_url('admin/' + (productId ? 'edit_product' : 'add_product')) ?>',
            type: 'POST',
            data: {
                id: productId,
                product_name: productName
            },
            success: function(response) {
                try {
                    const result = JSON.parse(response);
                    if (result.success) {
                        alert(result.message);
                        $('#productModal').hide();
                        refreshProducts();
                    } else {
                        alert('Error: ' + (result.message || 'Failed to save product'));
                    }
                } catch (e) {
                    console.error('Parse error:', e);
                    alert('Error processing response');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
                alert('Failed to save product: ' + error);
            }
        });
    });

    // Initial load of products
    refreshProducts();
});

function refreshProducts() {
    $.ajax({
        url: '<?= site_url('admin/get_products_data') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Products response:', response); // Debug log
            
            if (response.success && response.products) {
                if (response.products.length > 0) {
                    let tableBody = '';
                    let serial = 1;
                    
                    response.products.forEach(function(product) {
                        tableBody += `
                            <tr>
                                <td>${serial++}</td>
                                <td>${escapeHtml(product.product_name)}</td>
                                <td>
                                    <button onclick="editProduct(${product.id})" class="btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteProduct(${product.id})" class="btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    
                    $('#product-tab .table tbody').html(tableBody);
                } else {
                    $('#product-tab .table tbody').html('<tr><td colspan="3" style="text-align: center;">No products found</td></tr>');
                }
            } else {
                $('#product-tab .table tbody').html('<tr><td colspan="3" style="text-align: center;">Error loading products</td></tr>');
                console.error('Invalid response format:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
            $('#product-tab .table tbody').html('<tr><td colspan="3" style="text-align: center;">Failed to load products</td></tr>');
        }
    });
}

function editProduct(id) {
    $.ajax({
        url: '<?= site_url('admin/get_product') ?>',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.product) {
                $('#productId').val(response.product.id);
                $('#productName').val(response.product.product_name);
                $('#productModalTitle').text('Edit Product');
                $('#productModal').show();
            } else {
                alert('Error loading product details');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
            alert('Failed to load product details');
        }
    });
}

function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        $.ajax({
            url: '<?= site_url('admin/delete_product') ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message || 'Product deleted successfully');
                    refreshProducts();
                } else {
                    alert('Error: ' + (response.message || 'Failed to delete product'));
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
                alert('Failed to delete product');
            }
        });
    }
}

// Helper function to escape HTML and prevent XSS
function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
    </script>    
</html>
    