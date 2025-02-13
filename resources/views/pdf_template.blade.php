<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"> <!-- Specify UTF-8 encoding -->
    <title>Question PDF</title>
    <style>
        /* General Styles */
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif; /* Use a font that supports scientific symbols */
            margin: 20px;
            line-height: 1.6;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 40px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #bdc3c7;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Optional: Responsive Tables */
        @media screen and (max-width: 600px) {
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                font-weight: bold;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    {!! $question->content !!}
</body>

</html>
