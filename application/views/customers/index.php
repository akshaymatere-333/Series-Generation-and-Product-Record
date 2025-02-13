<!DOCTYPE html>
<html>
<head>
    <title>Customer Details - Sahyadri Farm Machinery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Reuse existing CSS styles from machines/index.php */
        /* Add additional styles for new fields */
        :root {
            --primary-color: #ff0000;
            --secondary-color: #cc0000;
            --background-color:rgb(227, 227, 227);
            --text-color: #333;
            --card-bg: white;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--primary-color);
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .logout-btn {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 25px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .series-generator {
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .product-select {
            width: 100%;
            max-width: 400px;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            margin-top:2%;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .product-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(255,0,0,0.1);
        }

        .generate-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 0 auto;
        }

        .generate-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,0,0,0.2);
        }

        .series-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 20px 0;
            padding: 20px;
            border: 3px dashed #e0e0e0;
            border-radius: 10px;
            display: inline-block;
            animation: fadeIn 0.5s ease-out;
        }

        .recent-series {
            margin-top: 40px;
        }

        .recent-series table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 10px;
        }

        .recent-series th,
        .recent-series td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .recent-series th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--text-color);
        }

        .recent-series tr:last-child td {
            border-bottom: none;
        }

        .recent-series tr:hover {
            background-color: #f9f9f9;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 10px;
            }

            .series-number {
                font-size: 1.5rem;
            }

            .recent-series {
                overflow-x: auto;
            }
            .search-row th {
            padding: 8px 4px;
        }
        
        .search-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(255,0,0,0.1);
        }
        
        /* Make table header sticky */
        .recent-series {
            max-height: 600px;
            overflow-y: auto;
        }
        
        .recent-series thead {
            position: sticky;
            top: 0;
            background: white;
            z-index: 1;
        }
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }
        
        .input-field {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
        }
        .sortable {
            cursor: pointer;
        }
   
        .sortable:hover {
            background-color: #f0f0f0;
        }
   
        .sortable::after {
            content: '↕';
            margin-left: 5px;
            opacity: 0.5;
        }
.btn-delete {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-delete:hover {
    background-color: #c0392b;
}

.btn-delete i {
    font-size: 0.9rem;
}
.btn-primary, .btn-warning, .btn-danger {
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin: 0 5px;
    border: none;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
}

.btn-warning {
    background: #ffc107;
    color: #000;
}

.btn-danger {
    background: #dc3545;
    color: white;
}

.btn-primary:hover, .btn-warning:hover, .btn-danger:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

.text-muted {
    color: #6c757d;
    font-style: italic;
}

strong {
    font-weight: 600;
    color: #333;
}

td {
    vertical-align: top;
}
    </style>
</head>
<body>
    <div class="header">
        <div class="header-title">Customer Details</div>
        <a href="<?= site_url('auth/logout') ?>" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="container">
        <div class="card">
            <h2 style="text-align:center;">Customer Registration Form</h2>
            <p style="text-align:center;">Fill in customer and purchaseDate details</p>
            
            <div class="form-grid">
                <select class="input-field" id="seriesSelect">
                    <option value="">Select Series Number</option>
                    <?php foreach($available_machines as $machine): ?>
                        <option value="<?= $machine->series_number ?>"><?= $machine->series_number ?></option>
                    <?php endforeach; ?>
                </select>
                
                <input type="text" class="input-field" id="productName" placeholder="Product Name" readonly>
                
                <input type="text" class="input-field" id="customerName" placeholder="Customer Name *">
                
                <input type="tel" class="input-field" id="phone" placeholder="Phone Number *" Validate>
                
                <input type="email" class="input-field" id="email" placeholder="Email *">
                
                <input type="text" class="input-field" id="dealer" placeholder="Dealer *">
                
                <input type="date" class="input-field" id="purchaseDate" placeholder="Purchase Date *">
                
                <textarea class="input-field" id="address" placeholder="Address *" style="grid-column: span 2;"></textarea>
            </div>
            
            <button class="generate-btn" id="saveCustomerBtn">
                <i class="fas fa-save"></i> Save Customer Details
            </button>
        </div>

        <div class="card recent-series">
    <h3>Recent Customers</h3>
    <table>
        <thead>
            <tr>
            <th>Sr No.</th>
                <th>Series Number</th>
                <th>Product</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Dealer</th>
                <th>Purchase Date</th>
                <th>Added On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $serial = 1; // Start serial number from 1 ?>
            <?php foreach($recent_customers as $customer): ?>
                <tr data-id="<?= $customer->id ?>">
                <td><?php echo $serial++; // Automatically increment the serial number ?></td>
                    <td><?= $customer->machine_series ?></td>
                    <td><?= $customer->product_name ?></td>
                    <td><?= $customer->company_name ?></td>
                    <td><?= $customer->phone ?></td>
                    <td><?= $customer->email ?></td>
                    <td><?= $customer->dealer ?></td>
                    <td><?= date('d M Y', strtotime($customer->purchase_date)) ?></td>
                    <td><?= date('d M Y H:i', strtotime($customer->created_at)) ?></td>
                    <td>
                        <button class="btn-danger" onclick="deleteCustomer(<?= $customer->id ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
       function deleteCustomer(id) {
    if (confirm('Are you sure you want to delete this customer?')) {
        $.ajax({
            url: '<?= site_url('customers/delete_customer') ?>', // Ensure this matches the method name
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $(`tr[data-id="${id}"]`).remove();
                    alert('Customer deleted successfully');
                } else {
                    alert('Error: ' + response.message);
                }
            }
        });
    }
}
        function sortTable(table, column, isNumeric = false) {
    const tbody = table.find('tbody');
    const rows = tbody.find('tr').toArray();

    rows.sort((a, b) => {
        const aColText = $(a).find(`td:eq(${column})`).text().trim();
        const bColText = $(b).find(`td:eq(${column})`).text().trim();

        if (isNumeric) {
            return parseFloat(aColText) - parseFloat(bColText);
        }
        return aColText.localeCompare(bColText);
    });

    tbody.empty().append(rows);
}

$(document).ready(function() {
    $('.recent-series th').addClass('sortable');

    $('.recent-series th').click(function() {
        const table = $(this).closest('table');
        const columnIndex = $(this).index();
        const isNumeric = $(this).hasClass('numeric');
        sortTable(table, columnIndex, isNumeric);
    });
});
        function deleteCustomer(id) {
    if (confirm('Are you sure you want to delete this customer?')) {
        $.ajax({
            url: '<?= site_url('customers/delete_customer') ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $(`tr[data-id="${id}"]`).remove();
                    alert('Customer deleted successfully');
                } else {
                    alert('Error: ' + response.message);
                }
            }
        });
    }
}
        $(document).ready(function() {
            $('#seriesSelect').change(function() {
                const seriesNumber = $(this).val();
                if (seriesNumber) {
                    $.ajax({
                        url: '<?= site_url('customers/get_product_by_series') ?>',
                        type: 'POST',
                        data: { series_number: seriesNumber },
                        dataType: 'json',
                        success: function(response) {
                            $('#productName').val(response ? response.product_name : 'Product not found');
                        }
                    });
                } else {
                    $('#productName').val('');
                }
            });

            $('#saveCustomerBtn').click(function() {
                const data = {
                    series_number: $('#seriesSelect').val(),
                    customer_name: $('#customerName').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    address: $('#address').val(),
                    dealer: $('#dealer').val(),
                    purchase_date: $('#purchaseDate').val()
                };

                if (!data.series_number || !data.customer_name || !data.phone || 
                    !data.email || !data.address || !data.dealer || !data.purchase_date) {
                    alert('Please fill all required fields');
                    return;
                }

                $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

                $.ajax({
                    url: '<?= site_url('customers/save_customer') ?>',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert('Customer details saved successfully');
                            location.reload();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    complete: function() {
                        $('#saveCustomerBtn').prop('disabled', false)
                            .html('<i class="fas fa-save"></i> Save Customer Details');
                    }
                });
            });
        });
    </script>
</body>
</html>