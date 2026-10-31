<?php
// Every function below is BOTH executed and displayed on the page, so the
// code a reader sees is always the code that produced the output.
// Rule for this file: "function" line and closing "}" each on their own line.

// ===================== UNIT 1 =====================
function d_request()
{
    echo "Host     : " . htmlspecialchars($_SERVER['HTTP_HOST']) . "\n";
    echo "Method   : " . $_SERVER['REQUEST_METHOD'] . "\n";
    echo "Protocol : " . $_SERVER['SERVER_PROTOCOL'] . "\n";
    echo "URI      : " . htmlspecialchars($_SERVER['REQUEST_URI']) . "\n";
    echo "Browser  : " . htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? 'not sent');
}

function d_url()
{
    $url = 'https://example.com:8080/products/item.php?id=25#reviews';
    foreach (parse_url($url) as $part => $value) {
        echo str_pad($part, 9) . ": " . $value . "\n";
    }
}

function d_ports()
{
    echo "Server port : " . $_SERVER['SERVER_PORT'] . "\n";
    echo "Client port : " . ($_SERVER['REMOTE_PORT'] ?? 'unknown') . "\n";
    echo "Encrypted   : " . (!empty($_SERVER['HTTPS']) ? 'yes (HTTPS)' : 'no (plain HTTP)');
}

function d_http()
{
    echo "Response status : " . http_response_code() . "\n";
    echo "Accept-Language : " . htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'not sent') . "\n";
    echo "Accept-Encoding : " . htmlspecialchars($_SERVER['HTTP_ACCEPT_ENCODING'] ?? 'not sent') . "\n";
    echo "Default type    : " . ini_get('default_mimetype');
}

function d_dns()
{
    $host = 'example.com';
    $ip = gethostbyname($host);
    if ($ip === $host) {
        echo "Could not resolve $host from this server.";
    } else {
        echo "$host resolves to $ip";
    }
}

function d_ip()
{
    $ip = '192.168.10.77';
    $prefix = 24;
    $mask = (-1 << (32 - $prefix)) & 0xFFFFFFFF;
    $network = ip2long($ip) & $mask;
    $broadcast = $network | (~$mask & 0xFFFFFFFF);
    $public = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE);
    echo "Address      : $ip/$prefix\n";
    echo "Valid IPv4   : " . (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? 'yes' : 'no') . "\n";
    echo "Private range: " . ($public ? 'no' : 'yes') . "\n";
    echo "Subnet mask  : " . long2ip($mask) . "\n";
    echo "Network      : " . long2ip($network) . "\n";
    echo "Broadcast    : " . long2ip($broadcast) . "\n";
    echo "Usable hosts : " . (pow(2, 32 - $prefix) - 2);
}

// ===================== UNIT 2 =====================
function d_syntax()
{
    // single-line comment
    # another single-line comment
    /* a comment that
       spans lines */
    echo "Every statement ends with a semicolon.\n";
    print "print is similar to echo.\n";
    ECHO 'Keywords are case-insensitive, but $variable names are not.';
}

function d_vars()
{
    $student = "Asha";
    $marks = 82.5;
    $passed = true;
    define('PASS_MARK', 40);
    echo "Name: $student\n";
    echo "Marks: {$marks}\n";
    echo "Passed: " . ($passed ? 'yes' : 'no') . "\n";
    echo "Margin over pass mark: " . ($marks - PASS_MARK);
}

function d_types()
{
    $values = [42, 3.14, "text", true, [1, 2], null];
    foreach ($values as $v) {
        echo str_pad(gettype($v), 8) . " -> ";
        var_dump($v);
    }
    echo "\n(int) \"12abc\" = " . (int)"12abc" . "\n";
    echo "(bool) \"0\"    = " . var_export((bool)"0", true);
}

function d_operators()
{
    $a = 17;
    $b = 5;
    echo "$a + $b = " . ($a + $b) . "\n";
    echo "$a % $b = " . ($a % $b) . "   (remainder)\n";
    echo "$a ** 2 = " . ($a ** 2) . "   (power)\n";
    echo "intdiv($a, $b) = " . intdiv($a, $b) . "\n";
    echo "'5' == 5  : " . var_export('5' == 5, true) . "\n";
    echo "'5' === 5 : " . var_export('5' === 5, true) . "\n";
    echo "$a vs $b : " . ($a <=> $b) . "   (spaceship: -1, 0 or 1)\n";
    echo "null ?? 'default' : " . (null ?? 'default');
}

function d_decisions()
{
    $marks = 68;
    if ($marks >= 75) {
        $grade = "A";
    } elseif ($marks >= 60) {
        $grade = "B";
    } elseif ($marks >= 40) {
        $grade = "C";
    } else {
        $grade = "Fail";
    }
    echo "Marks $marks -> Grade $grade\n";

    $day = date('N');
    switch ($day) {
        case 6:
        case 7:
            echo "Today is a weekend.";
            break;
        default:
            echo "Today is a weekday.";
    }
}

function d_loops()
{
    for ($i = 1; $i <= 5; $i++) {
        echo $i * $i . " ";
    }
    echo "\n";

    $n = 5;
    $factorial = 1;
    while ($n > 1) {
        $factorial *= $n--;
    }
    echo "5! = $factorial\n";

    $subjects = ['PHP' => 85, 'MySQL' => 78, 'HTML' => 92];
    foreach ($subjects as $name => $score) {
        if ($score < 80) {
            continue;
        }
        echo "$name: $score\n";
    }
}

function d_strings()
{
    $s = "  Backend Web Development  ";
    $t = trim($s);
    echo "Length        : " . strlen($t) . "\n";
    echo "Upper         : " . strtoupper($t) . "\n";
    echo "Words         : " . str_word_count($t) . "\n";
    echo "Position 'Web': " . strpos($t, 'Web') . "\n";
    echo "Substring     : " . substr($t, 0, 7) . "\n";
    echo "Replaced      : " . str_replace('Web', 'Server', $t) . "\n";
    echo "Reversed      : " . strrev($t) . "\n";
    echo "Split + join  : " . implode('-', explode(' ', $t)) . "\n";
    echo sprintf("Formatted     : %05.1f%%", 7.256);
}

// ===================== UNIT 3 =====================
function d_get_form()
{
    $q = $_GET['q'] ?? '';
    ?>
    <form method="get" action="unit.php#t-get">
        <input type="hidden" name="n" value="3">
        <label>Search term <input name="q" value="<?= htmlspecialchars($q) ?>"></label>
        <button>Send with GET</button>
    </form>
    <?php
    if ($q !== '') {
        echo "<p>Received <code>\$_GET['q']</code> = <strong>" . htmlspecialchars($q) . "</strong>. Look at the address bar: the value travelled in the URL.</p>";
    }
}

function d_post_form()
{
    $errors = [];
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $sent = $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register']);

    if ($sent) {
        if (strlen($name) < 3) {
            $errors[] = 'Name must have at least 3 characters.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Enter a valid e-mail address.';
        }
        if (!ctype_digit($age) || $age < 16 || $age > 60) {
            $errors[] = 'Age must be a whole number from 16 to 60.';
        }
    }
    foreach ($errors as $error) {
        echo '<p class="err">' . htmlspecialchars($error) . '</p>';
    }
    if ($sent && !$errors) {
        echo '<p class="ok">Valid data received for ' . htmlspecialchars($name) . '.</p>';
    }
    ?>
    <form method="post" action="unit.php?n=3#t-validate">
        <label>Name <input name="name" value="<?= htmlspecialchars($name) ?>"></label>
        <label>Email <input name="email" value="<?= htmlspecialchars($email) ?>"></label>
        <label>Age <input name="age" value="<?= htmlspecialchars($age) ?>"></label>
        <button name="register" value="1">Validate on the server</button>
    </form>
    <?php
}

// ===================== UNIT 4 =====================
function d_db_create()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql = "CREATE TABLE IF NOT EXISTS students (
        id     INT AUTO_INCREMENT PRIMARY KEY,
        name   VARCHAR(60) NOT NULL,
        course VARCHAR(40) NOT NULL,
        marks  INT NOT NULL
    )";
    $conn->query($sql);
    echo "Connected to database '" . DB_NAME . "'. Table 'students' is ready.";
    $conn->close();
}

function d_db_insert()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (isset($_POST['add'])) {
        $name = trim($_POST['name'] ?? '');
        $course = trim($_POST['course'] ?? '');
        $marks = (int)($_POST['marks'] ?? 0);
        if ($name !== '' && $course !== '') {
            $stmt = $conn->prepare("INSERT INTO students (name, course, marks) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $name, $course, $marks);
            $stmt->execute();
            echo '<p class="ok">Row inserted with id ' . $stmt->insert_id . '.</p>';
            $stmt->close();
        } else {
            echo '<p class="err">Name and course are required.</p>';
        }
    }
    ?>
    <form method="post" action="unit.php?n=4#t-insert">
        <label>Name <input name="name"></label>
        <label>Course <input name="course"></label>
        <label>Marks <input name="marks" type="number" value="0"></label>
        <button name="add" value="1">Insert row</button>
    </form>
    <?php
    $conn->close();
}

function d_db_select()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $result = $conn->query("SELECT id, name, course, marks FROM students ORDER BY marks DESC");
    echo "<table class='grid'><tr><th>ID</th><th>Name</th><th>Course</th><th>Marks</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['course']) . "</td>";
        echo "<td>" . $row['marks'] . "</td></tr>";
    }
    echo "</table><p>" . $result->num_rows . " row(s) returned.</p>";
    $conn->close();
}

function d_db_modify()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $id = (int)($_POST['id'] ?? 0);
    if (isset($_POST['update'])) {
        $marks = (int)($_POST['marks'] ?? 0);
        $stmt = $conn->prepare("UPDATE students SET marks = ? WHERE id = ?");
        $stmt->bind_param("ii", $marks, $id);
        $stmt->execute();
        echo '<p class="ok">' . $stmt->affected_rows . ' row(s) updated.</p>';
    }
    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo '<p class="ok">' . $stmt->affected_rows . ' row(s) deleted.</p>';
    }
    ?>
    <form method="post" action="unit.php?n=4#t-modify">
        <label>Row id <input name="id" type="number" value="1"></label>
        <label>New marks <input name="marks" type="number" value="90"></label>
        <button name="update" value="1">Update marks</button>
        <button name="delete" value="1">Delete row</button>
    </form>
    <?php
    $conn->close();
}
