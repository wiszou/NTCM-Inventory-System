<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IT Equipments</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />


    @vite('resources/css/app.css')
    <!-- Styles -->

    <script>
    function printDiv() {
        var divContents = document.getElementById("GFG").innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write('<html>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
    </script>

</head>

<body class="w-full h-screen text-black">

    <button onclick="printDiv()" type="submit"
        class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center">Add
        Item</button>


        <div class="h-[297mm] w-[210mm] p-12 pl-32" id="GFG">
  <div class="flex justify-between">
    <div>
      <img src="https://logo.clearbit.com/react.com" class="w-20" />
    </div>

    <div>
      <p class="text-right text-3xl font-medium">CUSTODIAN FORM</p>
      <p class="text-right text-xl">IT Equipment</p>
      <p class="text-right text-2xl"><br /></p>
    </div>
  </div>

  <div class="flex justify-between pt-16">
    <div>
      <p>September 13, 2023</p>

      <table class="table-auto">
        <tbody>
          <tr>
            <td class="text-normal font-medium">Equipment Custodian / Employee Name:</td>
            <td class="pl-3 underline underline-offset-4">Malcolm Lockyer</td>
          </tr>
          <tr>
            <td class="text-normal font-medium">Position / Function:</td>
            <td class="pl-3 underline underline-offset-4">Q.A. Audit Officer</td>
          </tr>
          <tr>
            <td class="text-normal font-medium">Department:</td>
            <td class="pl-3 underline underline-offset-4">Quality Assurance Department</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-12">
    <p class="text-justify text-sm text-black">I agree & accept the following NMFPI guidelines governing the issuance of Information Technology equipment to me:</p>

    <p class="mt-2 pl-5 text-justify text-sm text-black">1. The said equipment(s) as detailed and defined by Attachment A is not an employee benefit but a “tool of the trade” which means that because of the current function, NMFPI Management recognizes the need for this kind of equipment to carry out the job efficiently.</p>

    <p class="mt-1 pl-5 text-justify text-sm text-black">2. It is NMFPI Management’s sole prerogative, through an authorized representative to replace, upgrade or in some instances, require the return of the said equipment as it deems necessary in relation to the function.</p>

    <p class="mt-1 pl-5 text-justify text-sm text-black">3. The employee commits to take care of the item(s) at all times and keep it safe to avoid damage or loss including but not limited to physical state and/or software content</p>

    <p class="mt-1 pl-5 text-justify text-sm text-black">4. When the item(s) become defective for some reason or another, the employee is obliged to report the said problem to the Information Technology Team thru the CS Supervisor for IT or Corporate Services Manager. It is under the discretion of the Corporate Services Manager to decide the course of action to take regarding the repair of the equipment. In the event that parts are needed for replacement, charging of such replacement will be under the discretion of the Finance and Corporate Services Manager.</p>

    <p class="mt-1 pl-5 text-justify text-sm text-black">5. In case of loss, it is the employee’s responsibility to reimburse NMFPI the full acquisition cost (including but not limited to the hardware, software and/or peripherals installed or attached) or replace the equipment with a fully functional one subject to the approval of the Corporate Services Manager.</p>

    <p class="mt-1 pl-5 text-justify text-sm text-black">6. In case of separation or sea service leave, the employee undertakes to surrender voluntarily to the Information Technology Team all of the listed items in good working condition for clearance purposes.</p>
  </div>

  <div class="mt-10">
    <table class="text-normal w-full">
      <tbody>
        <thead class="text-center">
          <tr>
            <th>Accepted/Received By:</th>
            <th>Issued By:</th>
            <th>Noted By:</th>
          </tr>
        </thead>

        <tr class="text-center">
          <td class="text-normal under pt-10 font-normal"><span class="absolute mx-auto flex">________________________________</span></td>
          <td class="text-normal pt-10 font-normal">
            <span class="absolute mx-auto flex">________________________________</span>
            Mark Inovero
          </td>
          <td class="text-normal px-2 pt-10 font-normal">
            <span class="absolute mx-auto flex">________________________________</span>
            Capt. Knut Bentzrod
          </td>
        </tr>
        <tr class="text-center">
          <td class="w-2/6 text-sm font-normal">
          (Signature over printed name)</td>
          <td class="text-normal w-2/6 font-normal">IT Representative</td>
          <td class="text-normal w-2/6 font-normal">Deputy Director</td>
        </tr>

        <tr class="text-center">
          <td class="text-normal font-normal">Date: September 23, 2023</td>
          <td class="text-normal font-normal">Date: September 23, 2023</td>
          <td class="text-normal font-normal">Date: September 23, 2023</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>



</body>


</html>