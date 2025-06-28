<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <form method="post" action="/upload" enctype="multipart/form-data">

          <label for="file-1">Transactions CSV file (#1): </label>
          <input type="file" id="file-1" name="csv_files[]">

          <br/>
          <br/>

          <label for="file-2">Transactions CSV file (#2): </label>
          <input type="file" id="file-2" name="csv_files[]">

          <br/>
          <br/>

          <button type="submit">Upload</button>

        </form>
    </body>
</html>
