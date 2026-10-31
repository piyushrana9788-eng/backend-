<?php
require_once __DIR__ . '/includes/render.php';
page_start('Conclusion and references', 'end');
?>
<header class="unit-head">
  <p class="kicker">Closing</p>
  <h1>Conclusion and references</h1>
</header>

<section class="topic">
  <h2>Conclusion</h2>
  <p>A web page is the end of a conversation. The browser resolves a name with DNS, opens a TCP connection, and sends an HTTP request; the server runs PHP, which may read form input and query MySQL, and sends back HTML. Each unit in this file covers one part of that chain.</p>
  <p>Three lessons repeat throughout the work. First, the server is the only place where data can be trusted, so validation happens there. Second, anything printed from user input must be escaped, and anything sent to a database must go through a prepared statement. Third, a program is best understood by running it, which is why every example here shows real output.</p>
  <h2>What could be extended</h2>
  <p>Sessions and cookies to remember a logged-in user, password hashing with password_hash(), file uploads, and a PDO-based data layer would be natural next steps.</p>
</section>

<section class="topic">
  <h2>References</h2>
  <ol class="refs">
    <?php foreach ($REFERENCES as $r): ?><li><?= e($r) ?></li><?php endforeach; ?>
  </ol>
</section>

<nav class="pager">
  <a href="unit.php?n=<?= count($UNITS) ?>">Previous: Unit <?= count($UNITS) ?></a>
  <a href="index.php">Cover and contents</a>
</nav>
<?php page_end();
