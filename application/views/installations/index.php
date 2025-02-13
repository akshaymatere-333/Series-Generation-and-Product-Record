<!DOCTYPE html>
<html>
<head>
    <title>Installation Details - Sahyadri Farm Machinery</title>
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
            radius: 10px;
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
        }        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .table-responsive {
                overflow-x: auto;
            }
        }
        .btn-edit, .btn-delete {
    padding: 5px 10px;
    margin: 0 3px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-edit {
    background-color: #3498db;
    color: white;
}

.btn-delete {
    background-color: #e74c3c;
    color: white;
}

.btn-edit:hover, .btn-delete:hover {
    opacity: 0.8;
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
    </style>
</head>
<body>
    <div class="header">
        <div class="header-title">Installation Details</div>
        <a href="<?= site_url('auth/logout') ?>" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="container">
        <div class="card">
            <h2 style="text-align:center;">Installation Form</h2>
            <p style="text-align:center;">Fill in installation details</p>
            <div class="form-grid">
            <select class="input-field" id="seriesSelect">
    <option value="">Select Series Number</option>
    <?php foreach($customer_machines as $machine): ?>
        <option value="<?= $machine->series_number ?>" data-id="<?= $machine->id ?>">
            <?= $machine->series_number ?>
        </option>
    <?php endforeach; ?>
</select>
                
                <input type="text" class="input-field" id="productName" placeholder="Product Name" readonly>
                <input type="text" class="input-field" id="customerName" placeholder="Customer Name" readonly>
                <input type="text" class="input-field" id="customerPhone" placeholder="Customer Phone" readonly>
                
                <input type="date" class="input-field" id="installationDate" placeholder="Installation Date *">
                <input type="text" class="input-field" id="installedBy" placeholder="Installed By *">
                <input type="text" class="input-field" id="tractorName" placeholder="Tractor Name *">
                
                <select class="input-field" id="tractorHP">
                    <option value="">Select Tractor HP *</option>
                    <?php foreach($tractor_hp_options as $value => $label): ?>
                        <option value="<?= $value ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button class="generate-btn" id="saveInstallationBtn">
                <i class="fas fa-save"></i> Save Installation Details
            </button>
        </div>

        <div class="card recent-series">
    <h3>Recent Installations</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                <th>Sr No.</th>

                    <th class="sortable">Series Number</th>
                    <th class="sortable">Product</th>
                    <th class="sortable">Customer</th>
                    <th class="sortable">Installation Date</th>
                    <th class="sortable">Installed By</th>
                    <th class="sortable">Tractor Details</th>
                    <th class="sortable">Added On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $serial = 1; // Start serial number from 1 ?>
                <?php foreach($recent_installations as $install): ?>
                    <tr data-id="<?= $install->id ?>">
                    <td><?php echo $serial++; // Automatically increment the serial number ?></td>

                        <td><?= $install->series_number ?></td>
                        <td><?= $install->product_name ?></td>
                        <td><?= $install->company_name ?></td>
                        <td><?= date('d M Y', strtotime($install->installation_date)) ?></td>
                        <td><?= $install->installed_by ?></td>
                        <td><?= $install->tractor_name ?> (<?= $install->tractor_hp ?>)</td>
                        <td><?= date('d M Y H:i', strtotime($install->created_at)) ?></td>
                        <td>
                            <button class="btn-danger" onclick="deleteInstallation(<?= $install->id ?>)">
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
    $('.recent-series th').addClass('sortable');

    $('.recent-series th').click(function() {
        const table = $(this).closest('table');
        const columnIndex = $(this).index();
        const isNumeric = $(this).hasClass('numeric');
        sortTable(table, columnIndex, isNumeric);
    });
});
        $(document).ready(function() {
            let selectedMachineId = null;

            $('#seriesSelect').change(function() {
                const seriesNumber = $(this).val();
                selectedMachineId = $(this).find(':selected').data('id');
                
                if (seriesNumber) {
                    $.ajax({
                        url: '<?= site_url('installations/get_customer_details') ?>',
                        type: 'POST',
                        data: { series_number: seriesNumber },
                        dataType: 'json',
                        success: function(response) {
                            $('#productName').val(response.product_name);
                            $('#customerName').val(response.company_name);
                            $('#customerPhone').val(response.phone);
                        }
                    });
                } else {
                    $('#productName, #customerName, #customerPhone').val('');
                    selectedMachineId = null;
                }
            });

            $('#saveInstallationBtn').click(function() {
    if (!validateForm()) {
        alert('Please fill all required fields');
        return;
    }

    const machineId = $('#seriesSelect').find(':selected').data('id');
    if (!machineId) {
        alert('Please select a valid series number');
        return;
    }

    $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

    const data = {
        machine_id: machineId,
        installation_date: $('#installationDate').val(),
        installed_by: $('#installedBy').val(),
        tractor_name: $('#tractorName').val(),
        tractor_hp: $('#tractorHP').val()
    };

    $.ajax({
        url: '<?= site_url('installations/save_installation') ?>',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message);
                location.reload();
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error occurred while saving. Please try again.');
        },
        complete: function() {
            $('#saveInstallationBtn').prop('disabled', false)
                .html('<i class="fas fa-save"></i> Save Installation');
        }
    });
});

function validateForm() {
    const requiredFields = [
        '#installationDate',
        '#installedBy',
        '#tractorName',
        '#tractorHP'
    ];
    
    let valid = true;
    requiredFields.forEach(field => {
        if (!$(field).val()) {
            $(field).css('border-color', 'red');
            valid = false;
        } else {
            $(field).css('border-color', '#e0e0e0');
        }
    });
    
    if (!$('#seriesSelect').val()) {
        $('#seriesSelect').css('border-color', 'red');
        valid = false;
    } else {
        $('#seriesSelect').css('border-color', '#e0e0e0');
    }
    
    return valid;
}});

function editInstallation(id) {
    $.ajax({
        url: '<?= site_url('installations/get_installation') ?>',
        type: 'GET',
        data: { id: id },
        success: function(data) {
            const installation = JSON.parse(data);
            $('#installationDate').val(installation.installation_date);
            $('#installedBy').val(installation.installed_by);
            $('#tractorName').val(installation.tractor_name);
            $('#tractorHP').val(installation.tractor_hp);
            
            // Change save button to update mode
            $('#saveInstallationBtn')
                .html('<i class="fas fa-edit"></i> Update Installation')
                .attr('data-mode', 'update')
                .attr('data-id', id);
        }
    });
}

function deleteInstallation(id) {
    if (confirm('Are you sure you want to delete this installation?')) {
        $.ajax({
            url: '<?= site_url('installations/delete_installation') ?>',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    $(`tr[data-id="${id}"]`).remove();
                    alert('Installation deleted successfully');
                } else {
                    alert('Error: ' + result.message);
                }
            }
        });
    }
}

// Add this to your validateForm function
// function validateForm() {
//     if ($('#saveInstallationBtn').attr('data-mode') === 'update') {
//         // Different validation for update mode
//         return $('#installationDate').val() && 
//                $('#installedBy').val() && 
//                $('#tractorName').val() && 
//                $('#tractorHP').val();
//     }
    
//     // Original validation for new installation
//     return $('#seriesSelect').val() && 
//            $('#installationDate').val() && 
//            $('#installedBy').val() && 
//            $('#tractorName').val() && 
//            $('#tractorHP').val();
// }
</script>

   
    </script>
</body>
</html>