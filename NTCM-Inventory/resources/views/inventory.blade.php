<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inventory</title>

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
</style>

<body class="bg-gray-100 py-2">

    @include('components.sidebar')

    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Inventory List
                    </h2>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-xl text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">Status <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
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
                    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
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
                            $statusText = 'On Stock';
                            $statusClass = 'bg-green-500';
                            } else if ($item->item_status == 1) {
                            $statusText = 'Borrowed';
                            $statusClass = 'bg-orange-500';
                            } else if ($item->item_status == 2) {
                            $statusText = 'Deployed';
                            $statusClass = 'bg-blue-500';
                            }
                            @endphp
                            <tr onclick="openModal('{{ $item->item_id }}')" class="{{ $statusClass }}">
                                <td>{{ $item->item_id }}</td>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->model }}</td>
                                <td>{{ $item->current_quantity }}</td>
                                <td class="px-6 py-4 text-gray-900">
                                    <span class="{{ $statusClass }} text-gray-50 rounded-xl px-2 py-1">{{ $statusText }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <!--/Card-->


            </div>
            <!--/container-->


            <div class="main-modal fixed w-full h-100  inset-0 z-50 flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
                <div class="modal-container bg-white w-3/6 rounded-xl z-50">
                    <div class="modal-content py-4 text-left px-6 max-h-screen overflow-y-auto">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-xl font-semibold" name="title" id="title">Item Name</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" id="exitButton" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <div class="flex justify-center">
                            <div class="border rounded-lg w-full">
                                <form action="#" class="relative bg-white">
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <div class="grid grid-cols-6 gap-6">

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="inventory-id" class="block mb-2 text-sm font-medium text-gray-900">Inventory
                                                    ID</label>
                                                <input type="text" name="inventory-id" id="inventory-id" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="LT-0001" required="" disabled>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="item-code" class="block mb-2 text-sm font-medium text-gray-900 ">Item
                                                    Code</label>
                                                <input type="text" name="item-code" id="item-code" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="IT230001" required="" disabled>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="item-brand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                                                <input type="text" name="item-brand" id="item-brand" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="Lenovo" required="" disabled>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="item-model" class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                                                <input type="text" name="item-model" id="item-model" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="X250" required="" disabled>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Serial
                                                    Number:</label>
                                                <input type="text" name="item-serial" id="item-serial" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="4CE0460D0G" required="" disabled>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="item-currentQuantity" class="block mb-2 text-sm font-medium text-gray-900 ">Quantity</label>
                                                <input type="Number" name="item-currentQuantity" id="item-currentQuantity" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="20" required="" disabled>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="item-price" class="block mb-2 text-sm font-medium text-gray-900 ">Price:</label>
                                                <input type="Number" name="item-price" id="item-price" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="40,000" required="" disabled>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="item-remarks" class="block mb-2 text-sm font-medium text-gray-900 ">Remarks:</label>
                                                <input type="Text" name="item-remarks" id="item-remarks" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="Returned by Ronald" required="" disabled>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="item-category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                                <select data-te-select-init data-te-select-filter="true" name="item-category" id="item-category" class="shadow-sm bg-red-500 bg-custom-color block w-full p-2.5  editable-input" disabled>
                                                    @foreach ($categories as $item)
                                                    <option value="{{ substr($item->category_name, 0, 3) }}">{{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="supplier-name" class="block mb-2 text-sm font-medium text-gray-900">Supplier</label>
                                                <select data-te-select-init data-te-select-filter="true" name="supplier-name" id="supplier-name" class="shadow-sm w-full p-2.5  editable-input" disabled>
                                                    @foreach ($suppliers as $item)
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Item
                                                    Description:</label>
                                                <textarea name="item-name" id="item-name" class="min-h-16 resize-y shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="Description" required="" disabled></textarea>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="Status" class="block mb-2 text-sm font-medium text-gray-900 ">Status:</label>
                                                <ul class="grid grid-cols-4 gap-x-5">

                                                    <li class="">

                                                        <input class="peer sr-only editable-input" type="radio" value="0" name="answer" id="yes" disabled />

                                                        <label class="text-xs flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-white focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-green-500 peer-checked:bg-green-50 transition-all duration-200 ease-in-out" for="yes">Spare</label>

                                                    </li>

                                                    <li class="">

                                                        <input class="peer sr-only editable-input" type="radio" value="1" name="answer" id="no" disabled />

                                                        <label class="text-xs flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-white focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:bg-blue-50 transition-all duration-200 ease-in-out" for="no">Deployed</label>

                                                    </li>

                                                    <li class="">

                                                        <input class="peer sr-only editable-input" type="radio" value="2" name="answer" id="yesno" disabled />

                                                        <label class="text-xs flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-white focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-orange-500 peer-checked:bg-orange-50 transition-all duration-200 ease-in-out " for="yesno">Borrowed</label>
                                                    </li>

                                                    <li class="">

                                                        <input class="peer sr-only editable-input" type="radio" value="3" name="answer" id="yesnono" disabled />

                                                        <label class="text-xs flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-white focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-red-500 peer-checked:bg-red-50 transition-all duration-200 ease-in-out " for="yesnono">Defect</label>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>


                                        <div class=" w-full">

                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex space-x-2 border-t border-gray-200 rounded-b">
                                            <div class=" w-full flex justify-end pt-4">
                                                <a class="mr-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">Delete</a>
                                                <a class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center" id="editButton">Edit</a>
                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">Save</button>

                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


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

                const openModal = (itemId) => {
                    // Fetch item details based on the itemId using an API call
                    fetch(`/api/getItemDetails/${itemId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Populate the modal with the fetched item details
                                modal.querySelector('#item-remarks').value = data.item.remarks;
                                modal.querySelector('#item-code').value = data.item.item_id;
                                modal.querySelector('#inventory-id').value = data.item.inventory_id;
                                modal.querySelector('#item-brand').value = data.item.brand;
                                modal.querySelector('#item-name').value = data.item.description;
                                modal.querySelector('#item-category').value = data.item.category;
                                modal.querySelector('#item-model').value = data.item.model;
                                modal.querySelector('#item-price').value = data.item.price;
                                modal.querySelector('#item-serial').value = data.item.serial_num;
                                modal.querySelector('#item-currentQuantity').value = data.item.current_quantity;
                                modal.querySelector('#supplier-name').value = data.item.supplier_name;
                                modal.querySelector('#title').textContent = data.item.item_name;
                
                                // Check item_status and perform actions accordingly
                                const itemStatus = data.item.item_status;
                                if (itemStatus === 0) {
                                    document.getElementById('yes').checked = true;
                                } else if (itemStatus === 1) {
                                    document.getElementById('yesno').checked = true;
                                } else if (itemStatus === 2) {
                                    document.getElementById('no').checked = true;
                                } else if (itemStatus === 3) {
                                    document.getElementById('yesnono').checked = true;
                                }

                                modal.classList.remove('fadeOut');
                                modal.classList.add('fadeIn');
                                modal.style.display = 'flex';
                            } else {
                                // Handle error if item details cannot be fetched
                                console.error('Error fetching item details.');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching item details:', error);
                        });
                }

                for (let i = 0; i < closeButton.length; i++) {
                    const elements = closeButton[i];
                    elements.onclick = (e) => modalClose();
                    modal.style.display = 'none';
                }

                window.onclick = function(event) {
                    if (event.target == modal) modalClose();
                }
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
        // JavaScript to toggle the disabled attribute for all input fields
        const inputFields = document.querySelectorAll('.editable-input');
        const editButton = document.getElementById('editButton');
        const exitButton = document.getElementById('exitButton');

        // Initialize the button text to "Edit"
        let isEditing = false;

        editButton.addEventListener('click', () => {
            inputFields.forEach(inputField => {
                inputField.disabled = isEditing;
            });

            // Change the text of the button based on the state
            if (isEditing) {
                editButton.textContent = 'Edit';
            } else {
                editButton.textContent = 'Stop Editing';
            }

            // Toggle the editing state
            isEditing = !isEditing;
        });

        exitButton.addEventListener('click', () => {
            inputFields.forEach(inputField => {
                inputField.disabled = true; // Disable the input fields
            });
            editButton.textContent = 'Edit'; // Reset the "Edit" button text
            isEditing = false; // Reset the editing state
        });
    </script>
    
     <!-- Tailwind Elements Script -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>


</html>