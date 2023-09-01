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
                    <h2 class="text-2xl font-bold text-teal-700">
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
                            <tr onclick="openModal()" class="{{ $statusClass }}">
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


            <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
                <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-xl font-semibold">IT230001 - Laptop</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <div class="flex justify-center">
                            <div class="border py-4 rounded-lg grid grid-cols-2 w-full">
                                <!-- Left Grid (Labels) -->
                                <div class="pl-20">
                                    <p class="font-semibold">Item Code:</p>
                                    <p class="font-semibold">Inventory ID:</p>
                                    <p class="font-semibold">Item Name:</p>
                                    <p class="font-semibold">Category:</p>
                                    <p class="font-semibold">Brand:</p>
                                    <p class="font-semibold">Model:</p>
                                    <p class="font-semibold">Price:</p>
                                    <p class="font-semibold">Serial Number:</p>
                                    <p class="font-semibold">Quantity:</p>
                                    <p class="font-semibold">Status:</p>

                                    <!-- Add more labels as needed -->
                                </div>

                                <!-- Right Grid (Data) -->
                                <div class="pl-8">
                                    <p class="">IT230001</p>
                                    <p class="">LT-0001</p>
                                    <p class="">Laptop</p>
                                    <p class="">Device</p>
                                    <p class="">Lenovo</p>
                                    <p class="">X250</p>
                                    <p class="">40,000</p>
                                    <p class="">4CE0460D0G</p>
                                    <p class="">1</p>
                                    <p class="">Deployed</p>
                                </div>
                                <div>
                                </div>
                                <!--Footer-->
                                <div class="flex justify-end pt-2">
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

                        const openModal = () => {
                            modal.classList.remove('fadeOut');
                            modal.classList.add('fadeIn');
                            modal.style.display = 'flex';
                        }

                        for (let i = 0; i < closeButton.length; i++) {

                            const elements = closeButton[i];

                            elements.onclick = (e) => modalClose();

                            modal.style.display = 'none';

                            window.onclick = function(event) {
                                if (event.target == modal) modalClose();
                            }
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
</body>


</html>