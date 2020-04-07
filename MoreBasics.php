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


?>