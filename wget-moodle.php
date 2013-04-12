<?php
//e.g. http://downloads.sourceforge.net/project/moodle/Moodle/stable24/moodle-latest-24.zip?r=http%3A%2F%2Fdownload.moodle.org%2Fdownload.php%2Fstable24%2Fmoodle-latest-24.zip&ts=1363396818&use_mirror=hivelocity
die('Disabled');
?>
<form method="post">
    <input name="url" size="50" />
    <input name="submit" type="submit" />
</form>
<?php
error_reporting(E_ALL | E_STRICT); // NOT FOR PRODUCTION SERVERS!
ini_set('display_errors', '1');    // NOT FOR PRODUCTION SERVERS!

function downloadFile($url, $path) {

    $newfname = $path;
    $file = fopen($url, "rb");
    if ($file) {
        $newf = fopen($newfname, "wb");

        if ($newf)
            while (!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                echo ".<br />\n";
            }
    }
    echo "done!<br />\n";
    if ($file) {
        fclose($file);
    }

    if ($newf) {
        fclose($newf);
    }
}

if (isset($_POST['url']) && !empty($_POST['url'])) {
    // maximum execution time in seconds
    set_time_limit(10 * 60);

    if (!isset($_POST['submit']))
        die('Nothing submitted');

    $url = $_POST['url'];
    echo "url=$url<br />\n";

    // folder to save downloaded files to. Must end with slash
    $destination_folder = dirname(__FILE__);
    echo "  destination_folder=$destination_folder<br />\n";

    $path = $destination_folder . '/moodle-latest.zip';
    echo "  destination path=$path<br />\n";

    downloadFile($url, $path);
}
