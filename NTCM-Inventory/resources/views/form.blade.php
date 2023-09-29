<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Custodian Form</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!--Replace with your tailwind.css once created-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />

    @vite('resources/css/app.css')
    <!-- Styles -->


    <script>
    function printBothDivs(divIds) {
        var printContents = '';

        for (var i = 0; i < divIds.length; i++) {
            var divId = divIds[i];
            var divContent = document.getElementById(divId).innerHTML;

            // Create a new page with the div's content
            var page = '<html><head><title>Print</title></head><body>' + divContent + '</body></html>';

            printContents += page;

            // Add a page break if it's not the last div
            if (i < divIds.length - 1) {
                printContents += '<div style="page-break-before: always;"></div>';
            }
        }

        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;

        window.print();

        // Restore the original contents
        document.body.innerHTML = originalContents;
    }
    </script>

</head>

<body class="h-screen w-full bg-gray-100 text-black">
    <input type="button" onclick="printBothDivs(['printableArea1', 'printableArea2'])" value="Print"
        class="bg-ntccolor px-3 py-4" />



    <div class="w-full flex flex-col items-center">


        <div class="w-1/2 bg-white pt-10 px-10 mb-8 pb-16 flex">
            <!-- PAPER 1 -->

            <!--PRINTABLE AREA 1 -->
            <div class="w-full px-6" id="printableArea1">
                <div class="mx-auto w-full bg-white mt-3">
                    <div class="flex justify-between">
                        <div>
                            <img src="/assets/Logosidebar.png" class="h-20" />
                        </div>

                        <div class="pt-6">
                            <p class="text-right text-xl font-medium">CUSTODIAN FORM</p>
                            <p class="text-right text-lg">IT Equipment</p>
                            <p class="text-right text-2xl"><br /></p>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div>
                            <p class="underline underline-offset-4 py-4 mt-18">September 13, 2023</p>

                            <table class="table-auto mt-3">
                                <tbody>
                                    <tr>
                                        <td class="text-normal font-medium">Equipment Custodian:</td>
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

                    <div class="mt-16 pr-4">
                        <p class="text-justify text-sm text-black font-medium">I agree & accept the following NMFPI
                            guidelines
                            governing the issuance of Information Technology equipment to me:</p>

                        <p class="mt-2 pl-5 text-justify text-sm text-black">1. The said equipment(s) as detailed and
                            defined by
                            Attachment A is not an employee benefit but a “tool of the trade” which means that because
                            of
                            the
                            current function, NMFPI Management recognizes the need for this kind of equipment to carry
                            out
                            the
                            job efficiently.</p>

                        <p class="mt-1 pl-5 text-justify text-sm text-black">2. It is NMFPI Management’s sole
                            prerogative,
                            through an authorized representative to replace, upgrade or in some instances, require the
                            return of
                            the said equipment as it deems necessary in relation to the function.</p>

                        <p class="mt-1 pl-5 text-justify text-sm text-black">3. The employee commits to take care of the
                            item(s)
                            at all times and keep it safe to avoid damage or loss including but not limited to physical
                            state
                            and/or software content</p>

                        <p class="mt-1 pl-5 text-justify text-sm text-black">4. When the item(s) become defective for
                            some
                            reason or another, the employee is obliged to report the said problem to the Information
                            Technology
                            Team thru the CS Supervisor for IT or Corporate Services Manager. It is under the discretion
                            of
                            the
                            Corporate Services Manager to decide the course of action to take regarding the repair of
                            the
                            equipment. In the event that parts are needed for replacement, charging of such replacement
                            will
                            be
                            under the discretion of the Finance and Corporate Services Manager.</p>

                        <p class="mt-1 pl-5 text-justify text-sm text-black">5. In case of loss, it is the employee’s
                            responsibility to reimburse NMFPI the full acquisition cost (including but not limited to
                            the
                            hardware, software and/or peripherals installed or attached) or replace the equipment with a
                            fully
                            functional one subject to the approval of the Corporate Services Manager.</p>

                        <p class="mt-1 pl-5 text-justify text-sm text-black">6. In case of separation or sea service
                            leave,
                            the
                            employee undertakes to surrender voluntarily to the Information Technology Team all of the
                            listed
                            items in good working condition for clearance purposes.</p>
                    </div>

                    <div class="mt-24 pr-4">
                        <table class="w-full table-fixed border text-sm">
                            <thead>
                                <tr class="text-left border border-black">
                                    <th class="border border-black w-54 pl-1">Accepted/Received By:</th>
                                    <th class="border border-black pl-1">Issued By:</th>
                                    <th class="border pl-1 border-black">Noted By:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr">
                                    <td class="border-x border-black pt-16"></td>
                                    <td class="border-r  border-black pt-16"></td>
                                    <td class="border-x pt-16 border-black"></td>
                                    </tr>
                                    <tr>
                                        <td class="border-x border-black pl-1">(Signature Over Printed Name)</td>
                                        <td class="border-x border-black pl-1">IT Representative</td>
                                        <td class="border-x border-black pl-1">Deputy Director</td>
                                    </tr>
                                    <tr class="border border-black">
                                        <td class="border border-black pl-1">Date:</td>
                                        <td class="border border-black pl-1">Date:</td>
                                        <td class="border border-black pl-1">Date:</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PRINTABLE AREA 1-->
        </div> <!-- END PAPER 1 -->



        <div class="w-1/2 bg-white pt-10 py-10 px-10 mb-8 flex">
            <!-- PAPER 2 -->

            <!--PRINTABLE AREA 2 -->
            <div class="w-full px-6" id="printableArea2">
                <div class="mx-auto w-full bg-white mt-3">
                    <div class="flex justify-between">
                        <div>
                            <img src="/assets/Logosidebar.png" class="h-20" />
                        </div>

                        <div class="pt-6">
                            <p class="text-right text-xl font-medium">CUSTODIAN FORM</p>
                            <p class="text-right text-lg">IT Equipment</p>
                            <p class="text-right text-2xl"><br /></p>
                        </div>
                    </div>


                    <div>
                        <p class="font-medium text-center">IT EQUIPMENT - ATTACHMENT A</p>
                    </div>

                    <div class="mt-4 pr-3">
                    <p class="font-bold text-left mb-3">Remarks:<span class="font-normal pl-1">For Q.A. Audit Officer Use</span></p>
                        <table class="w-full table-fixed border text-sm">
                            <thead>
                                <tr class="border border-black text-center">
                                    <th class="border border-black w-54 pl-1 w-10">No.</th>
                                    <th class="border border-black pl-1 w-28">Item Code:</th>
                                    <th class="border pl-1 border-black w-32">Item Name:</th>
                                    <th class="border pl-1 border-black w-48">Serial Number:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-black text-center">
                                    <td class="border border-black">1</td>
                                    <td class="border border-black">IT-0001</td>
                                    <td class="border border-black">Laptop</td>
                                    <td class="border border-black">J34HG53L04J</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-black">2</td>
                                    <td class="border border-black">IT-0001</td>
                                    <td class="border border-black">Mouse</td>
                                    <td class="border border-black">H2HG2H34FK2L-KJ</td>
                                </tr>
                                <tr class="border border-black text-center">
                                    <td class="border border-black">3</td>
                                    <td class="border border-black">IT-0001</td>
                                    <td class="border border-black">Charger</td>
                                    <td class="border border-black">JH1GDS23FGGF</td>

                                </tr>
                                <tr class="border border-black text-center">
                                    <td class="border border-black">4</td>
                                    <td class="border border-black">IT-0001</td>
                                    <td class="border border-black">Bag</td>
                                    <td class="border border-black"></td>
     
                                </tr>
                                <tr class="border border-black text-center">
                                    <td class="border border-black">5</td>
                                    <td class="border border-black"></td>
                                    <td class="border border-black"></td>
                                    <td class="border border-black"></td>
          
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="mt-16  pr-4">
                        <table class="w-full table-fixed border text-sm">
                            <thead>
                                <tr class="text-left border border-black">
                                    <th class="border border-black w-54 pl-1">Accepted/Received By:</th>
                                    <th class="border border-black pl-1">Issued By:</th>
                                    <th class="border pl-1 border-black">Noted By:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr">
                                    <td class="border-x border-black pt-16"></td>
                                    <td class="border-r  border-black pt-16"></td>
                                    <td class="border-x pt-16 border-black"></td>
                                    </tr>
                                    <tr>
                                        <td class="border-x border-black pl-1">(Signature Over Printed Name)</td>
                                        <td class="border-x border-black pl-1">IT Representative</td>
                                        <td class="border-x border-black pl-1">Deputy Director</td>
                                    </tr>
                                    <tr class="border border-black">
                                        <td class="border border-black pl-1">Date:</td>
                                        <td class="border border-black pl-1">Date:</td>
                                        <td class="border border-black pl-1">Date:</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- END PRINTABLE AREA 2 -->
        </div> <!-- END PAPER 2 -->

    </div>
</body>

</html>