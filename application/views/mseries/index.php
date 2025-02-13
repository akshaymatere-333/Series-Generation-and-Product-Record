<!DOCTYPE html>
<html>
<head>
    <title>M-Series Management - Sahyadri Farm Machinery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
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
        }
        .delete-btn {
        background: #ff4444;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .delete-btn:hover {
        background: #cc0000;
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
.pagination-container {
    margin-top: 20px;
    text-align: center;
}

.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

.pagination a, .pagination strong {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border: 1px solid #ddd;
    margin: 0 4px;
}

.pagination strong {
    background-color: var(--primary-color);
    color: white;
    border: 1px solid var(--primary-color);
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
}
    </style>
</head>
<body>
    <div class="header">
        <div class="header-title">M-Series Management</div>
        <a href="<?= site_url('auth/logout') ?>" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="container">
        <div class="card series-generator">
            <h2>Series Number Generator</h2>
            <p>Select a product to generate a unique series number</p>
            
            <select class="product-select" id="productSelect">
                <option value="">Select Product</option>
                <?php foreach($products as $product): ?>
                    <option value="<?= $product->id ?>"><?= $product->product_name ?></option>
                <?php endforeach; ?>
            </select>
            
            <button class="generate-btn" id="generateBtn">
                <i class="fas fa-sync-alt"></i> Generate Series Number
            </button>
            
            <div id="seriesNumber" class="series-number" style="display: none;"></div>
        </div>

        <div class="card recent-series">
            <h3>Recently Generated Series Numbers</h3>
            <table>
            
    <thead>
        <tr>
        <th>Sr No.</th>
            <th class="sortable" data-sort="series_number">Series Number</th>
            <th class="sortable" data-sort="product_name">Product</th>
            <th class="sortable" data-sort="created_at">Generated On</th>
            
        </tr>
    </thead>
    <tbody>
    <?php $serial = 1; // Start serial number from 1 ?>

        <?php foreach($recent_series as $series): ?>
            <tr>
            <td><?php echo $serial++; // Automatically increment the serial number ?></td>

                <td><?= $series->series_number ?></td>
                <td><?= $series->product_name ?></td>
                <td><?= date('d M Y H:i', strtotime($series->created_at)) ?></td>
                <!-- <td>
                    <button class="delete-btn" data-series-id="<?= $series->id ?>">
                        <i class="fas fa-trash"></i>
                    </button> 
                
                </td>-->
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>
<div class="pagination-container">
    <?php if (!empty($pagination)): ?>
        <div class="pagination">
            <?php echo $pagination; ?>
        </div>
    <?php endif; ?>
</div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Generate Series Number
    $('#generateBtn').on('click', function() {
        const productId = $('#productSelect').val();
        if(!productId) {
            alert('Please select a product');
            return;
        }

        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Generating...');

        $.ajax({
            url: '<?= site_url('mseries/generate_series') ?>',
            type: 'POST',
            data: { product_id: productId },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    $('#seriesNumber').html(response.series_number).hide().fadeIn();
                    $('#seriesNumber').css('display', 'inline-block');
                    location.reload();
                }
            },
            complete: function() {
                $('#generateBtn').prop('disabled', false).html('<i class="fas fa-sync-alt"></i> Generate Series Number');
            }
        });
    });

    // Delete Series Number
    $('.delete-btn').click(function() {
        const seriesId = $(this).data('series-id');
        const row = $(this).closest('tr');

        if(confirm('Are you sure you want to delete this series number?')) {
            $.ajax({
                url: '<?= site_url('mseries/delete_series') ?>',
                type: 'POST',
                data: { series_id: seriesId },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        row.fadeOut(300, function() { 
                            $(this).remove(); 
                        });
                    } else {
                        alert(response.message || 'Failed to delete series number');
                    }
                },
                error: function() {
                    alert('An error occurred while deleting the series number');
                }
            });
        }
    });

    // Sorting Functionality
    $('.sortable').click(function() {
        const table = $(this).closest('table');
        const tbody = table.find('tbody');
        const rows = tbody.find('tr').get();
        const sortColumn = $(this).data('sort');
        const isAscending = !$(this).hasClass('sorted-asc');

        rows.sort(function(a, b) {
            const aValue = $(a).find(`td:eq(${$(this).index()})`.replace('this', '')).text().trim();
            const bValue = $(b).find(`td:eq(${$(this).index()})`.replace('this', '')).text().trim();
            
            return isAscending 
                ? aValue.localeCompare(bValue) 
                : bValue.localeCompare(aValue);
        }.bind(this));

        $.each(rows, function(index, row) {
            tbody.append(row);
        });

        table.find('.sortable').removeClass('sorted-asc sorted-desc');
        $(this).addClass(isAscending ? 'sorted-asc' : 'sorted-desc');
    });
});
</script>
</body>
</html>