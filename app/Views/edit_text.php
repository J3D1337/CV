<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Text</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Edit Text Block</h2>
  <form action="update/<?= $text['id'] ?>" method="POST">
    <div class="mb-3">
      <label for="text_name" class="form-label">Text Name</label>
      <input type="text" class="form-control" id="text_name" name="text_name" value="<?= $text['text_name'] ?>" required>
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">Content</label>
      <textarea class="form-control" id="content" name="content" required><?= $text['content'] ?></textarea>
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <select class="form-select" id="type" name="type">
        <option value="h2" <?= $text['type'] === 'h2' ? 'selected' : '' ?>>H2</option>
        <option value="h5" <?= $text['type'] === 'h5' ? 'selected' : '' ?>>H5</option>
        <option value="p" <?= $text['type'] === 'p' ? 'selected' : '' ?>>Paragraph</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>

</body>
</html>
