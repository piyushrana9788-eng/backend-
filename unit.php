<?php
require_once __DIR__ . '/includes/render.php';

$n = isset($_GET['n']) ? (int)$_GET['n'] : 1;
if (!isset($UNITS[$n])) {
    http_response_code(404);
    $n = 1;
}
$u = $UNITS[$n];
$rail = [];
foreach ($u['topics'] as $k => $t) $rail['#t-' . $t['id']] = $n . '.' . ($k + 1) . ' ' . $t['title'];
page_start('Unit ' . $n . ': ' . $u['title'], $n, $rail);
?>
<header class="unit-head">
  <p class="kicker">Unit <?= $n ?></p>
  <h1><?= e($u['title']) ?></h1>
  <p class="aim"><strong>Aim.</strong> <?= e($u['aim']) ?></p>
  <ul class="jump">
    <?php foreach ($u['topics'] as $k => $t): ?>
      <li><a href="#t-<?= e($t['id']) ?>"><?= $n ?>.<?= $k + 1 ?> <?= e($t['title']) ?></a></li>
    <?php endforeach; ?>
  </ul>
</header>

<?php foreach ($u['topics'] as $k => $t): ?>
<section class="topic" id="t-<?= e($t['id']) ?>">
  <h2><span class="num"><?= $n ?>.<?= $k + 1 ?></span> <?= e($t['title']) ?></h2>
  <?php foreach ($t['text'] as $para): ?>
    <p><?= e($para) ?></p>
  <?php endforeach; ?>
  <?php if (!empty($t['table'])) render_table($t['table']); ?>
  <?php foreach ($t['ex'] ?? [] as $ex) render_example($ex); ?>
</section>
<?php endforeach; ?>

<nav class="pager">
  <?php if (isset($UNITS[$n - 1])): ?><a href="unit.php?n=<?= $n - 1 ?>">Previous: Unit <?= $n - 1 ?></a><?php else: ?><a href="index.php">Cover and contents</a><?php endif; ?>
  <?php if (isset($UNITS[$n + 1])): ?><a href="unit.php?n=<?= $n + 1 ?>">Next: Unit <?= $n + 1 ?></a><?php else: ?><a href="end.php">Conclusion and references</a><?php endif; ?>
</nav>
<?php page_end();
