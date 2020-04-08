<?php
// get client ip address

// if is from share internet (router)
if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
} else if (! empty($SERVER['HTTP_X_FORWARDED_FOR'])) // ip is from proxy
{
    $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else { // ip is from remote address
    $ipAddress = $_SERVER['REMOTE_ADDR'];
}

echo $ipAddress . '<br />';

// ==========================================================================================>
// user browser and platform detection script
function getBrowser()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $browserName = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    // Get the platform
    if (preg_match('/linux/i', $userAgent)) { // preg_match == Searches subject for a match to the regular expression given in pattern.
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $userAgent)) {
        $platform = 'windows';
    }

    // Get the name of the useragent
    if (preg_match('/MSIE/i', $userAgent) && ! preg_match('/Opera/i', $userAgent)) {
        $browserName = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $userAgent)) {
        $browserName = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $userAgent)) {
        $browserName = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $userAgent)) {
        $browserName = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $userAgent)) {
        $browserName = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $userAgent)) {
        $browserName = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array(
        'Version',
        $ub,
        'other'
    );
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    preg_match_all($pattern, $userAgent, $matches); // preg_match_all: Searches subject for all matches to the regular expression given in pattern and puts them in matches in the order specified by flags.

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        // we will have two since we are not using 'other' argument yet
        // see if version is before or after the name
        if (strripos($userAgent, "Version") < strripos($userAgent, $ub)) { // strripos: Find the numeric position of the last occurrence of needle in the haystack string.
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $userAgent,
        'name' => $browserName,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern
    );
}
// now try it
$ua = getBrowser();
$browser = "Your browser: " . $ua['name'] . "<br />";
$version = "Version: " . $ua['version'] . "<br />";
$platform = "platform: " . $ua['platform'] . "<br />";
echo $browser . $version . $platform;

// ===========================================================================
// get current file name
echo basename($_SERVER['PHP_SELF']) . "<br />";

// ===============================================================================

// check if page is called from http or https
if (! empty($_SERVER['HTTPS'])) {
    echo 'https is enabled' . "<br />";
} else {
    echo 'http is enabled' . "<br />";
}

// =================================================================================

// get last modified information of a file
$currentFileName = basename($_SERVER['PHP_SELF']);
$fileLastModified = filemtime($currentFileName);

// l = A full textual representation of the day of the week
// d = dat of the month, 2 digits with leading zeroes + S = English ordinal suffix for the day of the month, 2 characters, so the 'th' in 7th
// F = A full textual representation of a month, such as January or March
// Y = A full numeric representation of a year, 4 digits
// h = 12-hour format of an hour with leading zeros
// i = Minutes with leading zeros
// a = Lowercase Ante meridiem and Post meridiem
echo "Last modified " . date("l, dS F, Y, h:ia", $fileLastModified) . "<br />";
// hadn't initiall set timezone in php.ini, so it was giving me the wrong date/time
echo date_default_timezone_get();

// ====================================================================================
// table display
$a = 1000;
$b = 1200;
$c = 1400;
echo "<table border=1 cellspacing=0 cellpading=0>
<tr> <td><font color=blue>Salary of Mr. A is</td> <td>$a$</font></td></tr>
<tr> <td><font color=blue>Salary of Mr. B is</td> <td>$b$</font></td></tr>
<tr> <td><font color=blue>Salary of Mr. C is</td> <td>$c$</font></td></tr>
</table>";

// =================================================================================

// delays
// current time
echo date('h:i:s') . "<br />";

// prints everything it can up to this point, otherwise it won't print anything until after the delay ends
ob_end_flush();
flush();

// sleep for 1 seconds
sleep(1);
// wake up
echo date('h:i:s') . "<br />";

// ================================================================================
/*
 * php lets you increment a number in a string, if it is at the end of the string in this case you only need
 */
$d = 'A00';
for ($n = 0; $n < 5; $n ++) {
    echo ++ $d . "<br />";
}

// ==============================================================================

// remove duplicates from a list
function removeDuplicates($list)
{
    $numsUnique = array_values(array_unique($list));
    return $numsUnique;
}
$nums = array(
    1,
    1,
    2,
    2,
    3,
    4,
    5,
    5
);
print_r(removeDuplicates($nums));

echo "<br />";

// ==================================================================================
// multiply coressponding elements of 2 lists.
function multiplyList($listA, $listB)
{
    if (count($listA) < count($listB)) {
        for ($i = 0; $i < count($listA); $i ++) {
            echo $listA[$i] * $listB[$i] . "<br />";
        }
    } else {
        for ($i = 0; $i < count($listB); $i ++) {
            echo $listA[$i] * $listB[$i] . "<br />";
        }
    }
}

$a = array(
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10
);

$b = array(
    5,
    4,
    3,
    2,
    1,
    2,
    3,
    4
);

multiplyList($a, $b);

?>
