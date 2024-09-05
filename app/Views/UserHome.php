<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        .footer {
            background: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="home">
                        <h3>Dashboard</h3>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['user']['email']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Create New Text Block</h2>
        <form action="create" method="POST">
            <div class="mb-3">
                <label for="text_name" class="form-label">Text Name</label>
                <input type="text" class="form-control" id="text_name" name="text_name" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" required></textarea>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="h2">H2</option>
                    <option value="h5">H5</option>
                    <option value="p">Paragraph</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>

        <h2 class="mt-5">Existing Texts</h2>
        <ul class="list-group">
            <?php foreach ($texts as $text): ?>
            <li class="list-group-item">
                <strong><?= $text['text_name'] ?>:</strong> <?= $text['content'] ?>
                <a href="edit/<?= $text['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <form action="delete/<?= $text['id'] ?>" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="footer">
        <p>David Kezele @RELENTLESS</p>
        <p>Email: david.kezele@hotmail.com</p>
    </div>

    <!-- Include Bootstrap JavaScript and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
