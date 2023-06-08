<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - Login Page</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <section>
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto h-screen bg-sky-600">
            <!-- Card -->
            <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow">
                <h2 class="text-2xl font-bold text-gray-900 ">
                    Sign in
                </h2>
                @if (!empty(session()->get('error')))
                    <div class="text-white bg-red-600 text-md p-2 rounded-lg">{{session()->get('error')}}</div>
                @endif
                <form class="mt-8 space-y-6" action="{{route('signIn')}}" method="POST" validation="true">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                            placeholder="name@company.com" required>
                        @error('email') <div class="alert alert-danger"> {{$message}} </div> @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                            required>
                    </div>
                    <button type="submit"
                        class="w-full px-5 py-3 font-medium text-center text-black bg-blue-100 rounded-lg hover:bg-black hover:text-white focus:ring-4 focus:ring-primary-300 sm:w-auto">Login</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
