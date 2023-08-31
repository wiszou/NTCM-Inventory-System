<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100 py-2">
    @include('components.sidebar')
    <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
        <div class="relative mt-2 ml-2">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-80 pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-200" placeholder="Search for items">
        </div>
        <div class="mx-2">
            <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Item Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="py-3">
                            Edit
                        </th>
                    </tr>
                </thead>
                <tbody id="inventoryTableBody">

                </tbody>
            </table>
        </div>
    </div>

    <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">

        <div class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">

                <!--Title-->

                <div class="flex justify-between items-center pb-3">

                    <p class="text-2xl text-gray-700 font-bold w-full text-center">Delete Item</p>

                    <div class="modal-close cursor-pointer z-50">

                    </div>

                </div>

                <!--Body-->

                <div class="mb-5 mt-3 text-center">
                    <input type="hidden" id="itemCodeInput">
                    <p>Are you sure you want to delete this item?

                    </p>

                </div>

                <!--Footer-->

                <div class="flex justify-center pt-2">

                    <a class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</a>

                    <button onclick="confirmDelete()" class="focus:outline-none px-4 bg-red-500 p-3 ml-3 rounded-lg text-white hover:bg-red-700">Confirm</button>

                </div>

            </div>

        </div>

    </div>
    <script>
        $(document).ready(function() {

            function updateInventoryTable() {
                $.ajax({
                    url: '/get-updated-inventory',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const inventory = response.inventory;
                        const tableBody = $('#inventoryTableBody');
                        tableBody.empty();
                        inventory.forEach(function(item) {

                            let statusText = '';
                            let statusClass = '';

                            if (item.item_status == 0) {
                                statusText = 'On Stock';
                                statusClass = 'bg-green-500';
                            } else if (item.item_status == 1) {
                                statusText = 'Borrowed';
                                statusClass = 'bg-orange-500';
                            } else if (item.item_status == 2) {
                                statusText = 'Deployed';
                                statusClass = 'bg-blue-500';
                            }

                            const newRow = `
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-${item.item_id}" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-${item.item_id}" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row" class="pl-6 py-4 font-normal text-gray-900 dark:text-white whitespace-nowrap">
                                ${item.item_id}
                            </th>
                            <td class="px-6 py-4 text-gray-900">
                                ${item.brand}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                ${item.model}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                ${item.category}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                ${item.current_quantity}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                <span class="${statusClass} text-gray-50 rounded-xl px-2 py-1">${statusText}</span>
                            </td>
                            <td class="pr-8 py-4 text-middle">
                            <button onclick="openModal('${item.item_id}')"
class='bg-red-500 text-white p-2 rounded-xl text-2xl font-bold'>

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/> </svg>

</button>
                            </td>
                        </tr>
                    `;

                            tableBody.append(newRow);
                        });
                    }
                });
            }

            // Initial update when the page loads
            updateInventoryTable();

            // Set an interval to periodically update the inventory
            setInterval(updateInventoryTable, 2000); // Update every 5 seconds (adjust as needed)
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

            }, 500);

        }



        const openModal = (itemCode) => {
            modal.classList.remove('fadeOut');
            modal.classList.add('fadeIn');
            modal.style.display = 'flex';

            // Store the item code in a hidden input field within the modal
            const itemCodeInput = document.querySelector('#itemCodeInput');
            itemCodeInput.value = itemCode;
        }
        const confirmDelete = () => {
            const itemCodeInput = document.querySelector('#itemCodeInput');
            const itemCode = itemCodeInput.value;

            // Send AJAX request to delete the item
            $.ajax({
                url: `/remove-item/${itemCode}`,
                method: 'POST', // Use POST method here
                data: {
                    _token: '{{ csrf_token() }}'
                }, // Add CSRF token
                success: function(response) {
                    // Close the modal and update the inventory table
                    modalClose();
                    updateInventoryTable();
                }
            });
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
</body>

</html>