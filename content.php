<?php
// Content for the four units. Each topic can hold paragraphs ('text'), a table,
// and examples ('ex'): a live PHP demo ('demo'), or static code ('code' + 'out').

$UNITS = [

1 => [
  'title' => 'Internet Technologies',
  'aim'   => 'To understand how a request travels from a browser to a server and back, and to inspect that journey from PHP.',
  'topics' => [
    ['id' => 'web', 'title' => 'The Internet and the World Wide Web',
     'text' => [
       'The Internet is the global collection of interconnected networks that moves data between devices. It is infrastructure: cables, routers, and the agreed rules (protocols) that let very different machines understand each other.',
       'The World Wide Web is only one service that runs on that infrastructure. It combines URLs, HTTP, HTML, CSS and JavaScript so that documents can link to one another. E-mail, file transfer and online games use the same Internet without being part of the Web.',
       'Most web communication follows the client-server model. The client (usually a browser) asks for a resource; the server (for example Apache running PHP) processes the request and sends back a response. PHP runs on the server, so the browser only ever receives the output, never the PHP source.'],
     'table' => [['', 'Internet', 'World Wide Web'],
                 ['What it is', 'Global network of networks', 'Service of linked pages and resources'],
                 ['Built on', 'TCP/IP and related protocols', 'HTTP/HTTPS, HTML, URLs'],
                 ['Other services', 'E-mail, FTP, VoIP, SSH', 'None; it is one service itself']],
     'ex' => [['cap' => 'A script reading details of the request it just received', 'demo' => 'd_request']]],

    ['id' => 'url', 'title' => 'Anatomy of a URL',
     'text' => ['A URL tells the browser which protocol to use, which machine to contact, and which resource to ask for. In https://example.com:8080/products/item.php?id=25#reviews the scheme is https, the host is example.com, the port is 8080, the path is /products/item.php, the query string is id=25 and the fragment is reviews. The fragment is handled by the browser and is never sent to the server.'],
     'ex' => [['cap' => 'Splitting a URL into its parts with parse_url()', 'demo' => 'd_url']]],

    ['id' => 'tcpip', 'title' => 'TCP/IP',
     'text' => [
       'TCP/IP is a suite of protocols arranged in four layers. Each layer solves one problem and relies on the layer below it.',
       'IP addresses and routes packets between networks but does not guarantee delivery. TCP sits above it and adds reliability: before data flows, the two sides perform a three-way handshake (SYN, SYN-ACK, ACK). TCP then numbers the segments, acknowledges them, retransmits anything lost and reassembles them in order.'],
     'table' => [['Layer', 'Job', 'Examples'],
                 ['Application', 'Defines what the programs say to each other', 'HTTP, DNS, SMTP'],
                 ['Transport', 'Delivers data between processes using ports', 'TCP, UDP'],
                 ['Internet', 'Addresses and routes packets', 'IPv4, IPv6'],
                 ['Link', 'Moves frames across one physical network', 'Ethernet, Wi-Fi']],
     'ex' => [['cap' => 'Ports identify the process at each end of a TCP connection', 'demo' => 'd_ports']]],

    ['id' => 'http', 'title' => 'HTTP',
     'text' => [
       'HTTP is the application protocol of the Web. It is stateless: each request stands alone, and the server keeps no memory of earlier ones unless cookies or sessions are used. A request has a method, a path, headers and an optional body; a response has a status code, headers and a body.',
       'GET asks for a resource and must not change data. POST sends data for the server to process. PUT and DELETE replace and remove resources. HTTPS is HTTP carried inside a TLS-encrypted connection.'],
     'table' => [['Status', 'Meaning'],
                 ['200 OK', 'Request succeeded'],
                 ['301 / 302', 'Resource moved permanently / temporarily'],
                 ['400 / 404', 'Bad request / resource not found'],
                 ['403', 'Understood but not permitted'],
                 ['500', 'The server failed while handling the request']],
     'ex' => [['cap' => 'A raw HTTP exchange', 'code' => "GET /index.php HTTP/1.1\nHost: example.com\nAccept: text/html\n\nHTTP/1.1 200 OK\nContent-Type: text/html; charset=UTF-8\nContent-Length: 1256", 'out' => null],
             ['cap' => 'Reading request headers and the response status in PHP', 'demo' => 'd_http']]],

    ['id' => 'dns', 'title' => 'DNS',
     'text' => [
       'People remember names; networks route by numbers. The Domain Name System translates a name such as example.com into an IP address. Your device asks a recursive resolver, which (if it has no cached answer) asks a root server, then the top-level domain server (.com), then the domain\'s authoritative server, and returns the answer to you. Results are cached for the time given by the record\'s TTL.',
       'DNS normally uses UDP port 53 because queries and answers are small, and falls back to TCP for large responses.'],
     'table' => [['Record', 'Purpose'],
                 ['A / AAAA', 'Name to IPv4 / IPv6 address'],
                 ['CNAME', 'Alias pointing to another name'],
                 ['MX', 'Mail servers for the domain'],
                 ['NS', 'Authoritative name servers'],
                 ['TXT', 'Free text, used for SPF and verification']],
     'ex' => [['cap' => 'Resolving a hostname, with a check for failure', 'demo' => 'd_dns']]],

    ['id' => 'smtp', 'title' => 'SMTP',
     'text' => [
       'SMTP (Simple Mail Transfer Protocol) moves e-mail from a sender\'s mail client to its server and between servers. It only sends; reading mail uses IMAP or POP3. Servers accept submissions on port 587 (with authentication) and exchange mail with each other on port 25. The exchange is a short text conversation of commands and numeric replies.',
       'PHP\'s mail() function hands a message to the server\'s mail system. It needs a working mail setup, which is why it often does nothing on a plain XAMPP install, so it is shown here as code only.'],
     'ex' => [['cap' => 'An SMTP conversation (client lines start with C, server lines with S)', 'code' => "S: 220 mail.example.com ESMTP ready\nC: HELO client.example.org\nS: 250 mail.example.com\nC: MAIL FROM:<asha@example.org>\nS: 250 OK\nC: RCPT TO:<ravi@example.com>\nS: 250 OK\nC: DATA\nS: 354 End data with <CR><LF>.<CR><LF>\nC: Subject: Hello ... .\nS: 250 Message queued\nC: QUIT\nS: 221 Bye", 'out' => null],
             ['cap' => 'Sending mail from PHP', 'code' => "<?php\n\$sent = mail('ravi@example.com', 'Assignment', 'Submitted today.', 'From: asha@example.org');\necho \$sent ? 'Accepted for delivery' : 'Mail system rejected it';", 'out' => 'Accepted for delivery  (only on a server with a mail system configured)']]],

    ['id' => 'ip', 'title' => 'IP Addressing',
     'text' => [
       'Every interface on an IP network needs an address. IPv4 addresses are 32 bits, written as four decimal numbers (192.168.10.77); there are about 4.3 billion, and they have run out. IPv6 uses 128 bits, written in hexadecimal (2001:db8::1), and solves the shortage.',
       'A network prefix such as /24 says how many leading bits identify the network; the rest identify the host. This notation (CIDR) replaced the old Class A/B/C scheme. Three ranges are private and are not routed on the Internet: 10.0.0.0/8, 172.16.0.0/12 and 192.168.0.0/16. Home networks use them together with NAT.'],
     'ex' => [['cap' => 'Subnet calculation using bitwise operators', 'demo' => 'd_ip']]],

    ['id' => 'html', 'title' => 'HTML',
     'text' => ['HTML describes the structure and meaning of a page; CSS describes its appearance. Semantic elements (header, nav, main, article, footer) tell browsers, search engines and screen readers what each part is for, which is better than a page made only of div elements. Forms are the bridge to the server: what the user types is sent as a request.'],
     'ex' => [['cap' => 'A minimal semantic page with a table and a link', 'code' => "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n  <meta charset=\"UTF-8\">\n  <title>My page</title>\n</head>\n<body>\n  <header><h1>Marks</h1></header>\n  <main>\n    <table>\n      <tr><th>Subject</th><th>Marks</th></tr>\n      <tr><td>PHP</td><td>85</td></tr>\n    </table>\n    <a href=\"unit.php?n=2\">Go to Unit 2</a>\n  </main>\n</body>\n</html>", 'out' => 'The browser shows a heading, a two-column table and a clickable link.']]],

    ['id' => 'js', 'title' => 'JavaScript Fundamentals',
     'text' => ['JavaScript runs inside the browser and reacts to the user without a round trip to the server. It has variables (let, const), functions, arrays, objects and events, and it can read and change the page through the DOM. Because users control their own browser, JavaScript checks are a convenience only; real validation always has to be repeated on the server.'],
     'ex' => [['cap' => 'Variables, a function, and updating the page when a button is clicked', 'code' => "<button id=\"b\">Show total</button>\n<p id=\"result\"></p>\n<script>\nconst marks = [85, 78, 92];\nfunction total(list) {\n  return list.reduce((sum, m) => sum + m, 0);\n}\ndocument.getElementById('b').addEventListener('click', () => {\n  document.getElementById('result').textContent = 'Total: ' + total(marks);\n});\n</script>", 'out' => 'Clicking the button writes "Total: 255" into the paragraph.']]],

    ['id' => 'sides', 'title' => 'Front-end vs Server-side Scripting',
     'text' => ['Front-end code is downloaded and runs on the user\'s device; server-side code runs on the web server before the response is sent. The split decides where each job belongs: anything the user could tamper with, such as validation, permissions and database access, must live on the server.'],
     'table' => [['', 'Front-end (HTML, CSS, JavaScript)', 'Server-side (PHP)'],
                 ['Runs on', 'User\'s browser', 'Web server'],
                 ['User can see the source', 'Yes', 'No, only the output'],
                 ['Can access the database', 'No, only through the server', 'Yes'],
                 ['Typical job', 'Layout, interaction, instant feedback', 'Validation, login, storing data'],
                 ['Trust level', 'Untrusted', 'Trusted']]],
  ],
],

2 => [
  'title' => 'PHP Programming',
  'aim'   => 'To learn the core of the PHP language by running small programs and reading their real output.',
  'topics' => [
    ['id' => 'syntax', 'title' => 'PHP Syntax',
     'text' => ['PHP code lives between <?php and ?> tags inside an ordinary file. The server runs the code and replaces it with whatever it prints; the rest of the file passes through unchanged. Statements end with a semicolon, and comments can be written with //, # or /* ... */.'],
     'ex' => [['cap' => 'Comments, echo and print', 'demo' => 'd_syntax']]],

    ['id' => 'vars', 'title' => 'Variables and Constants',
     'text' => ['A variable starts with $ and its name is case-sensitive. PHP creates it on first assignment and decides its type from the value. Double-quoted strings insert variable values; single-quoted strings do not. A constant, made with define() or const, cannot change once set.'],
     'ex' => [['cap' => 'Variables, interpolation and a constant', 'demo' => 'd_vars']]],

    ['id' => 'types', 'title' => 'Data Types',
     'text' => ['PHP\'s scalar types are int, float, string and bool; compound types are array and object; null means no value. Conversion between types happens automatically in many expressions and explicitly with casts such as (int). Automatic conversion is convenient but can surprise you, for example "12abc" becomes 12 when cast to an integer.'],
     'ex' => [['cap' => 'Inspecting types with gettype() and var_dump()', 'demo' => 'd_types']]],

    ['id' => 'ops', 'title' => 'Operators',
     'text' => ['Arithmetic operators (+ - * / % **) work on numbers; . joins strings; && || ! combine conditions. The difference between == and === matters: == converts types before comparing, === also requires the same type, so prefer ===. The null coalescing operator ?? supplies a default for a missing or null value.'],
     'ex' => [['cap' => 'Arithmetic, comparison and ??', 'demo' => 'd_operators']]],

    ['id' => 'decide', 'title' => 'Decision Making',
     'text' => ['if, elseif and else choose one branch from a condition. switch compares one value against many cases and needs break to stop falling through to the next case. Newer PHP versions also provide match, an expression that returns a value and does not fall through.'],
     'ex' => [['cap' => 'Grading with if/elseif and a switch on today\'s day', 'demo' => 'd_decisions']]],

    ['id' => 'loops', 'title' => 'Loops',
     'text' => ['for suits a known number of repetitions, while and do-while repeat until a condition changes, and foreach walks through an array. break leaves a loop early and continue skips to the next round.'],
     'ex' => [['cap' => 'for, while and foreach with continue', 'demo' => 'd_loops']]],

    ['id' => 'strings', 'title' => 'Strings',
     'text' => ['PHP has a large set of string functions. Counting, searching, slicing, replacing, splitting and formatting cover most everyday work. Remember that strlen() counts bytes, which differs from characters for non-English text; the mb_ functions handle that case.'],
     'ex' => [['cap' => 'Common string functions on one sentence', 'demo' => 'd_strings']]],
  ],
],

3 => [
  'title' => 'HTML Forms with PHP',
  'aim'   => 'To collect input from users, receive it safely on the server, and reject bad data with clear messages.',
  'topics' => [
    ['id' => 'forms', 'title' => 'How a Form Works',
     'text' => ['A form gathers input and sends it to the URL in its action attribute using the method attribute. Each control with a name becomes one key/value pair in the request. PHP exposes those pairs in the superglobal arrays $_GET and $_POST.'],
     'ex' => [['cap' => 'A form that posts three fields to process.php', 'code' => "<form method=\"post\" action=\"process.php\">\n  <label>Name <input name=\"name\" required></label>\n  <label>Email <input name=\"email\" type=\"email\"></label>\n  <select name=\"course\">\n    <option>BCA</option>\n    <option>B.Tech</option>\n  </select>\n  <button>Send</button>\n</form>", 'out' => 'On submit, PHP receives $_POST[\'name\'], $_POST[\'email\'] and $_POST[\'course\'].']]],

    ['id' => 'get', 'title' => 'The GET Method',
     'text' => ['GET appends the data to the URL as a query string. Because the data is visible, bookmarkable and stored in browser history, GET fits searches and filters. It must never carry passwords or perform changes.'],
     'ex' => [['cap' => 'Try it: submit and watch the address bar', 'demo' => 'd_get_form', 'raw' => true]]],

    ['id' => 'post', 'title' => 'GET vs POST',
     'text' => ['POST puts the data in the request body. It is not shown in the address bar, has no practical size limit, and is the right choice whenever the request changes something or carries private data. POST alone is not encryption; only HTTPS protects data in transit.'],
     'table' => [['', 'GET', 'POST'],
                 ['Where the data goes', 'URL query string', 'Request body'],
                 ['Visible in the address bar', 'Yes', 'No'],
                 ['Bookmarkable', 'Yes', 'No'],
                 ['Intended for', 'Reading and searching', 'Creating or changing data'],
                 ['PHP array', '$_GET', '$_POST']]],

    ['id' => 'validate', 'title' => 'Processing and Server-side Validation',
     'text' => [
       'Never trust submitted data. A user can bypass the browser entirely and send any request they like, so every rule must be checked on the server: trim the input, check it against the rule, collect the error messages, and redisplay the form with the values the user already typed.',
       'When echoing user input back into HTML, always pass it through htmlspecialchars(). Otherwise a visitor can inject a script into the page (cross-site scripting).'],
     'ex' => [['cap' => 'Try it: leave fields empty, enter a bad e-mail, then a valid set', 'demo' => 'd_post_form', 'raw' => true]]],

    ['id' => 'safe', 'title' => 'Safe Handling Checklist',
     'text' => ['Four habits cover most beginner mistakes: validate for type, length and range; escape on output with htmlspecialchars(); use prepared statements for databases (Unit 4); and serve forms over HTTPS. Client-side attributes such as required are for convenience and do not replace any of these.'],
     'table' => [['Risk', 'Defence'],
                 ['Cross-site scripting', 'htmlspecialchars() on every output of user data'],
                 ['SQL injection', 'Prepared statements with bound parameters'],
                 ['Bad or missing data', 'Server-side validation, with messages'],
                 ['Data sniffed in transit', 'HTTPS']]],
  ],
],

4 => [
  'title' => 'MySQL Database',
  'aim'   => 'To store and manage data permanently by connecting PHP to MySQL and running the four basic operations.',
  'topics' => [
    ['id' => 'connect', 'title' => 'Connecting and Creating a Table',
     'text' => [
       'A database keeps data between requests. PHP talks to MySQL through the mysqli extension: new mysqli(host, user, password, database) opens a connection, and the connection object runs SQL. The credentials are kept in config.php so they are not repeated in every file.',
       'Live demos in this unit need a working database. If the box below shows an error, create a database named in config.php and check the user name and password.'],
     'ex' => [['cap' => 'Connect and create the students table (live)', 'demo' => 'd_db_create', 'db' => true],
             ['cap' => 'The same table in SQL', 'code' => "CREATE TABLE students (\n  id     INT AUTO_INCREMENT PRIMARY KEY,\n  name   VARCHAR(60) NOT NULL,\n  course VARCHAR(40) NOT NULL,\n  marks  INT NOT NULL\n);", 'out' => null]]],

    ['id' => 'insert', 'title' => 'Inserting Data (Create)',
     'text' => ['INSERT adds a row. Values from a form must never be pasted into the SQL text; a prepared statement sends the SQL and the values separately, so the values can never be read as commands. The ? marks are placeholders and bind_param declares each type: s for string, i for integer.'],
     'ex' => [['cap' => 'Add a student (live)', 'demo' => 'd_db_insert', 'db' => true, 'raw' => true]]],

    ['id' => 'retrieve', 'title' => 'Retrieving Data (Read)',
     'text' => ['SELECT reads rows. query() returns a result set; fetch_assoc() hands back one row at a time as an array keyed by column name. Data that came from users is escaped again with htmlspecialchars() before it reaches the page.'],
     'ex' => [['cap' => 'List all students, highest marks first (live)', 'demo' => 'd_db_select', 'db' => true, 'raw' => true]]],

    ['id' => 'modify', 'title' => 'Updating and Deleting Data',
     'text' => ['UPDATE changes existing rows and DELETE removes them. Both need a WHERE clause: without one they affect every row in the table. affected_rows reports how many rows really changed, which is a simple way to confirm the operation worked.'],
     'ex' => [['cap' => 'Change marks or remove a row by id (live)', 'demo' => 'd_db_modify', 'db' => true, 'raw' => true]]],

    ['id' => 'inject', 'title' => 'Why Prepared Statements Matter',
     'text' => ['In SQL injection, input such as  x\' OR \'1\'=\'1  changes the meaning of a query built by string concatenation. Prepared statements prevent that by keeping data out of the SQL text entirely.'],
     'ex' => [['cap' => 'Unsafe versus safe (never use the first form)', 'code' => "// UNSAFE: input becomes part of the SQL\n\$conn->query(\"SELECT * FROM students WHERE name = '\$name'\");\n\n// SAFE: input is sent separately as data\n\$stmt = \$conn->prepare(\"SELECT * FROM students WHERE name = ?\");\n\$stmt->bind_param('s', \$name);\n\$stmt->execute();", 'out' => null]]],
  ],
],

];

$REFERENCES = [
  'PHP Manual, The PHP Group. php.net/manual',
  'MDN Web Docs: HTTP, HTML and JavaScript guides. developer.mozilla.org',
  'RFC 9110: HTTP Semantics. IETF, 2022',
  'RFC 9293: Transmission Control Protocol (TCP). IETF, 2022',
  'RFC 1034 and RFC 1035: Domain Names. IETF, 1987',
  'RFC 5321: Simple Mail Transfer Protocol. IETF, 2008',
  'RFC 791: Internet Protocol, and RFC 8200: IPv6 Specification. IETF',
  'MySQL Reference Manual, Oracle. dev.mysql.com/doc',
  'OWASP Top Ten: injection and cross-site scripting. owasp.org',
];
