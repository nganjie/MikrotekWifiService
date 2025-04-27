<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>signup</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/gh/priyashpatil/phone-input-by-country@0.0.1/cpi.css" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdn.jsdelivr.net/gh/priyashpatil/phone-input-by-country@0.0.1/cpi.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>


</head>
<body id='body' data-zoneWifi="{{$zoneWifi}}" data-urlt="http://{{$zoneWifi->captive_gate}}?username={{$ticket->username}}&password={{$ticket->password}}">
    <section class="bg-gray-50 dark:bg-gray-900" >
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0" style="width:700px">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                {{$zoneWifi->name}}   
            </a>
            <div class="bg-white rounded-lg " >
                <div class=" p-6 space-y-4 md:space-y-6 sm:p-8" >
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{__("Paiement de ticket")}} : <span class="text-sky-500">{{$type}}</span>
                    </h1>
                    
                    

<div class="relative overflow-x-auto w-full">
    <table id='info-tab' class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{__('amount')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    USERNAME
                </th>
                <th scope="col" class="px-6 py-3">
                    PASSORD
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ round($transaction->price) }} FCFA
                </th>
                <td class="px-6 py-4">
                    {{$ticket->username}}
                </td>
                <td class="px-6 py-4">
                    {{$ticket->password}}
                </td>
            </tr>
        </tbody>
    </table>
    <button type="submit" class="w-full mt-10 text-white bg-sky-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"><a href="http://{{$zoneWifi->captive_gate}}?username={{$ticket->username}}&password={{$ticket->password}}">Se connecter Maintenant</a></button>
    <br><br>
    <button type="submit" id='telecharger'  class="mb-8 text-white bg-sky-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"><a href="{{route('site.buy.ticket.doaload',$transaction)}}">Telecharger</a></button>
</div>

                   
                </div>
            </div>
        </div>
      </section>
</body>
<script>
    const bt = document.getElementById('body');

    setTimeout(() => {
        console.log('add : ',bt.dataset.urlt)
        window.location.href=bt.dataset.urlt
    },12*1000);
    console.log('add : ',bt.dataset.urlt)
  console.log('un monde de merde')
</script>
<script>


 
 //console.log('un monde de merde')
</script>
</html>