
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
  background-image: url({{ asset('assets/404-1.jpg') }});

  /* Add the blur effect */
  /* filter: blur(8px);
  -webkit-filter: blur(8px); */

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* Position text in the middle of the page/image */
.bg-text {
  color: #ffffff;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 60%;
}

.logo {
    margin-top: 30px;
    width: 100%;
    text-align: center;
}
.btn-finns{
    margin-top: 20px;
    padding: 10px;
    padding-left: 40px;
    padding-right: 40px;
    border-radius: 17px;
    font-size: 25px;
    border: 0px;
    cursor: pointer;
    padding-top: 15px;
}
/* .btn-finns:hover{
  background-color: #76cfd3;

} */
.raleway-reg{
  font-family: raleway-reg;
}
.raleway-thin{
  font-family: raleway-thin;
}
.gilroy-bold{
  font-family: gilroy-bold;
}
.gilroy-reg{
  font-family: gilroy-reg;
}
@font-face {
    font-family: 'poppins-regular';
    src: url('{{ asset("assets/fonts/poppins-regular.ttf") }}');
}
@font-face {
    font-family: 'poppins-bold';
    src: url('{{ asset("assets/fonts/poppins-bold.ttf") }}');
}
@font-face {
    font-family: 'montserrat-bold';
    src: url('{{ asset("assets/fonts/montserrat-bold.ttf") }}');
}

@font-face {
    font-family: 'montserrat-reg';
    src: url('{{ asset("assets/fonts/montserrat-reg.ttf") }}');
}
@font-face {
    font-family: 'raleway-reg';
    src: url('{{ asset("assets/fonts/raleway.regular.ttf") }}');
}
@font-face {
    font-family: 'raleway-thin';
    src: url('{{ asset("assets/fonts/raleway.thin.ttf") }}');
}
@font-face {
    font-family: 'gilroy-bold';
    src: url('{{ asset("assets/fonts/Gilroy-Bold.ttf") }}');
}
@font-face {
    font-family: 'gilroy-reg';
    src: url('{{ asset("assets/fonts/Gilroy-Regular.ttf") }}');
}
</style>
</head>
<body>

<div class="bg-image"></div>

<div class="bg-text">
    <div class="row">
        <div style="max-width: 200px; margin-left:13px">
            <img src="{{ asset('assets/logoJP.png') }}" class="logo" style="max-width: 100%;">
        </div>
    </div>
    <div style="margin-top: 10px;">
      <div style="font-size:73px" class="gilroy-reg">ERROR</div>
      <div style="font-size:130px;margin-top: -25px;" class="gilroy-bold">404</div>
    </div>
    <div style="font-size:20px; margin-top: -15px;" class="raleway-reg">Sorry, page not found <br> make sure type the correct <br> site or page are you looking <br> already removed from server.</div>

    {{-- <button  type="button" class="btn-finns gilroy-reg">Go Back</button> --}}
    <x-primary-button class="ml-3 btn-finns btn-finns gilroy-reg">
      {{ __('Go Back') }}
    </x-primary-button>
</div>
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
$(function () {
        $(document).on('click', '.btn-finns', function(e) {
          console.log('heheh');
            window.location.href = "{{ url('') }}";
        })
    })
</script>
</body>
</html>
