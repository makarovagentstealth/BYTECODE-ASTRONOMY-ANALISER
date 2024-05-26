<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bytecode Interpreter</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            width: 100%;
            height: 200px;
            margin-bottom: 10px;
        }
        button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .module {
            background-color: black;
            color: red;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
    <script>
        function submitPayload() {
            var payload = document.getElementById("payload").value;
            fetch('/analyze', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ payload: payload })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("result").innerText = "Densidade Espectral de Energia: " + data.spectral_density + " J/m^3";
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Bytecode Interpreter</h1>
        <label for="payload">Insira as configurações astronômicas:</label><br>
        <textarea id="payload" name="payload" placeholder="Insira as configurações astronômicas aqui..." required></textarea><br>
        <button type="button" onclick="submitPayload()">Analisar</button>
        <div id="result" class="module"></div>
    </div>
</body>
</html>
