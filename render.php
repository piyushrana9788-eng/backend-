<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/demos.php';
require_once __DIR__ . '/content.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // throw exceptions instead of warnings

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

/** Source code of a demo function, exactly as written in demos.php. */
function fn_source($fn)
{
    $r = new ReflectionFunction($fn);
    $lines = file($r->getFileName());
    $body = array_slice($lines, $r->getStartLine(), $r->getEndLine() - $r->getStartLine() - 1);
    $body = array_map(function ($l) { return preg_replace('/^    /', '', $l); }, $body);
    return rtrim(implode('', $body));
}

/** Run a demo and capture what it prints. Errors become a readable message. */
function run_demo($fn, $isDb)
{
    ob_start();
    try {
        $fn();
    } catch (Throwable $t) {
        ob_end_clean();
        $hint = $isDb
            ? 'Check DB_HOST, DB_USER, DB_PASS and DB_NAME in config.php, and run the "Connecting and Creating a Table" demo first.'
            : 'This function may be disabled on this server.';
        return '<p class="err">Could not run this demo: ' . e($t->getMessage()) . '</p><p>' . e($hint) . '</p>';
    }
    return ob_get_clean();
}

function render_table($rows)
{
    echo '<div class="tablewrap"><table class="grid"><thead><tr>';
    foreach (array_shift($rows) as $h) echo '<th>' . e($h) . '</th>';
    echo '</tr></thead><tbody>';
    foreach ($rows as $r) {
        echo '<tr>';
        foreach ($r as $i => $c) echo $i === 0 ? '<th scope="row">' . e($c) . '</th>' : '<td>' . e($c) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
}

function render_example($ex)
{
    echo '<figure class="example"><figcaption>' . e($ex['cap']) . '</figcaption>';
    if (isset($ex['demo'])) {
        echo '<pre class="code"><code>&lt;?php' . "\n" . e(fn_source($ex['demo'])) . '</code></pre>';
        $out = run_demo($ex['demo'], !empty($ex['db']));
        echo '<div class="output live"><span class="tag">Live output</span>';
        echo !empty($ex['raw']) ? '<div class="rawout">' . $out . '</div>' : '<pre>' . $out . '</pre>';
        echo '</div>';
    } else {
        echo '<pre class="code"><code>' . e($ex['code']) . '</code></pre>';
        if (!empty($ex['out'])) echo '<div class="output"><span class="tag">Expected result</span><p>' . e($ex['out']) . '</p></div>';
    }
    echo '</figure>';
}

function page_start($title, $active, $rail = null)
{
    global $UNITS, $PAGE_RAIL;
    $PAGE_RAIL = $rail;
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?> | Backend Web Development Assignment</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Source+Serif+4:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="top">
  <div class="top-row">
    <a class="brand" href="index.php">Backend Web Development: Assignment File</a>
    <button class="print" onclick="window.print()">Print or save as PDF</button>
  </div>
  <nav class="tabs" aria-label="Assignment sections">
    <a href="index.php" <?= $active === 'home' ? 'aria-current="page"' : '' ?>>Cover and contents</a>
  <?php foreach ($UNITS as $n => $u): ?>
    <a href="unit.php?n=<?= $n ?>" <?= $active === $n ? 'aria-current="page"' : '' ?>><span class="n" aria-hidden="true"><?= $n ?></span><span class="vh">Unit <?= $n ?>: </span><?= e($u['title']) ?></a>
  <?php endforeach; ?>
    <a href="end.php" <?= $active === 'end' ? 'aria-current="page"' : '' ?>>Conclusion and references</a>
  </nav>
</header>
<div class="shell<?= $rail ? '' : ' solo' ?>">
<main class="sheet">
<?php
}

function page_end()
{
    global $PAGE_RAIL;
    ?>
</main>
<?php if ($PAGE_RAIL): ?>
<aside class="rail" aria-label="On this page">
  <p>On this page</p>
  <ol>
  <?php foreach ($PAGE_RAIL as $href => $label): ?>
    <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
  <?php endforeach; ?>
  </ol>
</aside>
<?php endif; ?>
</div>
<footer class="foot">Backend Web Development assignment. Every output on these pages is produced live by PHP running on this server.</footer>
<script>
// Marks the topic being read in the "On this page" rail.
(function () {
  var links = document.querySelectorAll('.rail a');
  if (!links.length || !('IntersectionObserver' in window)) return;
  var map = {};
  links.forEach(function (a) { map[a.getAttribute('href').slice(1)] = a; });
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (en) {
      if (!en.isIntersecting) return;
      links.forEach(function (a) { a.removeAttribute('aria-current'); });
      map[en.target.id].setAttribute('aria-current', 'location');
    });
  }, { rootMargin: '-20% 0px -70% 0px' });
  Object.keys(map).forEach(function (id) { var el = document.getElementById(id); if (el) io.observe(el); });
})();
</script>
</body>
</html>
<?php
}
