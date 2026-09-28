<?php
require __DIR__ . '/../src/Allmyles/Client.php';
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Allmyles PHP SDK</title>
<style>body{font:16px/1.6 system-ui,sans-serif;max-width:650px;margin:12vh auto;padding:0 24px;color:#203047}h1{line-height:1.2}code{background:#f1f4f7;padding:3px 6px;border-radius:4px}small{color:#586777}</style></head>
<body><h1>Allmyles PHP SDK</h1><p>The PHP library is loaded and ready.</p><p><code><?php echo htmlspecialchars(ALLMYLES_VERSION, ENT_QUOTES, 'UTF-8'); ?></code></p><p>This repository is an API client library, not a web application. To use live travel services, instantiate the client with your Allmyles API URL and authentication key.</p><small>Run the unit tests with <code>docker compose -f docker-compose.base44.yml run --rm test</code>.</small></body>
</html>
