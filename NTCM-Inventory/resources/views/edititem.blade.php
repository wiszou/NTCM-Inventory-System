<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Item</title>

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
                <form action="/update-item" class="relative rounded-md bg-white" method="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <h2 class="text-2xl font-bold text-ntccolor border-b">
                            Edit Item : {{ $dataitem->model}}-{{$dataitem->serial_num}}
                        </h2>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="inventory-id" class="block mb-2 text-sm font-medium text-gray-900">Item Code</label>
                                <input type="text" name="inventory-id" id="inventory-id" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="{{ $dataitem->item_id }}" disabled>
                                <input name="id" value="{{$dataitem->item_id}}" hidden>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-brand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                                <select data-te-select-init data-te-select-filter="true" name="item-brand" id="category" class="shadow-sm bg-red-500 bg-custom-color block w-full p-2.5 editable-input">
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->brand_id }}" {{ $dataitem->brand_id == $brand->brand_id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-model" class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                                <input type="text" name="item-model" id="item-model" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" value="{{ $dataitem->model }}" placeholder="X250" required="">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Serial
                                    Number:</label>
                                <input type="text" name="item-serial" id="item-serial" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" value="{{ $dataitem->serial_num }}" placeholder="4CE0460D0G" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-price" class="block mb-2 text-sm font-medium text-gray-900 ">Price:</label>
                                <input type="Number" name="item-price" id="item-price" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" value="{{ $dataitem->price }}" placeholder="40,000" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                <select data-te-select-init data-te-select-filter="true" name="item-category" id="category" class="shadow-sm bg-red-500 bg-custom-color block w-full p-2.5  editable-input">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ $dataitem->category_id == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="supplier-name" class="block mb-2 text-sm font-medium text-gray-900">Supplier</label>
                                <select data-te-select-init data-te-select-filter="true" name="supplier-name" id="supplier-name" class="shadow-sm w-full p-2.5  editable-input">
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->supplier_id }}" {{ $dataitem->supplier_id == $supplier->supplier_id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($dataitem->item_status != 'Deployed' && $dataitem->item_status != 'Borrowed')
                            <div class="col-span-6 sm:col-span-3">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status:</label>
                                <ul class="grid grid-cols-4 gap-x-5 mt-3">
                                    <li class="">
                                        <input class="peer sr-only editable-input" type="radio" value="Spare" name="item-status" id="yes" {{ $dataitem->item_status === 'Spare' ? 'checked' : '' }} />
                                        <label class="text-xs flex justify-center cursor-not-allowed rounded-full border border-gray-300 py-2 px-4 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:bg-blue-50 transition-all duration-200 ease-in-out" for="yes" {{ $dataitem->item_status !== 'Spare' ? 'disabled' : '' }}>Spare</label>
                                    </li>
                                    <li class="">
                                        <input class="peer sr-only editable-input" type="radio" value="Stock" name="item-status" id="no" {{ $dataitem->item_status === 'Stock' ? 'checked' : '' }} />
                                        <label class="text-xs flex justify-center cursor-pointer rounded-full border border-gray-300 py-2 px-4 hover:bg-white focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-green-500 peer-checked:bg-green-50 transition-all duration-200 ease-in-out" for="no">Stock</label>
                                    </li>
                                    <li class="">
                                        <input class="peer sr-only editable-input" type="radio" value="Defect" name="item-status" id="yesno" {{ $dataitem->item_status === 'Defect' ? 'checked' : '' }} />
                                        <label class="text-xs flex justify-center cursor-pointer rounded-full border border-gray-300 py-2 px-4 hover:bg-white focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-red-500 peer-checked:bg-red-50 transition-all duration-200 ease-in-out" for="yesno">Defect</label>
                                    </li>

                                </ul>
                            </div>
                            @endif
                        </div>


                        <div class=" w-full">

                        </div>
                        <!-- Modal footer -->
                        <div class="flex space-x-2 border-t border-gray-200 rounded-b">
                            <div class=" w-full flex justify-end pt-4">
                                <button type="submit" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center mr-2">Delete</button>
                                <button type="submit" class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center">Update</button>


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

            <!-- Tailwind Elements Script -->
            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
        </div>
    </div>
</body>


</html>