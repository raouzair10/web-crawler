<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matched URLs</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        header {
            background-color: #007bff;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        a {
            color: #007bff;
            text-decoration: none;
            word-break: break-all;
        }

        a:hover {
            text-decoration: underline;
        }

        footer {
            margin-top: 20px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Matched URLs</h1>

    <ul>
    <?php
$startTime = time();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchString = $_POST['searchString'];
    $seedUrl = $_POST['seedUrl'];
}

set_time_limit(120); // Set to the desired time limit in seconds

$depthLimit = 1;    // User can set the maximum depth here

$urlQueue = [];
$visitedUrls = [];
$matchedUrls = [];

function addToQueue($url, $depth) {
    global $urlQueue;
    $urlQueue[] = ['url' => $url, 'depth' => $depth];
}

function fetchHtmlContent($url) {
    $htmlContent = @file_get_contents($url);
    if ($htmlContent === false) {
        echo 'Failed to fetch content from ' . $url . "\n";
    }
    return $htmlContent;
}

function parseHtmlAndExtractLinks($htmlContent, $currentDepth) {
    global $urlQueue;
    $dom = new DOMDocument;
    @$dom->loadHTML($htmlContent);

    $links = $dom->getElementsByTagName('a');
    foreach ($links as $link) {
        $href = $link->getAttribute('href');
        if (filter_var($href, FILTER_VALIDATE_URL)) {
            addToQueue($href, $currentDepth + 1);
        }
    }
}

function searchAndDisplayMatchedContent($url, $htmlContent) {
    global $searchString, $matchedUrls;
    
    if (strpos($htmlContent, $searchString) !== false) {
        echo '<li><a href="' . $url . '" target="_blank">' . $url . '</a></li>';
    }
}

function startCrawling($seedUrl) {
    global $urlQueue, $visitedUrls, $depthLimit;

    addToQueue($seedUrl, 0);

    while (!empty($urlQueue)) {
        $currentUrlData = array_shift($urlQueue);
        $currentUrl = $currentUrlData['url'];
        $currentDepth = $currentUrlData['depth'];

        if ($currentDepth <= $depthLimit && !in_array($currentUrl, $visitedUrls)) {
            $htmlContent = fetchHtmlContent($currentUrl);

            if ($htmlContent) {
                parseHtmlAndExtractLinks($htmlContent, $currentDepth);
                searchAndDisplayMatchedContent($currentUrl, $htmlContent);
                $visitedUrls[] = $currentUrl;
            }
        }
    }
}

startCrawling($seedUrl);
?>
    </ul>

</body>
</html>
