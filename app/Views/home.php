<!DOCTYPE html>
<html lang="en">
<head>
  <title>David Kezele | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .fakeimg {
      height: 200px;
      background: #aaa;
    }
    .content {
      min-height: calc(100vh - 56px - 70px); /* Adjust based on navbar and footer height */
    }
    .footer {
      background: #343a40;
      color: #fff;
      padding: 20px;
      text-align: center;
      position: relative;
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
        <a class="nav-link active" href="home"><h3>David Kezele</h3></a>
      </li>
      <li class="nav-item">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == true): ?>
          <a class="nav-link" href="UserHome">UserHome</a>
        </li>
        <?php endif; ?>
    </ul>
  </div>
</nav>

<div class="container content mt-5">
  <div class="row">
    <div class="col-sm-4">
      <h2>BackEnd Developer</h2>
      <!-- IMAGE -->
      <div class="fakeimg">David Image</div>
      <!-- IMAGE -->
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
      <h3 class="mt-4">Want to know more?</h3>
      <p>Let me tell you my:</p>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#">Story</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Skills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Goals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">#</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <?php foreach ($texts as $text): ?>
        <<?= $text['type'] ?>><?= $text['text_name'] ?></<?= $text['type'] ?>>
        <p><?= $text['content'] ?></p>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="footer">
  <p>David Kezele @RELENTLESS</p>
  <p>Email: david.kezele@hotmail.com</p>
</div>

</body>
</html>
