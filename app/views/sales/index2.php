<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Table Colors</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    text-align: center;
    margin: 50px;
}

h1 {
    color: #333;
}

table {
    width: 50%;
    margin: 0 auto;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f4f4f4;
}

td {
    height: 50px;
}

button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;
}

</style>
<body>
    <h1>Print Table with Colors</h1>
    <table id="colorTable">
        <thead>
            <tr>
                <th>Color Name</th>
                <th>Color</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Red</td>
                <td style="background-color: red;"></td>
            </tr>
            <tr>
                <td>Green</td>
                <td style="background-color: green;"></td>
            </tr>
            <tr>
                <td>Blue</td>
                <td style="background-color: blue;"></td>
            </tr>
            <tr>
                <td>Yellow</td>
                <td style="background-color: yellow;"></td>
            </tr>
        </tbody>
    </table>
    <button id="printBtn">Print</button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
<script>
    $(document).ready(function() {
    $('#printBtn').click(function() {
        window.print();
    });
});

</script>
</html>
