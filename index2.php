<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir Basket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="index1.php" class="text-white text-lg font-semibold">Kehadiran</a>
                <a href="index2.php" class="text-white text-lg font-semibold">Anggota</a>
            </div>
            <div class="text-white text-lg font-semibold">Four Rival</div>
            <form action="index1.php" method="post" class="flex items-center space-x-2">
                <input type="text" name="cari" placeholder="Cari NISN atau Nama" class="px-2 py-1 rounded">
                <input type="submit" value="Cari" class="bg-white text-blue-600 px-3 py-1 rounded">
            </form>
        </div>
    </nav>

    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-6">Daftar Kehadiran</h2>
        <div class="bg-white shadow-md rounded p-6 mb-6">
            <form action="index2.php" method="post" class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Pilih tanggal kehadiran:</label>
                <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <input type="submit" value="Filter" class="bg-blue-600 text-white px-4 py-2 rounded mt-2">
            </form>
        </div>
        <div class="bg-white shadow-md rounded p-4">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="w-1/12 py-2">No.</th>
                        <th class="w-2/12 py-2">NISN</th>
                        <th class="w-2/12 py-2">Nama</th>
                        <th class="w-1/12 py-2">Kelas</th>
                        <th class="w-2/12 py-2">Jenis Kelamin</th>
                        <th class="w-2/12 py-2">Keterangan</th>
                        <th class="w-2/12 py-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";
                    
                    // Check if search keyword or date filter is set
                    $keyword = isset($_POST['cari']) ? $_POST['cari'] : '';
                    $date_filter = isset($_POST['date']) ? $_POST['date'] : '';

                    // Construct the query based on search and date filter options
                    if (!empty($date_filter)) {
                        $sql = "SELECT * FROM vkehadiran WHERE tanggal = '$date_filter' AND (NISN LIKE '%$keyword%' OR nama LIKE '%$keyword%')";
                    } else {
                        $sql = "SELECT * FROM vkehadiran WHERE NISN LIKE '%$keyword%' OR nama LIKE '%$keyword%'";
                    }

                    $result = $koneksi->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b'>";
                            echo "<td class='py-2 text-center'>$no</td>";
                            echo "<td class='py-2 text-center'>" . $row["NISN"] . "</td>";
                            echo "<td class='py-2 text-center'>" . $row["nama"] . "</td>";
                            echo "<td class='py-2 text-center'>" . $row["kelas"] . "</td>";
                            echo "<td class='py-2 text-center'>" . $row["jenis_kelamin"] . "</td>";
                            echo "<td class='py-2 text-center'>" . $row["keterangan"] . "</td>";
                            echo "<td class='py-2 text-center'>" . $row["tanggal"] . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='7' class='py-4 text-center'>Tidak ada data yang ditemukan.</td></tr>";
                    }

                    $koneksi->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
