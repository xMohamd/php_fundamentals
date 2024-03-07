<?php
require_once "vendor/autoload.php";

$db = new DBHandler();
$fields = ["id", "PRODUCT_code", "Photo", "product_name"];
$items = array();

$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$totalItems = 16;
$perPage = 5;
$totalPages = ceil($totalItems / $perPage);

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["click"])) {
  if ($_GET["click"] == "prev") {
    $page = max($page - 1, 0);
  } else if ($_GET["click"] == "next") {
    $page = min($page + 1, $totalPages - 1);
  }
}

if ($db->connect()) {
  $items = $db->get_data($fields, $page * $perPage);
}

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["name_column"]) && isset($_GET["value"])) {
  $items = $db->search_by_column($_GET["name_column"], $_GET["value"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      background-color: #ddd;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    table {
      width: 50%;
      margin: 20px auto;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #999;
      padding: 10px;
      text-align: left;
      background-color: #f2f2f2;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .pagination {
      margin-top: 20px;
      text-align: center;
    }

    .pagination a {
      color: #000;
      padding: 8px 12px;
      text-decoration: none;
      border: 1px solid #ddd;
      margin-right: 5px;
    }

    .pagination a:hover {
      background-color: #f2f2f2;
      cursor: pointer;
    }

    form {
      margin-bottom: 20px;
      text-align: center;
    }

    form label {
      font-weight: bold;
      margin-right: 5px;
    }

    form select,
    form input[type="text"] {
      padding: 5px;
      margin-right: 10px;
    }

    form button,
    form a {
      padding: 5px 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      text-decoration: none;
    }

    form button:hover,
    form a:hover {
      background-color: #3e8e41;
    }
  </style>
</head>

<body>
  <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="name_column">Search Column:</label>
    <select name="name_column" id="name_column">
      <?php foreach ($fields as $field) { ?>
        <option value="<?php echo $field; ?>"><?php echo $field; ?></option>
      <?php } ?>
    </select>
    <label for="value">Search Value:</label>
    <input type="text" name="value" id="value" required>
    <button type="submit">Search</button>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Show All</a>
  </form>
  <?php
  if (count($items) > 0) {
    echo '<table>';
    echo '<tr>';
    foreach ($fields as $field) {
      echo '<th>' . $field . '</th>';
    }
    echo '</tr>';

    foreach ($items as $item) {
      echo '<tr>';
      foreach ($fields as $field) {
        echo '<td>' . $item->$field . '</td>';
      }
      echo '<td><a href="getInfoGlasses.php/?id=' . $item->id . '">More</a></td>';
      echo '</tr>';
    }
    echo '</table>';
    echo '<div class="pagination">';
    if ($page > 0) {
      echo "<a href='?click=prev&page=$page'>Prev</a>";
    }
    if ($page < $totalPages - 1) {
      echo "<a href='?click=next&page=$page'>Next</a>";
    }
    echo '</div>';
  }
  ?>
</body>

</html>

<?php
$db->disconnect();
?>