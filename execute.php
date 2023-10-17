<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $javascript = $_POST["javascript"];

  try {
    ob_start();
    
    echo '<html>
            <head>
              <title>JavaScript Execution Result</title>
            </head>
            <body>
              <script type="text/javascript">' . $javascript . '</script>
            </body>
          </html>';

    $output = ob_get_clean();
    
    header("Content-Type: text/html");
    echo $output;
  } catch (Throwable $error) {
    header("HTTP/1.1 400 Bad Request");
    header("Content-Type: application/json");
    echo json_encode(["error" => $error->getMessage()]);
  }
}
?>
