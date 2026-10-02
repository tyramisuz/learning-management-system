<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <!-- Include the required CSS and JS libraries -->
    <style>
        #video {
            width: 100%;
            max-width: 500px;
            border: 1px solid black;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>QR Code Scanner</h1>
    <div>
        <video id="video" playsinline></video>
    </div>
    <div>
        <button id="startButton">Start Scanner</button>
    </div>
    <div id="result"></div>

    <!-- Include QR Code Scanning library -->
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script>
        let selectedDeviceId;
        const codeReader = new ZXing.BrowserMultiFormatReader();
        const video = document.getElementById('video');

        document.getElementById('startButton').addEventListener('click', () => {
            codeReader
                .listVideoInputDevices()
                .then((videoInputDevices) => {
                    selectedDeviceId = videoInputDevices[0].deviceId;
                    codeReader.decodeOnceFromVideoDevice(selectedDeviceId, 'video').then((result) => {
                        document.getElementById('result').textContent = result.text;
                        
                        // Parse the scanned result
                        const params = new URLSearchParams(result.text);
                        const id = params.get('id');
                        const url = params.get('url');
                        
                        // Make an AJAX request to check if the group exists
                        $.ajax({
                            url: '{{ route("groups.check") }}',
                            method: 'GET',
                            data: { id: id },
                            success: function(response) {
                                if (response.exists) {
                                    // Redirect to the group join route
                                    window.location.href = url;
                                } else {
                                    // Show an error message
                                    alert('Group does not exist.');
                                }
                            },
                            error: function() {
                                alert('An error occurred while checking the group.');
                            }
                        });

                    }).catch((err) => console.error(err));
                })
                .catch((err) => console.error(err));
        });
    </script>
</body>
</html>
