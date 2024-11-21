<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/gh/priyashpatil/phone-input-by-country@0.0.1/cpi.css" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdn.jsdelivr.net/gh/priyashpatil/phone-input-by-country@0.0.1/cpi.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>


    @vite('resources/css/app.css')
    @vite('resources/css/style.css')
    @vite('resources/js/singup.js')

</head>
<body>
    <section class="bg-gray-50 dark:bg-gray-900" style="margin: 0 auto;">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0" style="width:700px">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                MikrotekWifi    
            </a>
            <div class="bg-white rounded-lg " >
                <div class=" p-6 space-y-4 md:space-y-6 sm:p-8" >
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{__("site.Create an account")}}
                    </h1>
                    @if(Session::has('success'))
                        <p class="text-sky-500">{{Session::get('success')}}</p>
                    @endif
                    <form class=" space-y-4 md:space-y-6" action="{{route("site.create.account")}}" method="POST">
                        @csrf
                        <div class="flex flex-row" >
                            <div class="group mr-12">
                                <div>
                                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("site.First Name")}}</label>
                                    <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
                                </div>
                                <div>
                                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("site.Last Name")}}</label>
                                    <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
                                </div>
                                <!--<div>
                                    <label for="contry" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("site.Contry")}}</label>
                                    <input type="text" name="contry" id="contry" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
                                </div>-->
                                <div>
                                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("site.City")}}</label>
                                    <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
                                </div>
                                <div class="select-box">
                                    <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("site.Phone")}}</label>
                                    <div class="selected-option">
                                        <div>
                                            <span class="iconify" data-icon="flag:cm-4x3"></span>
                                            <strong>+237</strong>
                                        </div>
                                        <input type="tel" name="number" placeholder="Phone Number" value="+237">
                                        <input type="text" name="country" value="cameroon" class="country" hidden>
                                        <input type="text" name="country_code" value="CM" class="country-code" hidden>
                                    </div>
                                    <div class="options">
                                        <input type="text" class="search-box" placeholder="Search Country Name">
                                        <ol>
                            
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="group">
                  
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("site.Password")}}</label>
                                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__("site.Confirm password")}}</label>
                                    <input type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                      <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                                    </div>
                                    <div class="ml-3 text-sm">
                                      <label for="terms" class="font-light text-gray-500 dark:text-gray-300">{{__("site.I accept the")}}<a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">{{__("site.Terms and Conditions")}}</a></label>
                                    </div>
                                </div>  
                                             
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-sky-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    {{__("site.Already have an account")}}? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">{{__("site.Login here")}}</a>
                                </p>
                    </form>
                </div>
            </div>
        </div>
      </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js" integrity="sha512-vCgNjt5lPWUyLz/tC5GbiUanXtLX1tlPXVFaX5KAQrUHjwPcCwwPOLn34YBFqws7a7+62h7FRvQ1T0i/yFqANA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(session()->has('success'))
<script>
  toastr.options={
      'progessBar':true,
      'closeButton':true
  };
  toastr.success("{{Session::get("success")}}",{timeOut:12000})
  console.log('un monde de merde')
</script>
@endif
@if(session()->has('error'))
<script>
 toastr.options={
     'progessBar':true,
     'closeButton':true
 };
 let err={!! Session::get('error') !!};
 for (const [key, value] of Object.entries(err)) {
console.log(`${key}: ${value}`);
toastr.error(value,{timeOut:12000});
}
 
 //console.log('un monde de merde')
</script>
@endif
@if(session()->has('warn'))
<script>
 toastr.options={
     'progessBar':true,
     'closeButton':true
 };
 let warn ="{{Session::get("warn")}}"
 console.log(warn);
toastr.error("{{Session::get("warn")}}",{timeOut:12000});
 
 //console.log('un monde de merde')
</script>
@endif
</html>