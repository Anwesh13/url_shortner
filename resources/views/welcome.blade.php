<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel URL Shortener</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 2rem;
      background: #f0f2f5;
      max-width: 600px;
      margin: auto;
    }
    h1 {
      text-align: center;
      margin-bottom: 2rem;
    }
    input, button {
      padding: 10px;
      margin: 8px 0;
      width: 100%;
    }
    .result {
      margin-top: 1rem;
      font-weight: bold;
    }
    hr {
      margin: 2rem 0;
    }
  </style>
</head>
<body>
  <h1>Laravel 12 - Local URL Shortener</h1>

  <label for="longUrl">Enter a long URL to shorten:</label>
  <input type="text" id="longUrl" placeholder="https://example.com/very/long/url">
  <button onclick="shortenUrl()">Shorten</button>
  <div class="result" id="shortResult"></div>

  <hr>

  <label for="shortUrl">Paste a shortened URL to decode:</label>
  <input type="text" id="shortUrl" placeholder="http://short.est/XyZ123">
  <button onclick="decodeUrl()">Decode</button>
  <div class="result" id="decodeResult"></div>

  <script>
    async function shortenUrl() {
      const url = document.getElementById('longUrl').value;
      const res = await fetch('/api/encode', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ url })
      });

      const data = await res.json();
      document.getElementById('shortResult').innerText =
        data.short_url ? 'Short URL: ' + data.short_url : 'Error: ' + (data.error || 'Invalid input');
    }

    async function decodeUrl() {
      const short_url = document.getElementById('shortUrl').value;
      const res = await fetch('/api/decode', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ short_url })
      });

      const data = await res.json();
      document.getElementById('decodeResult').innerText =
        data.original_url ? 'Original URL: ' + data.original_url : 'Error: ' + (data.error || 'Invalid input');
    }
  </script>
</body>
</html>
