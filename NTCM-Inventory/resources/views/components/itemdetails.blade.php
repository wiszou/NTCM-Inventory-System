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
        @foreach ($brands as $item)
        @php
        $quantity = DB::table('t_inventory')
        ->where('category_id', $category_id)
        ->where('brand_id', $item->brand_id)
        ->count();

        @endphp
        <tr onclick="openModal()">

            <td>{{ $item->brand_id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $quantity }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>

</table>