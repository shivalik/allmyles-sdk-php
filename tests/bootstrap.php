<?php
// Bootstrap for PHPUnit: the source files use manual require() chains
// rather than PSR-4 autoloading (class files live in Classes/ but namespaces
// don't include that segment), so we load them via Client.php's require chain.
require __DIR__ . '/../src/Allmyles/Client.php';
