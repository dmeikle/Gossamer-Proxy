<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

header('Content-Type: text/html; charset=utf-8');

$ascii = 'dave !@#$%^&*()1234567890 家分类产品销售变种语言';
echo "ascii to test: ".ascii2hex($ascii).'<br>';
function ascii2hex($ascii) {
$hex = '';
    for ($i = 0; $i < strlen($ascii); $i++) {
        $byte = strtoupper(dechex(ord($ascii{$i})));
        $byte = str_repeat('0', 2 - strlen($byte)).$byte;
        $hex.=$byte." ";
    }
    return $hex;
}

$hex=' E8 BF 99 E6 98 AF E4 B8 AD E5 9B BD';
function hex2ascii($hex){
    $ascii='';
    $hex=str_replace(" ", "", $hex);
    for($i=0; $i<strlen($hex); $i=$i+2) {
        $ascii.=chr(hexdec(substr($hex, $i, 2)));
    }
    return($ascii);
}



echo 'hex to ascii '.hex2ascii($hex).'<br>';


















$pdo = new PDO('mysql:dbname=encoding_test;host=localhost', 'root', 'isnothere',
               array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if (!empty($_POST['text'])) {
    $stmt = $pdo->prepare('INSERT INTO `texts` (`text`) VALUES (:text)');
    $stmt->execute(array('text' => $_POST['text']));
   
    echo text2bin($_POST['text']);
}

$results = $pdo->query('SELECT * FROM `texts`')->fetchAll(PDO::FETCH_ASSOC);

FUNCTION bin2text($bin_str) 
{ 
    $text_str = ''; 
    $chars = EXPLODE("\n", CHUNK_SPLIT(STR_REPLACE("\n", '', $bin_str), 8)); 
    $_I = COUNT($chars); 
    FOR($i = 0; $i < $_I; $text_str .= CHR(BINDEC($chars[$i])), $i++  ); 
    RETURN $text_str; 
} 
 
function text2bin($txt_str) 
{ 
    $len = strlen($txt_str); 
    $bin = ''; 
    for($i = 0; $i < $len; $i++ ) 
    { 
        $bin .= strlen(decbin(ord($txt_str[$i]))) < 8 ? str_pad(decbin(ord($txt_str[$i])), 8, 0, STR_PAD_LEFT) : decbin(ord($txt_str[$i])); 
    } 
    return $bin; 
} 
if(!empty($_POST['binary'])) {
    echo bin2text($_POST['binary']);
}

?>
<!DOCTYPE html>

<html>
<head>
    <title>UTF-8 encoding test</title>
</head>
<body>

<h1>Display test</h1>

<p>
A good day, World!<br>
Schönen Tag, Welt!<br>
Une bonne journée, tout le monde!<br>
يوم جيد، العالم<br>
좋은 일, 세계!<br>
Một ngày tốt lành, thế giới!<br>
こんにちは、世界！<br>
</p>

<h1>Submission test</h1>

<form action="" method="post" accept-charset="utf-8">
    <textarea name="text"></textarea><br>
    binary
    <textarea name="binary"></textarea>
    <input type="submit" value="Submit">
</form>

<?php if (!empty($_POST['text'])) : ?>
    <h2>Last received data</h2>
    <pre><?php echo htmlspecialchars($_POST['text'], ENT_NOQUOTES, 'UTF-8'); ?></pre>
<?php endif; ?>

<h1>Output test</h1>

<ul>
    <?php foreach ($results as $result) : ?>
        <li>
            <input type="text" value="<?php echo htmlspecialchars($result['text'], ENT_NOQUOTES, 'UTF-8'); ?>" /><br>
           <input type="text" value="<?php echo $result['text']; ?>" /><br>
             
           <?php echo htmlspecialchars($result['text'], ENT_NOQUOTES, 'UTF-8'); ?>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>