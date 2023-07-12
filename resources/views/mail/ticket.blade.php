<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
          <svg class="bi mt-4 mb-3" style="color: var(--bs-indigo);" width="100" height="100"><use xlink:href="#bootstrap"/></svg>
          <h1 class="text-body-emphasis text-uppercase fw-bold">
             hello {{$data['name']}}
          </h1>
          <p class="col-lg-8 mx-auto fs-5 text-muted">
           <strong>SUBJECT:</strong>  {{$data['subject']}}
          </p>
          <p class="col-lg-8 mx-auto fs-5 text-muted">
            <strong>MESSAGE:</strong> {{$data['body']}}
          </p>
          <p class="col-lg-8 mx-auto fs-5 text-muted">
            <strong>TICKET:</strong> {{$data['ticket']}}
          </p>
          <p class="col-lg-8 mx-auto fs-5 text-muted">
            <strong>TOTAL:</strong> N{{number_format($data['price'], 2)}}
          </p>

          <div class="my-3">
            {{$data['qr_code']}}
          </div>

        </div>
      </div>

</body>
</html>
