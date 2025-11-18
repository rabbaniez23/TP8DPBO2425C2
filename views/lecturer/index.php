<?php include 'views/layouts/header.php'; ?>

<h2>Daftar Dosen</h2>
<div class="col-1 my-3">
    <a type="button" class="btn btn-primary nav-link active" href="index.php?controller=lecturer&action=create">Add New</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>NIDN</th>
            <th>PHONE</th>
            <th>JOIN DATE</th>
            <th>ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // $lecturers didapat dari controller
        if ($lecturers->num_rows > 0) {
            while ($row = $lecturers->fetch_assoc()) {
                echo "
                <tr>
                    <th>{$row['id']}</th>
                    <td>{$row['name']}</td>
                    <td>{$row['nidn']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['join_date']}</td>
                    <td>
                        <a class='btn btn-success' href='index.php?controller=lecturer&action=edit&id={$row['id']}'>Edit</a>
                        <a class='btn btn-danger' href='index.php?controller=lecturer&action=delete&id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                    </td>
                </tr>
                ";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No lecturers found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'views/layouts/footer.php'; ?>