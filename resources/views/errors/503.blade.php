
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-image {
  /* The image used */
  background-image: url({{ asset('frontend/img/sunset-bg.jpeg') }});

  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* Position text in the middle of the page/image */
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: #ececec;
  font-weight: bold;
  border: 3px solid #f1f1f1;
  border-radius: 43px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 60%;
  padding: 20px;
  text-align: center;
}
.logo-row {
    /* width: 250px; */
    margin: 0 auto;
}

.logo {
    margin-top: 30px;
    width: 100%;
    text-align: center;
}
</style>
</head>
<body>

<div class="bg-image"></div>

<div class="bg-text">
    <div class="row">
        <div class="logo-row" style="max-width: 250px;">
            <img src="{{ asset('assets/img/assets/finns-logo-tiffanyblue.png') }}" class="logo" style="max-width: 100%;">
        </div>
    </div>
  <h1 style="font-size:40px">We’ll be back soon!</h1>
  <h3>Sorry, our booking system is currently undergoing maintenance. Please return to make your booking soon.</h3><br>
  <h3>Finns Beach Club will be open from 10:00am tomorrow as per normal. Walk-in bookings available.</h3>
  {{-- <h3 >Sorry for the inconvenience. We’re performing some maintenance at the moment.</h2> --}}
</div>

</body>
</html>
