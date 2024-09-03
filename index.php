<!DOCTYPE html>
<html data-theme="dark" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/tailwind.css">
    <title>File Bot</title>
</head>
<body class="font-sans bg-base-100 m-0 p-0 flex flex-col min-h-screen">


    <header class="bg-neutral text-black text-center py-2 font-serif">
        <img src="1631306737063-removebg-preview.png" alt="extole" class="w-14 h-12 mx-auto">
    </header>
    <input type="checkbox" value="mytheme" class="toggle theme-controller" />
    <div class="flex-1 p-6 max-w-lg mx-auto bg-neutral shadow-lg rounded-lg mt-6">
        <h2 class="text-xl font-semibold mb-4 text-center">Upload Your File</h2>
        <form id="uploadForm" class="text-center" method="POST" enctype="multipart/form-data">
        <input type="file" class="file-input w-full max-w-xs" />
            <br>
            <button type="submit" class="bg-neutral text-white py-2 px-4 border-none rounded cursor-pointer hover:bg-green-600 m-2">
                Upload and Process
            </button>
        </form>
        
        <div class="hidden mt-4 w-full bg-gray-100 rounded">
            <div class="h-5 w-0 bg-green-500 rounded text-center text-white leading-5 transition-width duration-200" id="progressBarFill">
                0%
            </div>
        </div>
        <div class="mt-4 p-4 border border-gray-300 bg-gray-50 rounded min-h-[50px]" id="responseBox">
            <!-- The bot's response will be displayed here -->
        </div>
        <div class="text-red-600 mt-2" id="errorBox"></div>
    </div>

    <footer class="text-center py-2 bg-neutral text-white mt-6">
        <p>&copy; 2024 Extole bot</p>
    </footer>


    <script>
        const form = document.getElementById('uploadForm');
        const fileInput = document.getElementById('fileInput');
        const progressBar = document.getElementById('progressBar');
        const progressBarFill = document.getElementById('progressBarFill');
        const responseBox = document.getElementById('responseBox');
        const errorBox = document.getElementById('errorBox');

        const allowedFileTypes = ['application/pdf', 'text/plain']; // Add more MIME types as needed
        const maxFileSize = 2 * 1024 * 1024; // 2 MB size limit

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const file = fileInput.files[0];
            errorBox.textContent = '';
            responseBox.textContent = '';

            if (!allowedFileTypes.includes(file.type)) {
                errorBox.textContent = 'Invalid file type. Please upload a PDF or TXT file.';
                return;
            }

            if (file.size > maxFileSize) {
                errorBox.textContent = 'File size exceeds 2 MB limit.';
                return;
            }

            progressBar.style.display = 'block';
            progressBarFill.style.width = '0%';
            progressBarFill.textContent = '0%';

            const formData = new FormData();
            formData.append('file', file);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'upload.php', true); // Ensure the path is correct

            xhr.upload.onprogress = function(event) {
                if (event.lengthComputable) {
                    const percentComplete = (event.loaded / event.total) * 100;
                    progressBarFill.style.width = percentComplete + '%';
                    progressBarFill.textContent = Math.floor(percentComplete) + '%';
                }
            };

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        responseBox.textContent = response.message;
                    } else {
                        responseBox.textContent = response.message;
                    }
                    progressBarFill.style.width = '100%';
                    progressBarFill.textContent = '100%';
                } else {
                    responseBox.textContent = 'Upload failed. Please try again.';
                }
            };

            xhr.onerror = function() {
                responseBox.textContent = 'An error occurred during the upload.';
            };

            xhr.send(formData);
        });
    </script>

</body>
</html>
