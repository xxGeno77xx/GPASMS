<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="text"] {
            width: 100%;
            border: none;
            text-align: center;
            font-size: 1em;
        }
        input[type="text"]:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Critères</th>
                <th>Notes du chef immédiat</th>
                <th>Notes du chef hiérarchique suivant</th>
                <th>Notes du chef hiérarchique suivant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1-Assiduité et disponibilité</td>
                <td><input type="text" value="5"></td>
                <td><input type="text" value="45"></td>
                <td><input type="text" value="14.3"></td>
            </tr>
            <tr>
                <td>2-Capacité commerciale, d’initiative et de créativité</td>
                <td><input type="text" name ="alb" value="59"></td>
                <td><input type="text" value="04"></td>
                <td><input type="text" value="09"></td>
            </tr>
            <tr>
                <td>3-Connaissance et conscience professionnelles</td>
                <td><input type="text" value="85"></td>
                <td><input type="text" value="12.5"></td>
                <td><input type="text" value="09"></td>
            </tr>
            <tr>
                <td>4-Capacité d'encadrer et de travailler en groupe</td>
                <td><input type="text" value="5"></td>
                <td><input type="text" value="06"></td>
                <td><input type="text" value="09"></td>
            </tr>
            <tr>
                <td>5-Promptitude à rendre compte et à transmettre les ordres</td>
                <td><input type="text" value="5"></td>
                <td><input type="text" value="06"></td>
                <td><input type="text" value="09"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
