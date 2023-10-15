<?php
if (isset($_GET['pdf'])) {
    // Get the PDF URL
    $pdfUrl = $_GET['pdf'];
} else {
    echo 'PDF file not specified.';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ver Expediente</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100%;
        }

        iframe {
            border: none;
            width: 100%;
            height: 100%;
            display: block;
        }
    </style>
</head>
<body>
    <iframe src="<?php echo $pdfUrl; ?>" id="pdfFrame"></iframe>

    <script>
        // Make the iframe fullscreen
        var iframe = document.getElementById('pdfFrame');
        iframe.style.width = window.innerWidth + 'px';
        iframe.style.height = window.innerHeight + 'px';

        // Adjust the iframe dimensions when the window is resized
        window.onresize = function() {
            iframe.style.width = window.innerWidth + 'px';
            iframe.style.height = window.innerHeight + 'px';
        };
    </script>
</body>
</html>
