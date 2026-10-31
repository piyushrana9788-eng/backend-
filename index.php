<?php
require_once __DIR__ . '/includes/render.php';
page_start('Cover and contents', 'home');
?>
<section class="cover">
  <p class="kicker">Assignment File</p>
  <h1>Backend Web Development</h1>
  <p class="lede">Internet technologies, PHP programming, HTML forms and MySQL, explained with programs that run live on this page.</p>
  <dl class="details">
    <dt>Submitted by</dt><dd><?= e(STUDENT['name']) ?></dd>
    <dt>Roll number</dt><dd><?= e(STUDENT['roll']) ?></dd>
    <dt>Programme</dt><dd><?= e(STUDENT['programme']) ?></dd>
    <dt>College</dt><dd><?= e(STUDENT['college']) ?></dd>
    <dt>Submitted to</dt><dd><?= e(STUDENT['submitted_to']) ?></dd>
    <dt>Date</dt><dd><?= e(STUDENT['date']) ?></dd>
  </dl>
</section>

<section class="page-break">
  <h2>Declaration</h2>
  <p>I declare that this assignment is the result of my own study and work. Where I have used books, manuals or websites, they are listed in the references section.</p>
  <p class="signline">Signature: ______________________ &nbsp;&nbsp; Date: ______________</p>

  <h2>Objective</h2>
  <p>This file shows how a web application works from end to end: how a browser reaches a server (Unit 1), the PHP language that runs on the server (Unit 2), how users send data to it (Unit 3), and how that data is stored permanently (Unit 4). Each topic gives a short explanation, then a program. The program shown is the program that ran, and its output appears directly beneath it.</p>

  <h2>Contents</h2>
  <ol class="toc">
  <?php foreach ($UNITS as $n => $u): ?>
    <li><a href="unit.php?n=<?= $n ?>">Unit <?= $n ?>: <?= e($u['title']) ?></a>
      <ol>
      <?php foreach ($u['topics'] as $k => $t): ?>
        <li><a href="unit.php?n=<?= $n ?>#t-<?= e($t['id']) ?>"><?= $n ?>.<?= $k + 1 ?> <?= e($t['title']) ?></a></li>
      <?php endforeach; ?>
      </ol>
    </li>
  <?php endforeach; ?>
    <li><a href="end.php">Conclusion and references</a></li>
  </ol>
  <p class="next"><a href="unit.php?n=1">Start with Unit 1</a></p>
</section>
<?php page_end();
