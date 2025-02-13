<!DOCTYPE html>
<html>
<head>
    <title>Machine Details - Sahyadri Farm Machinery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Reuse the same CSS from the previous M-Series index.php */
        
        :root {
            --primary-color: #ff0000;
            --secondary-color: #cc0000;
            --background-color:rgb(227, 227, 227);
            --text-color: #333;
            --card-bg: white;
        }

        * {
            margin: 0;
           justify-content: center;
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
            align-items: center;
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
            margin-left:8%;
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
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
        <div class="header-title">Machine Details</div>
        <a href="<?= site_url('auth/logout') ?>" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="container">
        <div class="card">
            <h2 style="text-align:center;">Machine Details Form</h2>
            <p style="text-align:center;">Fill in machine and pump details</p>
            
            <div class="form-grid">
            <select class="product-select" id="seriesSelect">
    <option value="">Select Series Number</option>
    <?php foreach($available_series as $series): ?>
        <option value="<?= $series->series_number ?>"><?= $series->series_number ?></option>
    <?php endforeach; ?>
</select>
                
                <input type="text" class="product-select" id="productName" placeholder="Product Name" readonly>
                
                <input type="text" class="product-select" id="pumpDetail" placeholder="Pump Detail">
                
                <input type="text" class="product-select" id="pumpMaker" placeholder="Pump Maker">
                
                <input type="text" class="product-select" id="pumpSeriesNo" placeholder="Pump Series Number">
            </div>
            
            <button class="generate-btn" id="saveDetailsBtn">
                <i class="fas fa-save"></i> Save Machine Details
            </button>
        </div>

        <div class="card recent-series">
        <h3>Recently Added Machines</h3>
        <table id="machinesTable">
            <thead>
                <tr>
                    <th class="sortable">Sr No.</th>
                    <th class="sortable" data-column="series_number">Series Number</th>
                    <th class="sortable" data-column="product_name">Product</th>
                    <th class="sortable" data-column="pump_detail">Pump Detail</th>
                    <th class="sortable" data-column="pump_maker">Pump Maker</th>
                    <th class="sortable" data-column="pump_series_no">Pump Series No</th>
                    <th class="sortable" data-column="created_at">Added On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <td>
            <?php $serial = 1; // Start serial number from 1 ?>                <?php foreach($recent_machines as $machine): ?>
                    <tr>
                    <td><?php echo $serial++; // Automatically increment the serial number ?></td>
                        <td><?= $machine->series_number ?></td>
                        <td><?= $machine->product_name ?></td>
                        <td><?= $machine->pump_detail ?></td>
                        <td><?= $machine->pump_maker ?></td>
                        <td><?= $machine->pump_series_no ?></td>
                        <td><?= date('d M Y H:i', strtotime($machine->created_at)) ?></td>
                        <td>
                            <button class="btn-danger" data-machine-id="<?= $machine->id ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
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
            
            $('#seriesSelect').change(function() {
        const seriesNumber = $(this).val();
        
        if (seriesNumber) {
            $.ajax({
                url: '<?= site_url('machines/get_product_by_series') ?>',
                type: 'POST',
                data: { series_number: seriesNumber },
                dataType: 'json',
                success: function(response) {
                    if (response && response.product_name) {
                        $('#productName').val(response.product_name);
                    } else {
                        $('#productName').val('Product not found');
                    }
                },
                error: function() {
                    $('#productName').val('Error fetching product');
                }
            });
        } else {
            $('#productName').val('');
        }
    });

    $('#saveDetailsBtn').click(function() {
        // Existing save details functionality
        const seriesNumber = $('#seriesSelect').val();
        const pumpDetail = $('#pumpDetail').val();
        const pumpMaker = $('#pumpMaker').val();
        const pumpSeriesNo = $('#pumpSeriesNo').val();

        // Comprehensive input validation
        if (!seriesNumber) {
            alert('Please select a series number');
            return;
        }
        if (!pumpDetail) {
            alert('Please enter pump details');
            return;
        }
        if (!pumpMaker) {
            alert('Please enter pump maker');
            return;
        }
        if (!pumpSeriesNo) {
            alert('Please enter pump series number');
            return;
        }

        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '<?= site_url('machines/save_machine_details') ?>',
            type: 'POST',
            data: {
                series_number: seriesNumber,
                pump_detail: pumpDetail,
                pump_maker: pumpMaker,
                pump_series_no: pumpSeriesNo
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Machine details saved successfully');
                    location.reload();
                } else {
                    alert('Error: ' + (response.message || 'Unknown error occurred'));
                    console.error(response);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response Text:', xhr.responseText);
                alert('Server error: ' + error);
            },
            complete: function() {
                $('#saveDetailsBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Machine Details');
            }
        });
    });

    // New sorting functionality with improved implementation
    $('#machinesTable').on('click', '.sortable', function() {
        const table = $('#machinesTable');
        const columnIndex = $(this).index();
        const rows = table.find('tbody > tr').get();
        
        // Determine sort direction
        const isAscending = $(this).data('sort-direction') !== 'asc';
        
        // Sort rows
        rows.sort(function(a, b) {
            const aValue = $(a).find('td').eq(columnIndex).text().trim();
            const bValue = $(b).find('td').eq(columnIndex).text().trim();
            
            return isAscending 
                ? aValue.localeCompare(bValue) 
                : bValue.localeCompare(aValue);
        });
        
        // Reinsert sorted rows
        table.find('tbody').empty().append(rows);
        
        // Update sort direction
        $(this).data('sort-direction', isAscending ? 'asc' : 'desc');
    });

    // Delete functionality with event delegation
    $('#machinesTable').on('click', '.btn-delete', function() {
        const machineId = $(this).data('machine-id');
        const $row = $(this).closest('tr');

        if (confirm('Are you sure you want to delete this machine?')) {
            $.ajax({
                url: '<?= site_url('machines/delete_machine/') ?>' + machineId,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $row.remove();
                        alert('Machine deleted successfully');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('Server error occurred');
                }
            });
        }
    });

            $('#seriesSelect').change(function() {
                const seriesNumber = $(this).val();
                
                if (seriesNumber) {
                    $.ajax({
                        url: '<?= site_url('machines/get_product_by_series') ?>',
                        type: 'POST',
                        data: { series_number: seriesNumber },
                        dataType: 'json',
                        success: function(response) {
                            if (response && response.product_name) {
                                $('#productName').val(response.product_name);
                            } else {
                                $('#productName').val('Product not found');
                            }
                        },
                        error: function() {
                            $('#productName').val('Error fetching product');
                        }
                    });
                } else {
                    $('#productName').val('');
                }
            });

            $('#saveDetailsBtn').click(function() {
    const seriesNumber = $('#seriesSelect').val();
    const pumpDetail = $('#pumpDetail').val();
    const pumpMaker = $('#pumpMaker').val();
    const pumpSeriesNo = $('#pumpSeriesNo').val();

    // Comprehensive input validation
    if (!seriesNumber) {
        alert('Please select a series number');
        return;
    }
    if (!pumpDetail) {
        alert('Please enter pump details');
        return;
    }
    if (!pumpMaker) {
        alert('Please enter pump maker');
        return;
    }
    if (!pumpSeriesNo) {
        alert('Please enter pump series number');
        return;
    }

    $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

    
});

        });
       
    </script>
</body>
</html>