
$(document).ready(function () {
    // Function to fetch and update inventory data
    function updateInventoryTable() {
        $.ajax({
            url: '/get-updated-inventory',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                const inventory = response.inventory;
                const tableBody = $('#inventoryTableBody');
                tableBody.empty(); // Clear the existing table rows

                // Loop through the inventory data and populate the table
                inventory.forEach(function (item) {
                    // Handle the item status in JavaScript
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
    setInterval(updateInventoryTable, 5000); // Update every 5 seconds (adjust as needed)
});