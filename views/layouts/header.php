<?php
// views/layouts/header.php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="bootstrap.min.css" rel="stylesheet">
    
    <title>Praktikum MVC</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?controller=lecturer&action=index">Sistem Akademik</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=lecturer&action=index">Dosen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=course&action=index">Mata Kuliah</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-4">