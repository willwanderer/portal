<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT Search and Features</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Base Styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow-y: auto;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .input-container {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 10px 15px;
            background-color: #fff;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .input-container i {
            margin-right: 10px;
            color: #333;
        }

        .input-container input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 16px;
            padding: 5px;
        }

        /* Enhanced Loading Message */
        .loading-message {
            display: none;
            font-size: 18px;
            color: #007BFF;
            margin-top: 10px;
            font-weight: bold;
        }

        .loading-message span {
            display: inline-block;
            animation: loadingDots 1.5s infinite;
        }

        .loading-message span:nth-child(1) {
            animation-delay: 0s;
        }

        .loading-message span:nth-child(2) {
            animation-delay: 0.3s;
        }

        .loading-message span:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes loadingDots {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        /* Buttons below search */
        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 15px;
        }

        .button {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            color: #fff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .button:hover {
            opacity: 0.8;
        }

        .surprise {
            background-color: #b3e5fc;
            color: #007bb5;
        }

        .summarize {
            background-color: #ffecb3;
            color: #f57c00;
        }

        .advice {
            background-color: #c8e6c9;
            color: #388e3c;
        }

        .write {
            background-color: #f8bbd0;
            color: #c2185b;
        }

        .code {
            background-color: #e1bee7;
            color: #8e24aa;
        }

        .more {
            background-color: #d7ccc8;
            color: #6d4c41;
        }

        /* Results */
        #results {
            display: block;
            width: 100%;
            max-width: 1200px;
            margin-top: 20px;
        }

        .result-container {
            padding: 10px;
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns on large screens */
            gap: 20px;
        }

        .result {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            height: 180px;
            overflow: hidden;
        }

        .result h2 {
            font-size: 16px;
            color: #007BFF;
            margin-bottom: 5px;
        }

        .result .subtitle {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
        }

        .result p {
            font-size: 14px;
            color: #555;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item {
            list-style-type: none;
            margin: 0 5px;
        }

        .pagination .page-link {
            display: inline-block;
            padding: 10px 20px;
            color: #007BFF;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #007BFF;
            color: #fff;
        }

        /* Mobile Styles */
        @media screen and (max-width: 768px) {
            .result-container {
                grid-template-columns: 1fr; /* 1 column on mobile */
            }

            .pagination {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>What can I help with?</h1>
        <div class="input-container">
            <i class="fas fa-search"></i>
            <input type="text" id="search-input" placeholder="Message ChatGPT or Search">
        </div>
        <div class="loading-message" id="loading-message">
            Menampilkan Data <span>.</span><span>.</span><span>.</span>
        </div> <!-- Enhanced loading message -->
        <div class="buttons">
            <button class="button surprise"><i class="fas fa-magic"></i> Surprise me</button>
            <button class="button summarize"><i class="fas fa-align-left"></i> Summarize text</button>
            <button class="button advice"><i class="fas fa-lightbulb"></i> Get advice</button>
            <button class="button write"><i class="fas fa-pen"></i> Help me write</button>
            <button class="button code"><i class="fas fa-code"></i> Code</button>
            <button class="button more"><i class="fas fa-ellipsis-h"></i> More</button>
        </div>
    </div>

    <main id="results">
        <div class="result-container"></div>

        <!-- Pagination (for display purposes only) -->
        <div class="pagination" style="display: none;">
            <div class="page-item">
                <span class="page-link">&laquo; Prev</span>
            </div>
            <div class="page-item">
                <span class="page-link">1</span>
            </div>
            <div class="page-item">
                <span class="page-link">2</span>
            </div>
            <div class="page-item">
                <span class="page-link">3</span>
            </div>
            <div class="page-item">
                <span class="page-link">Next &raquo;</span>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            const mockResults = [];
            for (let i = 1; i <= 12; i++) {
                mockResults.push({
                    title: `Result ${i}`,
                    subtitle: `Subtitle for result ${i}`,
                    description: `Description for result ${i}.`
                });
            }

            function populateResults() {
                $('.result-container').empty();
                mockResults.forEach(result => {
                    $('.result-container').append(`
                        <div class="result">
                            <h2>${result.title}</h2>
                            <p class="subtitle">${result.subtitle}</p>
                            <p>${result.description}</p>
                        </div>
                    `);
                });
                // Show pagination after results are populated
                $('.pagination').show();
                $('#loading-message').hide(); // Hide loading message after results are populated
            }

            $('#search-input').on('keydown', function(event) {
                if (event.key === 'Enter') {
                    $('#loading-message').show(); // Show loading message
                    setTimeout(() => {
                        populateResults(); // Populate results after delay
                    }, 2000); // Simulating loading delay (2 seconds)
                }
            });
        });
    </script>
</body>
</html>
