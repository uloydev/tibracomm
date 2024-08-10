<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="/assets/img/favicon.png" />
    <title>Tibracomm.</title>
    @vite('resources/css/app.css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="/assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5" rel="stylesheet" />
</head>

<body class="m-0 font-sans antialiased font-normal bg-slate-800 text-start text-base leading-default text-slate-500">
    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
        <section>
            <div class="relative flex items-center p-0 overflow-hidden bg-center bg-cover min-h-75-screen">
                <div class="container z-10">
                    <div class="flex flex-wrap mt-0 -mx-3">
                        @include('components.error')
                        <div
                        class="flex flex-col w-full max-w-full px-3 mx-auto md:flex-0 md:w-6/12 lg:w-5/12 xl:w-4/12">
                        <div
                        class="relative flex flex-col min-w-0 mt-32 break-words bg-white border-0 rounded-2xl bg-clip-border shadow-2xl">
                                <div class="p-12 pb-0 mb-0 bg-transparent border-b-0 rounded-t-2xl">
                                    <h3
                                        class="relative z-10 font-bold text-transparent bg-dark-gradient bg-clip-text">
                                        Welcome back</h3>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="flex-auto px-12 pt-4 pb-8">
                                    <form role="form" method="POST" class="border-t-2 pt-8">
                                        @method('POST')
                                        @csrf
                                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                        <div class="mb-4">
                                            <input name="email" type="email"
                                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                placeholder="Email" aria-label="Email" aria-describedby="email-addon" />
                                        </div>
                                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
                                        <div class="mb-4">
                                            <input name="password" type="password"
                                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon" />
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-gray-900 to-slate-800 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="p-3 px-1 pt-0 text-center bg-transparent border-t-0 border-t-solid rounded-b-2xl lg:px-2">
                                    <p class="mx-auto mb-6 leading-normal text-sm">
                                        Back to
                                        <a href="/"
                                            class="relative z-10 font-semibold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">Home</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<!-- plugin for scrollbar  -->
<script src="/assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="/assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>

</html>
