<!-- venta de rangos -->

<body>
    <div class="container mx-auto mt-5">
        <h2 class="text-2xl font-bold mb-4">Ventas de rangos</h2>
        <table id="myTable" class="table-auto w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Edad</th>
                    <th class="px-4 py-2 border">País</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 border">1</td>
                    <td class="px-4 py-2 border">Juan Pérez</td>
                    <td class="px-4 py-2 border">28</td>
                    <td class="px-4 py-2 border">México</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border">2</td>
                    <td class="px-4 py-2 border">María López</td>
                    <td class="px-4 py-2 border">34</td>
                    <td class="px-4 py-2 border">Argentina</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border">3</td>
                    <td class="px-4 py-2 border">Carlos García</td>
                    <td class="px-4 py-2 border">41</td>
                    <td class="px-4 py-2 border">España</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new simpleDatatables.DataTable("#myTable");
        });
    </script>
</body>