<?php include 'views/layouts/header.php'; ?>

<h2>Daftar Mata Kuliah</h2>
<div class="col-1 my-3">
    <a type="button" class="btn btn-primary nav-link active" href="index.php?controller=course&action=create">Add New</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAMA MATA KULIAH</th>
            <th>SKS</th>
            <th>DOSEN PENGAMPU</th>
            <th>ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // $courses didapat dari controller
        if ($courses->num_rows > 0) {
            while ($row = $courses->fetch_assoc()) {
                echo "
                <tr>
                    <th>{$row['id']}</th>
                    <td>{$row['course_name']}</td>
                    <td>{$row['sks']}</td>
                    <td>" . ($row['lecturer_name'] ? $row['lecturer_name'] : 'N/A') . "</td>
                    <td>
                        <a class='btn btn-success' href='index.php?controller=course&action=edit&id={$row['id']}'>Edit</a>
                        <a class='btn btn-danger' href='index.php?controller=course&action=delete&id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                    </td>
                </tr>
                ";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>No courses found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'views/layouts/footer.php'; ?>