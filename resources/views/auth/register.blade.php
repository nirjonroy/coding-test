
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
              <div class="card rounded-3">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
                  class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                  alt="Sample photo">
                <div class="card-body p-4 p-md-5">
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>

                  <form class="px-md-2" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-outline mb-4">
                      <input type="text" name="name" id="form3Example1q" class="form-control" />
                      <label class="form-label" for="form3Example1q">Name</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="form3Example1q" class="form-control" />
                        <label class="form-label" for="form3Example1q">Email</label>
                   </div>

               <div class="form-outline mb-4">
                    <input type="password" name="password" id="form3Example1q" class="form-control" />
                    <label class="form-label" for="form3Example1q">Password</label>
               </div>

               <div class="form-outline mb-4">
                <input type="password" name="password_confirmation" id="form3Example1q" class="form-control" />
                <label class="form-label" for="form3Example1q">Confirm Password</label>
           </div>


                    <div class="row">

                      <div class="col-md-6 mb-4">
                        Account Type
                        <select class="select" name="account_type">
                          <option value="1" disabled>Account Type</option>
                          <option value="individual">individual</option>
                          <option value="business">business</option>

                        </select>

                      </div>
                    </div>





                    <button type="submit" class="btn btn-success btn-lg mb-1">Submit</button>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

</body>
</html>
