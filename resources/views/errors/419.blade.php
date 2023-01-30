
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
  background-image: url({{ asset('frontend/img/bg419.jpg') }});

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
    margin-top: 50px;
    padding: 10px;
    padding-left: 40px;
    padding-right: 40px;
    color: #ffff;
    background-color: #68c4c6;
    border-radius: 17px;
    font-size: 25px;
    border: 0px;
    cursor: pointer;
    padding-top: 15px;
}
.btn-finns:hover{
  background-color: #76cfd3;

}
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
    src: url('{{ asset("/fonts/poppins-regular.ttf") }}');
}
@font-face {
    font-family: 'poppins-bold';
    src: url('{{ asset("/fonts/poppins-bold.ttf") }}');
}
@font-face {
    font-family: 'montserrat-bold';
    src: url('{{ asset("/fonts/montserrat-bold.ttf") }}');
}

@font-face {
    font-family: 'montserrat-reg';
    src: url('{{ asset("/fonts/montserrat-reg.ttf") }}');
}
@font-face {
    font-family: 'raleway-reg';
    src: url('{{ asset("/fonts/raleway.regular.ttf") }}');
}
@font-face {
    font-family: 'raleway-thin';
    src: url('{{ asset("/fonts/raleway.thin.ttf") }}');
}
@font-face {
    font-family: 'gilroy-bold';
    src: url('{{ asset("/fonts/Gilroy-Bold.ttf") }}');
}
@font-face {
    font-family: 'gilroy-reg';
    src: url('{{ asset("/fonts/Gilroy-Regular.ttf") }}');
}
</style>
</head>
<body>

<div class="bg-image"></div>

<div class="bg-text">
    <div class="row">
        <div style="max-width: 165px;">
            <img src="{{ asset('assets/img/assets/finns-logo-tiffanyblue.png') }}" class="logo" style="max-width: 100%;">
        </div>
    </div>
    <div style="margin-top: 40px">
      <div style="font-size:73px" class="gilroy-reg">ERROR</div>
      <div style="font-size:130px;" class="gilroy-bold">419</div>
    </div>
    <div style="font-size:20px" class="raleway-reg">Sorry, your session has expired, <br> please refresh your page and <br> try again.</div>

    <button type="button" class="btn-finns gilroy-reg">Go Back</button>
</div>
<script src="{{ asset('tabler/js/jquery.min.js') }}"></script>
<script type="text/javascript">
$(function () {
        $(document).on('click', '.btn-finns', function(e) {
          console.log('heheh');
            window.location.href = "{{ route('home') }}";
        })
    })
</script>
</body>
</html>
