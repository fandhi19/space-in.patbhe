<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tim Developer - SPACE-IN PATBHE | SMAN 4 Yogyakarta</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Font --}}
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- Favicon --}}
    <link rel="shortcut icon"
          href="{{ asset('images/logo-web.png') }}"
          type="image/x-icon">


    <style>

        body {
            font-family: 'Inter', sans-serif;
        }


        /* Gradient Text */

        .gradient-text {
            background: linear-gradient(
                90deg,
                #facc15,
                #fde68a
            );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }


        /* Background Pattern */

        .grid-pattern {
            background-image:
                radial-gradient(
                    rgba(255,255,255,.12) 1px,
                    transparent 1px
                );

            background-size: 22px 22px;
        }


        /* Developer Card */

        .profile-card {
            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }


        .profile-card:hover {
            transform: translateY(-8px);

            box-shadow:
                0 20px 40px rgba(20,43,82,.12);
        }


        /* Developer Image */

        .profile-image {
            transition:
                transform .5s ease;
        }


        .profile-card:hover .profile-image {
            transform: scale(1.05);
        }

    </style>

</head>


<body class="bg-[#f8fafc] text-[#333333] scroll-smooth">


{{-- ========================================================= --}}
{{-- NAVBAR --}}
{{-- ========================================================= --}}

<nav class="bg-white shadow-sm sticky top-0 z-50">

    <div class="max-w-7xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8">

        <div class="flex
                    justify-between
                    h-16
                    items-center">


            {{-- Logo --}}

            <a href="{{ url('/') }}"
               class="flex items-center space-x-3">

                <img src="{{ asset('images/logo-web.png') }}"
                     alt="Logo SMAN 4 Yogyakarta"
                     class="w-11 h-11">

                <div>

                    <span class="font-bold
                                 text-lg
                                 text-[#142b52]
                                 block
                                 leading-none">

                        SPACE-IN PATBHE

                    </span>

                    <span class="text-xs
                                 text-[#666666]">

                        SMAN 4 Yogyakarta

                    </span>

                </div>

            </a>


            {{-- Navigation --}}

            <div class="hidden
                        md:flex
                        items-center
                        space-x-8
                        font-medium
                        text-[#555555]">

                <a href="{{ url('/') }}"
                   class="hover:text-[#eab308] transition">

                    Beranda

                </a>

                <a href="#tim"
                   class="hover:text-[#eab308] transition">

                    Tim Developer

                </a>

                <a href="#teknologi"
                   class="hover:text-[#eab308] transition">

                    Teknologi

                </a>

                <a href="#kontak"
                   class="hover:text-[#eab308] transition">

                    Kontak

                </a>

            </div>

        </div>

    </div>

</nav>



{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<section class="relative
                bg-[#142b52]
                text-white
                overflow-hidden">


    {{-- Background Pattern --}}

    <div class="absolute
                inset-0
                grid-pattern
                opacity-40">
    </div>


    {{-- Decorative Circle --}}

    <div class="absolute
                -top-32
                -right-32
                w-96
                h-96
                bg-[#facc15]/10
                rounded-full
                blur-3xl">
    </div>


    <div class="relative
                z-10
                max-w-7xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8">


        <div class="py-20
                    lg:py-28
                    text-center
                    max-w-4xl
                    mx-auto">


            {{-- Badge --}}

            <div class="inline-flex
                        items-center
                        gap-2
                        bg-white/10
                        border
                        border-[#facc15]/30
                        text-[#facc15]
                        text-xs
                        font-semibold
                        uppercase
                        tracking-wider
                        px-4
                        py-2
                        rounded-full
                        mb-6">

                <i class="fa-solid fa-code"></i>

                Developer Team

            </div>


            {{-- Title --}}

            <h1 class="text-4xl
                       sm:text-5xl
                       lg:text-6xl
                       font-extrabold
                       tracking-tight
                       leading-tight">

                Di Balik Layar

                <span class="gradient-text">

                    SPACE-IN PATBHE

                </span>

            </h1>


            {{-- Description --}}

            <p class="mt-6
                      text-lg
                      sm:text-xl
                      text-[#d1d5db]
                      leading-relaxed
                      max-w-3xl
                      mx-auto">

                Kenali orang-orang di balik pengembangan
                SPACE-IN PATBHE — sistem digital untuk
                mempermudah pengelolaan peminjaman ruangan
                dan barang di SMAN 4 Yogyakarta.

            </p>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- ABOUT TEAM --}}
{{-- ========================================================= --}}

<section class="py-20 bg-white">

    <div class="max-w-4xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8
                text-center">


        <div class="w-14
                    h-14
                    bg-[#facc15]/20
                    rounded-full
                    flex
                    items-center
                    justify-center
                    mx-auto
                    mb-6">

            <i class="fa-solid
                      fa-people-group
                      text-[#142b52]
                      text-2xl">
            </i>

        </div>


        <h2 class="text-3xl
                   font-bold
                   text-[#142b52]">

            Siapa Kami?

        </h2>


        <div class="w-20
                    h-1
                    bg-[#eab308]
                    mx-auto
                    mt-4
                    rounded">
        </div>


        <p class="mt-6
                  text-[#666666]
                  text-lg
                  leading-relaxed">

            Kami adalah tim developer yang berperan dalam
            merancang, membangun, dan mengembangkan
            SPACE-IN PATBHE.

            Setiap anggota memiliki peran dan keahlian
            masing-masing untuk memastikan sistem dapat
            digunakan dengan mudah, aman, dan nyaman
            oleh warga SMAN 4 Yogyakarta.

        </p>

    </div>

</section>



{{-- ========================================================= --}}
{{-- TEAM --}}
{{-- ========================================================= --}}

<section id="tim"
         class="py-20
                bg-[#f4f6f9]">


    <div class="max-w-6xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8">


        {{-- Section Heading --}}

        <div class="text-center
                    max-w-3xl
                    mx-auto
                    mb-14">

            <span class="text-[#eab308]
                         font-bold
                         text-sm
                         uppercase
                         tracking-widest">

                Our Team

            </span>


            <h2 class="text-3xl
                       sm:text-4xl
                       font-bold
                       text-[#142b52]
                       mt-2">

                Tim Developer SPACE-IN

            </h2>


            <div class="w-20
                        h-1
                        bg-[#eab308]
                        mx-auto
                        mt-4
                        rounded">
            </div>


            <p class="mt-5
                      text-[#666666]">

                Orang-orang yang berkontribusi dalam
                membangun dan mengembangkan
                SPACE-IN PATBHE.

            </p>

        </div>



        {{-- ================================================= --}}
        {{-- TEAM GRID 1 - 2 - 2 --}}
        {{-- ================================================= --}}

        <div class="grid
                    grid-cols-1
                    sm:grid-cols-2
                    gap-8">


            {{-- ================================================= --}}
            {{-- MEMBER 1 Titis Widowati, ST --}}
            {{-- ================================================= --}}

            <div class="profile-card
                        bg-white
                        rounded-2xl
                        border
                        border-gray-100
                        shadow-sm
                        overflow-hidden

                        sm:col-span-2
                        lg:w-[calc(50%-1rem)]
                        lg:mx-auto">


                {{-- FOTO FULL --}}

                <div class="relative
                            bg-[#142b52]
                            h-[380px]
                            sm:h-[430px]
                            overflow-hidden">


                    <img src="{{ asset('images/developer/Titis-Widowati-ST.jpg') }}"
                         alt="Foto Developer 1"
                         class="profile-image
                                w-full
                                h-full
                                object-cover"
                                style="object-position: center 20%;">


                    {{-- Icon --}}

                    <div class="absolute
                                bottom-4
                                right-4
                                bg-[#facc15]
                                text-[#142b52]
                                w-11
                                h-11
                                rounded-full
                                flex
                                items-center
                                justify-center
                                shadow-lg">

                        <i class="fa-solid fa-code"></i>

                    </div>

                </div>


                {{-- Content --}}

                <div class="p-7">

                    <p class="text-xs
                              text-[#eab308]
                              font-bold
                              uppercase
                              tracking-wider">

                        Lead Developer

                    </p>


                    <h3 class="text-2xl
                               font-bold
                               text-[#142b52]
                               mt-1">

                        Titis Widowati, ST

                    </h3>


                    <p class="text-sm
                              text-[#888888]
                              mt-1">

                        Guru Pamong

                    </p>


                    <p class="text-[#666666]
                              text-sm
                              leading-relaxed
                              mt-5">

                        Tuliskan deskripsi anggota developer
                        pertama di sini.

                    </p>


                    {{-- Skills --}}

                    <div class="flex
                                flex-wrap
                                gap-2
                                mt-5">

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Laravel

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Backend

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Database

                        </span>

                    </div>


                    {{-- Social Media --}}

                    <div class="flex
                                gap-3
                                mt-6
                                pt-5
                                border-t
                                border-gray-100">

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-github"></i>

                        </a>


                        <a href="https://www.instagram.com/thies_ties/"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-instagram"></i>

                        </a>


                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-linkedin-in"></i>

                        </a>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- MEMBER 2 Abrar Khalida --}}
            {{-- ================================================= --}}

            <div class="profile-card
                        bg-white
                        rounded-2xl
                        border
                        border-gray-100
                        shadow-sm
                        overflow-hidden">


                {{-- FOTO FULL --}}

                <div class="relative
                            bg-[#142b52]
                            h-[360px]
                            sm:h-[390px]
                            overflow-hidden">

                    <img src="{{ asset('images/developer/developer-3.jpeg') }}"
                         alt="Abrar Khalida"
                         class="profile-image
                                w-full
                                h-full
                                object-cover"
                                style="object-position: center 65%;">


                    <div class="absolute
                                bottom-4
                                right-4
                                bg-[#facc15]
                                text-[#142b52]
                                w-11
                                h-11
                                rounded-full
                                flex
                                items-center
                                justify-center
                                shadow-lg">

                        <i class="fa-solid fa-server"></i>

                    </div>

                </div>


                <div class="p-7">

                    <p class="text-xs
                              text-[#eab308]
                              font-bold
                              uppercase
                              tracking-wider">

                        PROJECT MANAGER

                    </p>


                    <h3 class="text-2xl
                               font-bold
                               text-[#142b52]
                               mt-1">

                        Abrar Khalida

                    </h3>


                    <p class="text-sm
                              text-[#888888]
                              mt-1">

                        Ketua Projek Kepemimpinan

                    </p>


                    <p class="text-[#666666]
                              text-sm
                              leading-relaxed
                              mt-5">

                        Tuliskan deskripsi anggota developer
                        kedua di sini.

                    </p>


                    <div class="flex
                                flex-wrap
                                gap-2
                                mt-5">

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Jaringan

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Analisi Sistem

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Desain Sistem

                        </span>

                    </div>


                    <div class="flex
                                gap-3
                                mt-6
                                pt-5
                                border-t
                                border-gray-100">

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-github"></i>

                        </a>

                        <a href="https://www.instagram.com/brarr_k/"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-instagram"></i>

                        </a>

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-linkedin-in"></i>

                        </a>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- MEMBER 3 Nur Isnanto Nugroho --}}
            {{-- ================================================= --}}

            <div class="profile-card
                        bg-white
                        rounded-2xl
                        border
                        border-gray-100
                        shadow-sm
                        overflow-hidden">


                {{-- FOTO FULL --}}

                <div class="relative
                            bg-[#142b52]
                            h-[360px]
                            sm:h-[390px]
                            overflow-hidden">

                    <img src="{{ asset('images/developer/developer-2.jpeg') }}"
                         alt="Nur Isnanto Nugroho"
                         class="profile-image
                                w-full
                                h-full
                                object-cover"
                                style="object-position: center 65%;">


                    <div class="absolute
                                bottom-4
                                right-4
                                bg-[#facc15]
                                text-[#142b52]
                                w-11
                                h-11
                                rounded-full
                                flex
                                items-center
                                justify-center
                                shadow-lg">

                        <i class="fa-solid fa-pen-ruler"></i>

                    </div>

                </div>


                <div class="p-7">

                    <p class="text-xs
                              text-[#eab308]
                              font-bold
                              uppercase
                              tracking-wider">

                        UI / UX Designer

                    </p>


                    <h3 class="text-2xl
                               font-bold
                               text-[#142b52]
                               mt-1">

                        Nur Isnanto Nugroho

                    </h3>


                    <p class="text-sm
                              text-[#888888]
                              mt-1">

                        Admin Sosmed dan PDD

                    </p>


                    <p class="text-[#666666]
                              text-sm
                              leading-relaxed
                              mt-5">

                        Tuliskan deskripsi anggota developer
                        ketiga di sini.

                    </p>


                    <div class="flex
                                flex-wrap
                                gap-2
                                mt-5">

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Desain UI

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            CorelDraw

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Figma

                        </span>

                    </div>


                    <div class="flex
                                gap-3
                                mt-6
                                pt-5
                                border-t
                                border-gray-100">

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-github"></i>

                        </a>

                        <a href="https://www.instagram.com/nurisnantonugroho/"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-instagram"></i>

                        </a>

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-linkedin-in"></i>

                        </a>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- MEMBER 4 Agasta Pratama Nugraha --}}
            {{-- ================================================= --}}

            <div class="profile-card
                        bg-white
                        rounded-2xl
                        border
                        border-gray-100
                        shadow-sm
                        overflow-hidden">


                {{-- FOTO FULL --}}

                <div class="relative
                            bg-[#142b52]
                            h-[360px]
                            sm:h-[390px]
                            overflow-hidden">

                    <img src="{{ asset('images/developer/developer-4.jpeg') }}"
                         alt="Agasta Pratama Nugraha"
                         class="profile-image
                                w-full
                                h-full
                                object-cover">


                    <div class="absolute
                                bottom-4
                                right-4
                                bg-[#facc15]
                                text-[#142b52]
                                w-11
                                h-11
                                rounded-full
                                flex
                                items-center
                                justify-center
                                shadow-lg">

                        <i class="fa-solid fa-palette"></i>

                    </div>

                </div>


                <div class="p-7">

                    <p class="text-xs
                              text-[#eab308]
                              font-bold
                              uppercase
                              tracking-wider">

                        Frontend Developer

                    </p>


                    <h3 class="text-2xl
                               font-bold
                               text-[#142b52]
                               mt-1">

                        Agasta Pratama Nugraha

                    </h3>


                    <p class="text-sm
                              text-[#888888]
                              mt-1">

                        Sarpras dan Humas

                    </p>


                    <p class="text-[#666666]
                              text-sm
                              leading-relaxed
                              mt-5">

                        Tuliskan deskripsi anggota developer
                        keempat di sini.

                    </p>


                    <div class="flex
                                flex-wrap
                                gap-2
                                mt-5">

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            HTML

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            CSS

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            JavaScript

                        </span>

                    </div>


                    <div class="flex
                                gap-3
                                mt-6
                                pt-5
                                border-t
                                border-gray-100">

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-github"></i>

                        </a>

                        <a href="https://www.instagram.com/gas_taa/"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-instagram"></i>

                        </a>

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-linkedin-in"></i>

                        </a>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- MEMBER 5 Ilyas Fandhi Anggara --}}
            {{-- ================================================= --}}

            <div class="profile-card
                        bg-white
                        rounded-2xl
                        border
                        border-gray-100
                        shadow-sm
                        overflow-hidden">


                {{-- FOTO FULL --}}

                <div class="relative
                            bg-[#142b52]
                            h-[360px]
                            sm:h-[390px]
                            overflow-hidden">

                    <img src="{{ asset('images/developer/developer-1.jpeg') }}"
                         alt="Ilyas Fandhi Anggara"
                         class="profile-image
                                w-full
                                h-full
                                object-cover"
                                style="object-position: center 70%;">


                    <div class="absolute
                                bottom-4
                                right-4
                                bg-[#facc15]
                                text-[#142b52]
                                w-11
                                h-11
                                rounded-full
                                flex
                                items-center
                                justify-center
                                shadow-lg">

                        <i class="fa-solid fa-database"></i>

                    </div>

                </div>


                <div class="p-7">

                    <p class="text-xs
                              text-[#eab308]
                              font-bold
                              uppercase
                              tracking-wider">

                        Full Stack Developer

                    </p>


                    <h3 class="text-2xl
                               font-bold
                               text-[#142b52]
                               mt-1">

                        Ilyas Fandhi Anggara

                    </h3>


                    <p class="text-sm
                              text-[#888888]
                              mt-1">

                        Sekertaris dan Bendahara

                    </p>


                    <p class="text-[#666666]
                              text-sm
                              leading-relaxed
                              mt-5">

                        Tuliskan deskripsi anggota developer
                        kelima di sini.

                    </p>


                    <div class="flex
                                flex-wrap
                                gap-2
                                mt-5">

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            MySQL

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Database

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            SQL

                        </span>

                        <span class="bg-[#f4f6f9]
                                     text-[#142b52]
                                     text-xs
                                     font-semibold
                                     px-3
                                     py-1.5
                                     rounded-full">

                            Laravel

                        </span>

                    </div>


                    <div class="flex
                                gap-3
                                mt-6
                                pt-5
                                border-t
                                border-gray-100">

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-github"></i>

                        </a>

                        <a href="https://www.instagram.com/fandhidk17/"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-instagram"></i>

                        </a>

                        <a href="#"
                           class="w-9 h-9
                                  rounded-lg
                                  bg-[#f4f6f9]
                                  flex
                                  items-center
                                  justify-center
                                  text-[#142b52]
                                  hover:bg-[#142b52]
                                  hover:text-[#facc15]
                                  transition">

                            <i class="fa-brands fa-linkedin-in"></i>

                        </a>

                    </div>

                </div>

            </div>


        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- TECHNOLOGY --}}
{{-- ========================================================= --}}

<section id="teknologi"
         class="py-20 bg-white">


    <div class="max-w-6xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8">


        <div class="text-center
                    max-w-3xl
                    mx-auto
                    mb-12">

            <span class="text-[#eab308]
                         font-bold
                         text-sm
                         uppercase
                         tracking-widest">

                Technology Stack

            </span>


            <h2 class="text-3xl
                       sm:text-4xl
                       font-bold
                       text-[#142b52]
                       mt-2">

                Teknologi yang Digunakan

            </h2>


            <div class="w-20
                        h-1
                        bg-[#eab308]
                        mx-auto
                        mt-4
                        rounded">
            </div>

        </div>



        <div class="grid
                    grid-cols-2
                    md:grid-cols-4
                    gap-6">


            {{-- Laravel --}}

            <div class="bg-[#f8fafc]
                        border
                        border-gray-100
                        rounded-2xl
                        p-6
                        text-center
                        hover:shadow-lg
                        transition">

                <i class="fa-brands
                          fa-laravel
                          text-4xl
                          text-[#142b52]">
                </i>

                <h3 class="font-bold
                           text-[#142b52]
                           mt-4">

                    Laravel

                </h3>

                <p class="text-xs
                          text-[#777777]
                          mt-1">

                    Backend Framework

                </p>

            </div>



            {{-- PHP --}}

            <div class="bg-[#f8fafc]
                        border
                        border-gray-100
                        rounded-2xl
                        p-6
                        text-center
                        hover:shadow-lg
                        transition">

                <i class="fa-brands
                          fa-php
                          text-4xl
                          text-[#142b52]">
                </i>

                <h3 class="font-bold
                           text-[#142b52]
                           mt-4">

                    PHP

                </h3>

                <p class="text-xs
                          text-[#777777]
                          mt-1">

                    Programming Language

                </p>

            </div>



            {{-- Tailwind --}}

            <div class="bg-[#f8fafc]
                        border
                        border-gray-100
                        rounded-2xl
                        p-6
                        text-center
                        hover:shadow-lg
                        transition">

                <i class="fa-solid
                          fa-wind
                          text-4xl
                          text-[#142b52]">
                </i>

                <h3 class="font-bold
                           text-[#142b52]
                           mt-4">

                    Tailwind CSS

                </h3>

                <p class="text-xs
                          text-[#777777]
                          mt-1">

                    UI Framework

                </p>

            </div>



            {{-- MySQL --}}

            <div class="bg-[#f8fafc]
                        border
                        border-gray-100
                        rounded-2xl
                        p-6
                        text-center
                        hover:shadow-lg
                        transition">

                <i class="fa-solid
                          fa-database
                          text-4xl
                          text-[#142b52]">
                </i>

                <h3 class="font-bold
                           text-[#142b52]
                           mt-4">

                    MySQL

                </h3>

                <p class="text-xs
                          text-[#777777]
                          mt-1">

                    Database

                </p>

            </div>


            {{-- GitHub --}}

            <div class="bg-[#f8fafc]
                        border
                        border-gray-100
                        rounded-2xl
                        p-6
                        text-center
                        hover:shadow-lg
                        transition">

                <i class="fa-brands
                          fa-github
                          text-4xl
                          text-[#142b52]">
                </i>

                <h3 class="font-bold
                           text-[#142b52]
                           mt-4">

                    Git

                </h3>

                <p class="text-xs
                          text-[#777777]
                          mt-1">

                    Version Control

                </p>

            </div>

            {{-- Filament --}}
        <div class="bg-[#f8fafc]
                    border
                    border-gray-100
                    rounded-2xl
                    p-6
                    text-center
                    hover:shadow-lg
                    transition">

            <i class="fa-solid
                      fa-layer-group
                      text-4xl
                      text-[#142b52]">
            </i>

            <h3 class="font-bold
                       text-[#142b52]
                       mt-4">

                Filament

            </h3>

            <p class="text-xs
                      text-[#777777]
                      mt-1">

                Admin Panel

            </p>

        </div>

        {{-- Vercel --}}
        <div class="bg-[#f8fafc]
                    border
                    border-gray-100
                    rounded-2xl
                    p-6
                    text-center
                    hover:shadow-lg
                    transition">

            <i class="fa-solid
                      fa-cloud-arrow-up
                      text-4xl
                      text-[#142b52]">
            </i>

            <h3 class="font-bold
                       text-[#142b52]
                       mt-4">

                Vercel

            </h3>

            <p class="text-xs
                      text-[#777777]
                      mt-1">

                Deployment Platform

            </p>

        </div>

        {{-- Livewire --}}
        <div class="bg-[#f8fafc]
                    border
                    border-gray-100
                    rounded-2xl
                    p-6
                    text-center
                    hover:shadow-lg
                    transition">

            <i class="fa-solid
                      fa-bolt
                      text-4xl
                      text-[#142b52]">
            </i>

            <h3 class="font-bold
                       text-[#142b52]
                       mt-4">

                Livewire

            </h3>

            <p class="text-xs
                      text-[#777777]
                      mt-1">

                Full-Stack Framework

            </p>

        </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer id="kontak"
        class="bg-[#0f2342]
               text-gray-300
               pt-14
               pb-8">


    <div class="max-w-7xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8">


        <div class="grid
                    md:grid-cols-2
                    lg:grid-cols-3
                    gap-10">


            {{-- About --}}

            <div>

                <div class="flex
                            items-center
                            space-x-3
                            mb-4">

                    <img src="{{ asset('images/logo-web.png') }}"
                         alt="Logo"
                         class="w-12 h-12">

                    <div>

                        <h3 class="font-bold
                                   text-white">

                            SPACE-IN PATBHE

                        </h3>

                        <p class="text-xs
                                  text-gray-400">

                            SMAN 4 Yogyakarta

                        </p>

                    </div>

                </div>


                <p class="text-sm
                          leading-relaxed
                          text-gray-400">

                    Sistem digital untuk mempermudah
                    pengelolaan peminjaman ruangan dan
                    barang di SMAN 4 Yogyakarta.

                </p>

            </div>



            {{-- Contact --}}

            <div>

                <h4 class="font-semibold
                           text-white
                           mb-4">

                    Kontak

                </h4>


                <ul class="space-y-3
                           text-sm">

                    <li>

                        <i class="fa-solid
                                  fa-location-dot
                                  text-[#facc15]
                                  mr-2">
                        </i>

                        SMAN 4 Yogyakarta

                    </li>


                    <li>

                        <i class="fa-solid
                                  fa-phone
                                  text-[#facc15]
                                  mr-2">
                        </i>

                        (0274) 513245

                    </li>

                </ul>

            </div>



            {{-- Quick Links --}}

            <div>

                <h4 class="font-semibold
                           text-white
                           mb-4">

                    Tautan Cepat

                </h4>


                <div class="grid
                            grid-cols-2
                            gap-3
                            text-sm">

                    <a href="{{ url('/') }}"
                       class="hover:text-[#facc15]
                              transition">

                        Beranda

                    </a>


                    <a href="#tim"
                       class="hover:text-[#facc15]
                              transition">

                        Tim Developer

                    </a>


                    <a href="#teknologi"
                       class="hover:text-[#facc15]
                              transition">

                        Teknologi

                    </a>


                    <a href="#kontak"
                       class="hover:text-[#facc15]
                              transition">

                        Kontak

                    </a>

                </div>

            </div>

        </div>



        {{-- Copyright --}}

        <div class="mt-10
                    pt-6
                    border-t
                    border-[#142b52]
                    text-center">

            <p class="text-xs
                      text-[#9ca3af]">

                © {{ date('Y') }}
                Tim Developer SPACE-IN PATBHE.
                SMAN 4 Yogyakarta.

            </p>

        </div>

    </div>

</footer>


</body>

</html>