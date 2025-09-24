<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Order BTUSUP</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-blue-50">
    <!-- component -->
    <div class="flex min-h-screen items-center justify-center bg-gray-100">
        <div class="rounded-lg bg-gray-50 px-16 py-14">
            <div class="flex justify-center">
                <div class="rounded-full bg-green-200 p-6">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                </div>
            </div>
            <h3 class="my-4 text-center text-3xl font-semibold text-gray-700">Congratuation {{ $user->name }} !!!</h3>
            <p class="w-full text-center font-normal text-gray-600">Your tailwind project will be started {{$user->email}} </p>
            <button class="mx-auto mt-10 block rounded-xl border-4 border-transparent bg-orange-400 px-6 py-3 text-center text-base font-medium text-orange-100 outline-8 hover:outline hover:duration-300">Track Order</button>
        </div>
    </div>
</body>

</html>