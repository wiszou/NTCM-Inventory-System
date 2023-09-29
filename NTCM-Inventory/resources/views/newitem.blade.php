<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Add Item</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <!-- Tailwind Elements CSS-->
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
                <!--Card-->
                <form id="item-form" class="relative rounded-md bg-white" method="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <h2 class="text-2xl font-bold text-ntccolor border-b">
                            Add Item
                        </h2>
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">
                                <label for="inventory-id" class="block mb-2 text-sm font-medium text-gray-900">Item
                                    Code</label>
                                <input type="text" name="inventory-id" id="inventory-id" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Auto Generated" disabled>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Serial
                                    Number:</label>
                                <input type="text" name="item-serial" id="item-serial" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="4CE0460D0G" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-dateE" class="block mb-2 text-sm font-medium text-gray-900">Date
                                    Acquired</label>
                                <input type="date" name="item-acquired" id="item-acquired" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="4CE0460D0G" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-dateE" class="block mb-2 text-sm font-medium text-gray-900">Date
                                    Expiration</label>
                                <input type="date" name="item-expired" id="item-expired" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="4CE0460D0G" required="">
                            </div>


                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-price" class="block mb-2 text-sm font-medium text-gray-900 ">Price:</label>
                                <input type="Number" name="price" id="item-price" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="40,000" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-model" class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                                <input type="text" name="model" id="item-model" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="X250" required="">
                            </div>
                            
                            <div class="col-span-6 sm:col-span-3">
                                <label for="supplier-name" class="block mb-2 text-sm font-medium text-gray-900">Supplier</label>
                                <select data-te-select-init data-te-select-filter="true" name="supplier-name" id="supplier-name" class="shadow-sm w-full p-2.5  editable-input" onchange="toggleCategorySelector()">
                                    <option selected hidden value="none">Select your option</option>
                                    @foreach ($suppliers as $item)
                                    <option value="{{ $item->supplier_id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                <select data-te-select-init data-te-select-filter="true" name="category" id="categorySelector" class="shadow-sm bg-custom-color block w-full p-2.5 editable-input" disabled onchange="toggleBrandSelector()">
                                    <option selected hidden value="none">Select your option</option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->category_id }}" data-specs="{{ $item->specs }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-brand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                                <select data-te-select-init data-te-select-filter="true" name="brand" id="brand" class="shadow-sm bg-custom-color block w-full p-2.5 editable-input" disabled>
                                    <option selected hidden value="none">Select your option</option>
                                    @foreach ($brand as $item)
                                    <option value="{{ $item->brand_id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-span-6 sm:col-span-3" hidden>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Status:</label>
                                <ul class="grid grid-cols-5 gap-x-5 mt-2">
                                    <li class="">
                                        <input class="peer sr-only editable-input" type="radio" value="Stock" name="item-status" id="yes" hidden CHECKED />
                                        <label class="text-xs flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-white focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:bg-blue-50 transition-all duration-200 ease-in-out" for="yes" hidden>Stock</label>
                                    </li>
                                </ul>
                            </div>


                            <div class="mt-3 col-span-6 sm:col-span-6 text-medium text-center font-medium border-dashed border-t-2 border-gray-300 pt-4" id="spacer" hidden>
                            Item Specification </div>

                            <div class="col-span-6 sm:col-span-3" id="cpuInput" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">CPU</label>
                                <input type="text" name="item-cpu" id="item-serial-cpu" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="I7 - 12300">
                            </div>


                            <div class="col-span-6 sm:col-span-3" id="gpuInput" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">GPU</label>
                                <input type="text" name="item-gpu" id="item-serial-gpu" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="GTX 3050">
                            </div>

                            <div class="col-span-6 sm:col-span-3" id="ramInput" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">RAM</label>
                                <input type="text" name="item-ram" id="item-serial-ram" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="8x2 16GB DDR4">
                            </div>

                            <div class="col-span-6 sm:col-span-3" id="storageInput" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">STORAGE</label>
                                <input type="text" name="item-storage" id="item-serial-storage" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="128GB SSD, 1TB HDD">
                            </div>

                        </div>



                        <!-- Modal footer -->
                        <div class="flex space-x-2 border-t border-gray-200 rounded-b">
                            <div class=" w-full flex justify-end pt-4">
                                <button type="submit" class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center">Add
                                    Item</button>
                            </div>
                        </div>
                </form>

            </div>
            <!--/container-->

            <!-- jQuery -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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
                const categorySelect = document.getElementById('categorySelector');
                const cpuInput = document.getElementById('cpuInput');
                const gpuInput = document.getElementById('gpuInput');
                const ramInput = document.getElementById('ramInput');
                const storageInput = document.getElementById('storageInput');
                const spacer = document.getElementById('spacer');

                categorySelect.addEventListener('change', function() {
                    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                    const specsValue = selectedOption.getAttribute('data-specs');
                    console.log(specsValue);

                    // Show or hide input fields based on specs value
                    if (specsValue === '1') {
                        cpuInput.removeAttribute('hidden');
                        gpuInput.removeAttribute('hidden');
                        ramInput.removeAttribute('hidden');
                        storageInput.removeAttribute('hidden');
                        spacer.removeAttribute('hidden');
                    } else {
                        cpuInput.setAttribute('hidden', true);
                        gpuInput.setAttribute('hidden', true);
                        ramInput.setAttribute('hidden', true);
                        storageInput.setAttribute('hidden', true);
                        spacer.setAttribute('hidden', true);
                    }
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

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('item-form');

                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // Prevent the default form submission

                        // Serialize form data
                        const formData = new FormData(form);

                        fetch('/insert-item', {
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
            </script>

            <!-- Tailwind Elements Script -->
            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
        </div>
    </div>
</body>

<script>
    function toggleCategorySelector() {
        var supplierSelect = document.getElementById("supplier-name");
        var categorySelect = document.getElementById("categorySelector");

        if (supplierSelect.value === "none") {
            categorySelect.disabled = true;
            console.log("test1");
        } else {
            categorySelect.disabled = false;
            console.log("test1");
        }

    }
</script>

<script>
    function toggleBrandSelector() {
        var categorySelect = document.getElementById("categorySelector");
        var brandSelect = document.getElementById("brand");

        if (categorySelect.value === "none") {
            brandSelect.disabled = true;
        } else {
            brandSelect.disabled = false;
        }
    }
</script>

</html>