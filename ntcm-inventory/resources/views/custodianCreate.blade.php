<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custodian Form</title>

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        Custodian Form
                    </h2>

                    <div>
                        <button id="open-modal-button" class="text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-xl text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">

                            <span>Create Form</span>
                        </button>

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
                </div>
                <!--Card-->
                <div id='recipients' class="p-8 lg:mt-0 rounded shadow bg-white">
                    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead class="">
                            <tr>
                                <th data-priority="1">Inventory ID</th>
                                <th data-priority="2">Current Holder</th>
                                <th data-priority="3">Item Name</th>
                                <th data-priority="4">Model</th>
                                <th data-priority="5">Quantity</th>
                                <th data-priority="6">Status</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTableBody">

                        </tbody>
                    </table>


                </div>
                <!--/Card-->


            </div>
            <!--/container-->


            <div class="main-modal fixed w-full h-100  inset-0 z-50 flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
                <div class="modal-container bg-white w-1/2 h-4/6  relative rounded-xl z-50">
                    <div class="modal-content py-4 text-left px-6 ">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-xl font-semibold" name="title" id="title">Custodian Form</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" id="exitButton" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <!--Body-->
                        <div class="flex justify-center  max-h-96 overflow-y-auto mt-4">
                            <div class="rounded-lg w-full">
                                <form id="create-form" action="/insert-custodian" method="post" class="relative bg-white">
                                    @csrf
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">

                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="custodian-name" class="block mb-2 text-sm font-medium text-gray-900">Employee</label>
                                                <select data-te-select-init data-te-select-filter="true" name="handlerName" id="handlerName" class="shadow-sm bg-custom-color block w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                </select>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="custodian-name" class="block mb-2 text-sm font-medium text-gray-900">Custodian
                                                    Type</label>
                                                <select data-te-select-init data-te-select-filter="true" name="type" id="type" class="shadow-sm bg-custom-color block w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                    <option value="Borrow">Borrow</option>
                                                    <option value="Deploy">Deploy</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="mt-3 col-span-6 sm:col-span-6 text-medium text-center font-medium border-dashed border-b-2 border-t-2 border-gray-300 py-2">
                                            Items</div>


                                        <div class="col-span-6 sm:col-span-3" bind>
                                            <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Item
                                                1 - Serial
                                                Number:</label>
                                            <select data-te-select-init data-te-select-filter="true" name="item1" id="item1" class="shadow-sm w-full p-2.5  editable-input" required="">
                                                <option value="none" selected hidden>Select your option</option>
                                                @foreach ($details as $item)
                                                <option value="{{ $item->item_id }}"> {{ $item->serial_num }} - {{ $item->item_id }} - {{ $item->model }}</option>
                                                @endforeach
                                            </select>

                                            <div class="col-span-6 sm:col-span-3 mt-3">
                                                <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Item
                                                    2 - Serial
                                                    Number:</label>
                                                <select data-te-select-init data-te-select-filter="true" name="item2" id="item2" class="shadow-sm w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                    @foreach ($details as $item)
                                                    <option value="{{ $item->item_id }}"> {{ $item->serial_num }} - {{ $item->item_id }} - {{ $item->model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 mt-3" bind>
                                                <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Item
                                                    3 - Serial
                                                    Number:</label>
                                                <select data-te-select-init data-te-select-filter="true" name="item3" id="item3" class="shadow-sm w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                    @foreach ($details as $item)
                                                    <option value="{{ $item->item_id }}"> {{ $item->serial_num }} - {{ $item->item_id }} - {{ $item->model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 mt-3">
                                                <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Item
                                                    4 - Serial
                                                    Number:</label>
                                                <select data-te-select-init data-te-select-filter="true" name="item4" id="item4" class="shadow-sm w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                    @foreach ($details as $item)
                                                    <option value="{{ $item->item_id }}"> {{ $item->serial_num }} - {{ $item->item_id }} - {{ $item->model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 mt-3" bind>
                                                <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Item
                                                    5 - Serial
                                                    Number:</label>
                                                <select data-te-select-init data-te-select-filter="true" name="item5" id="item5" class="shadow-sm w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                    @foreach ($details as $item)
                                                    <option value="{{ $item->item_id }}"> {{ $item->serial_num }} - {{ $item->item_id }} - {{ $item->model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="mt-3 col-span-6 sm:col-span-6 text-medium text-center font-medium border-dashed border-b-2 border-t-2 border-gray-300 py-2">
                                            Persons Involved </div>

                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3" bind>
                                                <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Accepted/Received
                                                    By:</label>
                                                <select data-te-select-init data-te-select-filter="true" name="handlerName2" id="handlerName2" class="shadow-sm w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3" bind>
                                                <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Issued
                                                    By:</label>
                                                <select data-te-select-init data-te-select-filter="true" name="issued" id="issued" class="shadow-sm w-full p-2.5 editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3" bind>
                                                <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Noted
                                                    By:</label>
                                                <select data-te-select-init data-te-select-filter="true" name="noted" id="noted" class="shadow-sm w-full p-2.5 editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->

                                        <div class="w-full justify-end flex space-x-2 border-t border-gray-200 rounded-b">
                                            <button type="submit" class="mt-4 mr-2 w-32 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center" id="/update-item">Create Form</button>
                                        </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                $(document).ready(function() {
                    // Initialize a counter to generate unique IDs
                    var divCount = 1;

                    // When the "Add Input" button is clicked
                    $("#add-input-button").click(function() {
                        // Clone the entire div with id="input-container"
                        var clonedDiv = $("#input-container").clone();

                        // Generate unique IDs for the cloned elements
                        clonedDiv.find('label[for^="item"]').each(function() {
                            var originalFor = $(this).attr('for');
                            var newFor = originalFor + '-' + divCount;
                            $(this).attr('for', newFor);
                        });

                        clonedDiv.find('select[name^="supplier-name"]').each(function() {
                            var originalName = $(this).attr('name');
                            var newName = originalName + '-' + divCount;
                            $(this).attr('name', newName);

                            var originalId = $(this).attr('id');
                            var newId = originalId + '-' + divCount;
                            $(this).attr('id', newId);
                        });

                        // Increment the counter
                        divCount++;

                        // Append the cloned div below the original one
                        $("#input-container").after(clonedDiv);
                    });
                });
            </script>






            <!-- Tailwind Elements Script -->
            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>


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
                    }, 1); // Adjust the delay as needed
                };

                const openModal = () => {
                    modal.classList.remove('fadeOut');
                    modal.classList.add('fadeIn');
                    modal.style.display = 'flex';
                };

                for (let i = 0; i < closeButton.length; i++) {
                    const element = closeButton[i];
                    element.onclick = (e) => modalClose();
                }

                // Get the button element by its ID
                const openModalButton = document.getElementById('open-modal-button');
                if (openModalButton) {
                    openModalButton.addEventListener('click', () => openModal());
                }

                // Initially hide the modal
                modal.style.display = 'none';

                window.onclick = function(event) {
                    if (event.target == modal) modalClose();
                };
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

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('create-form');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Serialize form data
                const formData = new FormData(form);

                fetch('/insert-custodian', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Handle a successful response (e.g., show success message)
                            alert('Item added successfully.');
                            // You can also reset the form or redirect to another page
                            location.reload();
                        } else {
                            // Handle errors (e.g., show error message)
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script> -->

</body>


</html>