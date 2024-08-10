<?php
session_start();
function countCharactersByUnicodeRange($text) {
    $unicodeRanges = array(
        '基础区'=> array('\u4E00', '\u9FFF'),
        '兼容区'=> array('\uF900', '\uFA99'),
        '扩展A' => array('\u3400', '\u4DBF'),
        '扩展B' => array('\u20000', '\u2A6DF'),
        '扩展C' => array('\u2A700', '\u2B73F'),
        '扩展D' => array('\u2B740', '\u2B81F'),
        '扩展E' => array('\u2B820', '\u2CEAF'),
        '扩展F' => array('\u2CEB0', '\u2EBEF'),
        '兼容补'=> array('\u2F800', '\u2FA1F'),
        '扩展G' => array('\u30000', '\u3134F'),
    );
    $characterCount = array();
    foreach ($unicodeRanges as $range => $limits) {
        $start = hexdec(str_replace('\u', '', $limits[0]));
        $end = hexdec(str_replace('\u', '', $limits[1]));
        $count = 0;
        for ($i = 0; $i < mb_strlen($text, 'UTF-8'); $i++) {
            $char = mb_substr($text, $i, 1, 'UTF-8');
            $charCode = unpack('N', mb_convert_encoding($char, 'UCS-4BE', 'UTF-8'));
            $charCode = $charCode[1];
            if ($charCode >= $start && $charCode <= $end) {
                $count++;
            }
        }
        $characterCount[$range] = $count;
    }
    return $characterCount;
}

$text = file_get_contents('out.txt');
$result = countCharactersByUnicodeRange($text);
$unicode = '';
foreach ($result as $range => $count) {
    $unicode .= $range . ': ' . $count . '个汉字<br/>' . PHP_EOL;
}
echo $unicode;
$_SESSION['unicode'] = $unicode;
header('Location: index.php');
exit;
?>
