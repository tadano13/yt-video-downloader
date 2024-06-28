<?php
/**
 * YouTube Video Downloader
 *
 * This script takes a YouTube video URL or ID as input, extracts the video ID,
 * and uses the RapidAPI to retrieve video details and a download link.
 *
 * @author tadano
 */

session_start();

/**
 * Get YouTube video ID from a given URL
 *
 * @param string $url YouTube video URL
 * @return string|false Video ID or false if not found
 */
function getYouTubeVideoId($url) {
    $patterns = [
        '#^(?:https?://)?(?:www\\.)?(?:youtube\\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)|.*[?&]v=)|youtu\\.be/)([^"&?/ ]{11})#',
        '#^(?:https?://)?(?:www\\.)?youtu\\.be/([^"&?/ ]{11})#',
        '#^(?:https?://)?(?:www\\.)?youtube\\.com/embed/([^"&?/ ]{11})#',
        '#^(?:https?://)?(?:www\\.)?youtube\\.com/v/([^"&?/ ]{11})#',
        '#^(?:https?://)?(?:www\\.)?youtube\\.com/user/.*#p/.+/([^"&?/ ]{11})#',
        '#^(?:https?://)?(?:www\\.)?youtube\\.com/watch\\?v=([^"&?/ ]{11})#'
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
    }

    return false;
}

// Example usage:
// $url = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
// $videoId = getYouTubeVideoId($url);
// echo $videoId; // Output: dQw4w9WgXcQ

$url = isset($_POST['main']) ? $_POST['main'] : '';
$videoIdFromForm = isset($_POST['videoId']) ? $_POST['videoId'] : '';

if (empty($url) && empty($videoIdFromForm)) {
    echo "<p>Please provide a URL.</p>";
    exit;
}

$videoId = $videoIdFromForm ? $videoIdFromForm : getYouTubeVideoId($url);

if (!$videoId) {
    echo "<p>Invalid URL or couldn't find the video ID. Please check the URL.</p>";
    echo "<p>Watch this video to learn how to retrieve a YouTube video ID: <a href='https://www.youtube.com/watch?v=liJVSwOiiwg'>How to Retrieve YouTube Video ID</a></p>";
    echo "<form method='post'>";
    echo "<p>Enter YouTube Video ID directly:</p>";
    echo "<input type='text' name='videoId' placeholder='Enter video ID here'>";
    echo "<button type='submit'>Submit</button>";
    echo "</form>";
    exit;
}

$_SESSION['videoId'] = $videoId;

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://ytstream-download-youtube-videos.p.rapidapi.com/dl?id=$videoId",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-rapidapi-host: ytstream-download-youtube-videos.p.rapidapi.com",
        "x-rapidapi-key: a5494d3184msh22c0dcd2a596ab7p159360jsn3d0e74734b6f"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #: " . $err;
    session_destroy();
    exit;
}

$decoded = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "<p>Failed to decode the response from the API.</p>";
    session_destroy();
    exit;
}

if (!isset($decoded['title'])) {
    echo "<p>Couldn't retrieve the video details. Please try again later.</p>";
    session_destroy();
    exit;
}

$title = $decoded['title'];
$time = $decoded['lengthSeconds'];
$channel_title = $decoded['channelTitle'];
$description = $decoded['description'];
$link = $decoded['adaptiveFormats'][0]['url'];
$quality = $decoded['adaptiveFormats'][0]['qualityLabel'];
$key_words = isset($decoded['keywords']) ?$decoded['keywords'] : [];

echo "<html>";
echo "<head>";
echo "<link rel='stylesheet' href='/css/php_page'>";
echo "</head>";
echo "<body>";
echo "<div class='data-container'>";
echo "<h2>YOUR DATA IS :</h2>";
echo "<p>Title: $title</p>";
echo "<p>Time: $time seconds</p>";
echo "<p>Quality: $quality</p>";
echo "<p>Channel: $channel_title</p>";
echo "<p>Download link: <a href='$link'>Click here</a> (a video playback will be done after you click on link you will see 3 dots on left corner click on that to get download option.)</p>";
echo "<p>Keywords:</p>";
if (!empty($key_words)) {
    foreach($key_words as $words){
        echo $words.",";
    }
} else {
    echo "<p>No keywords available.</p>";
}
echo "<p>Description: $description</p>";
echo "</div>";
echo "</body>";
echo "</html>";

session_destroy();
?>