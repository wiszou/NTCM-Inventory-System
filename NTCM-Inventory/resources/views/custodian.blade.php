<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custodian</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />

    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    @vite('resources/css/app.css')
    <!-- Styles -->
</head>

<style>
/*Overrides for Tailwind CSS */

/*Form fields*/
.dataTables_wrapper select,
.dataTables_wrapper .dataTables_filter input {
    color: #4a5568;
    /*text-gray-700*/
    padding-left: 1rem;
    /*pl-4*/
    padding-right: 1rem;
    /*pl-4*/
    padding-top: .5rem;
    /*pl-2*/
    padding-bottom: .5rem;
    /*pl-2*/
    line-height: 1.25;
    /*leading-tight*/
    border-width: 1px;
    /*border-2*/
    border-radius: .25rem;
    border-color: #4d4d4d;
    /*border-gray-200*/
    background-color: #ffffff;
    /*bg-gray-200*/
}

/*Row Hover*/
table.dataTable.hover tbody tr:hover,
table.dataTable.display tbody tr:hover {
    background-color: #4facb6;
    /*bg-indigo-100*/
    color: #ffffff;
    font-weight: 400;
}


/*Pagination Buttons*/
.dataTables_wrapper .dataTables_paginate .paginate_button {
    font-weight: 500;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    border: 1px solid transparent;
    /*border border-transparent*/
}

/*Pagination Buttons - Current selected */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    color: #5c5c5c !important;
    /*text-white*/
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    /*shadow*/
    font-weight: 200;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    background: #d6d6d6 !important;
    /*bg-indigo-500*/
    border: 1px solid transparent;
    /*border border-transparent*/
}

/*Pagination Buttons - Hover */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    color: #ffffff;
    /*text-white*/
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    /*shadow*/
    font-weight: 400;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    background: #d6d6d6 !important;
    /*bg-indigo-500*/
    border: 1px;
    /*border border-transparent*/

}


/*Change colour of responsive icon*/
table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
    background-color: #4facb6 !important;
    /*bg-indigo-500*/
}


th {
    text-align: left;
    /* Align header text to the left */
}

td {
    text-align: left;
    /* Align cell text to the left */
}

input[disabled] {
    background-color: #E9ECEF;
    /* Change the text color to gray */

}
</style>

<body class="bg-gray-100 py-2">

    @include('components.sidebar')

    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Custodian Forms Archives
                    </h2>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-xl text-sm px-5 py-2.5 text-center inline-flex items-center"
                        type="button">Status <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-xl shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" id="allStatus" class="block px-4 py-2 hover:bg-gray-100">All</a>
                            </li>
                            <li>
                                <a href="#" id="spareStatus" class="block px-4 py-2 hover:bg-gray-100 ">Spare</a>
                            </li>
                            <li>
                                <a href="#" id="deployedStatus" class="block px-4 py-2 hover:bg-gray-100">Deployed</a>
                            </li>
                            <li>
                                <a href="#" id="borrowedStatus" class="block px-4 py-2 hover:bg-gray-100">Borrowed</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!--Card-->
                <div id='recipients' class="p-8 lg:mt-0 rounded shadow bg-white">
                    <table id="example" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead class="">
                            <tr>
                                <th data-priority="1">Item Code</th>
                                <th data-priority="2">Item Name</th>
                                <th data-priority="3">Brand</th>
                                <th data-priority="4">Model</th>
                                <th data-priority="5">Quantity</th>
                                <th data-priority="6">Status</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTableBody">
                            @foreach ($inventory as $item)
                            @php
                            $statusText = '';
                            $statusClass = '';

                            if ($item->item_status == 0) {
                            $statusText = 'Spare';
                            $statusClass = 'bg-green-500';
                            } else if ($item->item_status == 2) {
                            $statusText = 'Borrowed';
                            $statusClass = 'bg-orange-500';
                            } else if ($item->item_status == 1) {
                            $statusText = 'Deployed';
                            $statusClass = 'bg-blue-500';
                            }
                            else if ($item->item_status == 3) {
                            $statusText = 'Defect';
                            $statusClass = 'bg-red-500';
                            }

                            @endphp
                            <tr onclick="openModal('{{ $item->item_id }}')" class="{{ $statusClass }}">
                                <td>{{ $item->item_id }}</td>
                                <td>{{ $item->brand }}-{{ $item->model }}-{{ $item->serial_num }}</td>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->model }}</td>
                                <td>{{ $item->current_quantity }}</td>
                                <td class="px-6 py-4 text-gray-900">
                                    <span
                                        class="{{ $statusClass }} text-gray-50 rounded-xl px-2 py-1">{{ $statusText }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <!--/Card-->


            </div>
            <!--/container-->


            <div class="main-modal fixed w-full h-100  inset-0 z-50 flex justify-center items-center animated fadeIn faster"
                style="background: rgba(0,0,0,.7);">
                <div class="modal-container bg-white w-2/6 rounded-xl z-50">
                    <div class="modal-content py-4 text-left px-6 max-h-screen overflow-y-auto">
                        <div class="">
                            <!--body-->
                            <div class="text-center p-5 flex-auto justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <h2 class="text-xl font-bold py-4 ">Form</h3>
                                    <p class="text-sm text-gray-500 px-8">If all the item from this is returned. Click</p>
                            </div>
                            <!--footer-->
                            <div class="p-3  mt-2 text-center space-x-4 md:block">
                                <button
                                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                    Cancel
                                </button>
                                <button
                                    class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                <!-- jQuery -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

                <!--Datatables -->
                <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
                <script>
                $(document).ready(function() {

                    var table = $('#example').DataTable({
                            responsive: true
                        })
                        .columns.adjust()
                        .responsive.recalc();
                });
                </script>


                <script>
                const modal = document.querySelector('.main-modal');
                const closeButton = document.querySelectorAll('.modal-close');
                const modalClose = () => {
                    modal.classList.remove('fadeIn');
                    modal.classList.add('fadeOut');
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 0);
                }

                const openModal = () => {

                    modal.classList.remove('fadeOut');
                    modal.classList.add('fadeIn');
                    modal.style.display = 'flex';

                }

                for (let i = 0; i < closeButton.length; i++) {
                    const elements = closeButton[i];
                    elements.onclick = (e) => modalClose();
                    modal.style.display = 'none';
                }

                window.onclick = function(event) {
                    if (event.target == modal) modalClose();
                }

                document.getElementById('removeButton').addEventListener('click', function() {
                    // Assuming you have a variable with the item ID you want to remove
                    var itemId = this.value; // Replace with your actual item ID

                    // Send a POST request to the 'remove' route
                    axios.post('/remove-item/' + itemId)
                        .then(function(response) {
                            if (response.status === 200) {
                                // Handle success
                                console.log('Item removed successfully');
                            } else {
                                // Handle error
                                console.error('Error removing item');
                            }
                        })
                        .catch(function(error) {
                            // Handle network or other errors
                            console.error('Network error:', error);
                        });
                });
                </script>

            </div>
        </div>

        <script>
        $(document).ready(function() {
            // Function to show/hide rows based on the selected status
            function filterInventoryTable(statusClass) {
                $('#example tbody tr').hide(); // Hide all rows initially
                if (statusClass === 'all') {
                    $('#example tbody tr').show(); // Show all rows for "All" option
                } else {
                    $(`.${statusClass}`).show(); // Show rows with the selected status class
                }
            }

            // Initialize filtering with "All" status selected
            filterInventoryTable('all');

            // Handle status option clicks
            $('#allStatus').click(function() {
                filterInventoryTable('all');
            });

            $('#spareStatus').click(function() {
                filterInventoryTable('bg-green-500'); // Adjust the class as needed
            });

            $('#deployedStatus').click(function() {
                filterInventoryTable('bg-blue-500'); // Adjust the class as needed
            });

            $('#borrowedStatus').click(function() {
                filterInventoryTable('bg-orange-500'); // Adjust the class as needed
            });
        });
        </script>

        <script>
        const inputFields = document.querySelectorAll('.editable-input');
        const editButton = document.getElementById('editButton');
        const exitButton = document.getElementById('exitButton');
        const saveButton = document.getElementById('saveButton');
        saveButton.style.backgroundColor = 'grey';
        // Initialize the button text to "Edit"
        let isEditing = false;

        editButton.addEventListener('click', () => {
            inputFields.forEach(inputField => {
                inputField.disabled = isEditing;
            });

            // Change the text of the button based on the state
            if (isEditing) {
                editButton.textContent = 'Edit';
                saveButton.disabled = true; // Disable the "Save" button
                saveButton.style.backgroundColor = 'grey'; // Change the color to grey
            } else {
                editButton.textContent = 'Stop Editing';
                saveButton.disabled = false; // Enable the "Save" button
                saveButton.style.backgroundColor = ''; // Reset the color
            }

            // Toggle the editing state
            isEditing = !isEditing;
        });

        exitButton.addEventListener('click', () => {
            inputFields.forEach(inputField => {
                inputField.disabled = true; // Disable the input fields
            });
            editButton.textContent = 'Edit'; // Reset the "Edit" button text
            saveButton.disabled = true; // Disable the "Save" button
            saveButton.style.backgroundColor = 'grey'; // Change the color to grey
            isEditing = false; // Reset the editing state
        });
        </script>

        <!-- Tailwind Elements Script -->
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>


</html>