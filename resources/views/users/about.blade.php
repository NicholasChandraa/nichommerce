@extends('article-layouts.articlePage')

@section('title', 'About | N-MERCE')

@section('content')
    <style>
        .active-tab {
            background-color: rgb(139 92 246);
            color: white;
        }

        .hidden-content {
            display: none;
        }

        .project-title {
            color: #ff6f61;
        }
    </style>

    <body class="bg-white">
        <!-- Hero Section -->
        <section class="text-center py-16 bg-white">
            <div class="container mx-auto px-4">
                <h1 class="text-2xl text-gray-900 md:text-4xl lg:text-6xl font-bold">
                    Tentang N-MERCE: Platform Terpercaya dengan Produk Berkualitas Tinggi dan Layanan Terbaik
                </h1>
                <div class="mt-10 relative">
                    <img src="{{ url('images/background4.jpg') }}" alt="Office" class="mx-auto rounded-lg shadow-lg w-full h-full" />
                </div>
            </div>
        </section>

        <!-- Information Section -->
        <section class="bg-purple-600 text-white md:-mt-56 lg:-mt-96 md:pt-56 lg:pt-96 pt-16 pb-16">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
                    Digital Products You Can Trust
                </h2>
                <p class="text-lg lg:text-xl mb-8">
                    N-MERCE didirikan pada bulan Juni 2024 oleh Nicholas Chandra, sebuah perusahaan yang berbasis di Banten, Kota Tangerang. Kami berkomitmen untuk menyediakan produk-produk digital berkualitas tinggi yang memenuhi standar kepercayaan dan performa. Kami percaya bahwa setiap produk digital yang kami jual bukan hanya sekadar barang elektronik, tetapi juga solusi untuk memenuhi kebutuhan sehari-hari Anda. Oleh karena itu, kami terus berinovasi dalam menyediakan produk, teknologi, dan layanan terbaik untuk memenuhi kebutuhan dan preferensi pelanggan kami.
                </p>

                <!-- Features Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white text-purple-600 p-6 rounded-lg shadow-lg">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                01
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">
                            Kepercayaan dan Transparansi
                        </h3>
                        <p>
                            Kami berkomitmen untuk memberikan layanan yang jujur dan transparan, memastikan setiap pelanggan merasa aman dan nyaman saat berbelanja di N-MERCE.
                        </p>
                    </div>
                    <div class="bg-white text-purple-600 p-6 rounded-lg shadow-lg">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                02
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">
                            Kualitas Produk Terbaik
                        </h3>
                        <p>
                            Kami menyediakan produk-produk digital dari merek-merek ternama yang sudah teruji kualitasnya, memastikan Anda mendapatkan barang terbaik sesuai kebutuhan.
                        </p>
                    </div>
                    <div class="bg-white text-purple-600 p-6 rounded-lg shadow-lg">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                03
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">
                            Performa dan Inovasi
                        </h3>
                        <p>
                            Kami terus berinovasi dalam menyediakan fitur-fitur unggulan dan teknologi terbaru untuk memastikan performa yang optimal dari setiap produk yang kami jual.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Visi dan Misi Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <div class="image-overlay rounded-lg shadow-lg">
                        <img src="{{ url('images/background5.webp') }}" alt="Interior Design"
                            class="rounded-lg w-full h-auto" />
                    </div>
                </div>
                <div class="lg:w-1/2 lg:pl-16 text-center lg:text-left">
                    <div class="flex justify-center lg:justify-start mb-4 space-x-4">
                        <button id="missionBtn"
                            class="visi-misi-btn px-4 py-2 rounded border active-tab hover:bg-purple-500 hover:text-white"
                            onclick="showContent('mission')">
                            Our Mission
                        </button>
                        <button id="visionBtn"
                            class="visi-misi-btn px-4 py-2 rounded border hover:bg-purple-500 hover:text-white"
                            onclick="showContent('vision')">
                            Our Vision
                        </button>
                        <button id="goalBtn"
                            class="visi-misi-btn px-4 py-2 rounded border hover:bg-purple-500 hover:text-white"
                            onclick="showContent('goal')">
                            Our Goal
                        </button>
                    </div>
                    <div id="missionContent" class="content">
                        <h2 class="text-2xl font-bold mb-4">Misi NJS Helmet</h2>
                        <p class="text-lg mb-4 text-justify indent-8">
                            Misi kami adalah untuk menciptakan pengalaman belanja online yang aman dan menyenangkan bagi setiap pelanggan. Kami berupaya menyediakan produk-produk digital terbaik dengan harga yang kompetitif dan memastikan setiap produk memenuhi standar kualitas yang tinggi. Kami juga berkomitmen untuk memberikan layanan pelanggan yang responsif dan profesional, selalu siap membantu dan menjawab kebutuhan pelanggan dengan cepat dan tepat.
                        </p>
                        <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded"
                            onclick="toggleMoreContent('missionMoreContent')">
                            Read More
                        </button>
                        <div id="missionMoreContent" class="hidden-content mt-4 text-justify indent-8">
                            <p class="text-lg mb-4">
                                Kami juga berkomitmen untuk memberdayakan karyawan kami dengan memberikan pelatihan dan peluang pengembangan karir, sehingga mereka dapat memberikan layanan terbaik kepada pelanggan. Selain itu, kami berusaha untuk menjalankan operasional yang ramah lingkungan dan berkelanjutan, dengan meminimalkan dampak negatif terhadap lingkungan melalui berbagai inisiatif hijau. Kami percaya bahwa keberlanjutan adalah kunci untuk pertumbuhan jangka panjang, dan oleh karena itu, kami selalu mencari cara untuk mengurangi jejak karbon kami dan menggunakan sumber daya secara efisien.
                            </p>
                            <p class="text-lg mb-4">
                                Di N-MERCE, kami memahami pentingnya memberikan nilai tambah kepada pelanggan kami. Oleh karena itu, kami berkomitmen untuk menyediakan berbagai fitur dan layanan tambahan, seperti dukungan teknis 24/7, kebijakan pengembalian yang fleksibel, dan program loyalitas yang menguntungkan. Kami juga berusaha untuk menjaga komunikasi yang terbuka dan transparan dengan pelanggan kami, mendengarkan masukan mereka, dan terus berusaha meningkatkan pengalaman belanja mereka.
                            </p>
                        </div>
                    </div>
                    <div id="visionContent" class="content hidden">
                        <h2 class="text-2xl font-bold mb-4">Visi NJS Helmet</h2>
                        <p class="text-lg mb-4 text-justify indent-8">
                            Visi kami adalah menjadi platform e-commerce terdepan di Indonesia yang menyediakan produk digital berkualitas tinggi dengan layanan yang nyaman dan mudah digunakan oleh semua pelanggan. Kami bercita-cita untuk menjadi pilihan utama masyarakat dalam berbelanja produk digital dengan menghadirkan pengalaman belanja yang aman, cepat, dan memuaskan.
                        </p>
                        <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded"
                            onclick="toggleMoreContent('visionMoreContent')">
                            Read More
                        </button>
                        <div id="visionMoreContent" class="hidden-content mt-4">
                            <p class="text-lg mb-4 text-justify indent-8">
                                Kami berusaha untuk menjadi inovator dalam industri ini, dengan selalu mengadopsi teknologi terbaru dan menerapkan praktik terbaik dalam operasional kami. Melalui pendekatan yang proaktif dan adaptif, kami ingin memastikan bahwa N-MERCE selalu relevan dan mampu memenuhi kebutuhan serta ekspektasi pelanggan di tengah dinamika pasar yang terus berubah. Kami percaya bahwa dengan menjaga kualitas, kepercayaan, dan inovasi sebagai landasan utama, kami dapat membangun hubungan jangka panjang yang saling menguntungkan dengan semua pemangku kepentingan.
                            </p>
                        </div>
                    </div>
                    <div id="goalContent" class="content hidden">
                        <h2 class="text-2xl font-bold mb-4">
                            Tujuan NJS Helmet
                        </h2>
                        <p class="text-lg mb-4 text-justify indent-8">
                            Tujuan utama kami adalah membangun dan mempertahankan kepercayaan pelanggan melalui layanan yang transparan dan konsisten. Kami percaya bahwa kepercayaan adalah fondasi utama dalam hubungan jangka panjang dengan pelanggan. Oleh karena itu, kami selalu berusaha menjaga integritas dan keterbukaan dalam setiap transaksi. Kami juga berkomitmen untuk meningkatkan kepuasan pelanggan dengan menyediakan produk berkualitas dan layanan yang cepat serta efisien. Kepuasan pelanggan adalah prioritas utama kami, dan kami selalu berusaha untuk melebihi harapan pelanggan dalam setiap aspek layanan kami. 
                        </p>
                        <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded"
                            onclick="toggleMoreContent('goalMoreContent')">
                            Read More
                        </button>
                        <div id="goalMoreContent" class="hidden-content mt-4">
                            <p class="text-lg mb-4 text-justify indent-8">
                                kami memiliki tujuan untuk mengembangkan jangkauan pasar dan meningkatkan penjualan melalui strategi pemasaran yang efektif dan inovatif. Dengan mengoptimalkan potensi pasar dan terus memperluas jaringan distribusi, kami berharap dapat membawa N-MERCE menjadi pemimpin pasar dalam industri e-commerce produk digital di Indonesia. Kami juga bertujuan untuk terus meningkatkan keahlian dan keterampilan tim kami melalui pelatihan berkelanjutan dan pengembangan karir, sehingga mereka dapat memberikan kontribusi maksimal terhadap kesuksesan perusahaan.
                            </p>
                            <p class="text-lg mb-4 text-justify indent-8">
                                Kami juga berkomitmen untuk meningkatkan efisiensi operasional kami dengan mengadopsi teknologi terbaru dan praktik terbaik di industri. Kami akan terus mengevaluasi dan meningkatkan proses internal kami untuk memastikan bahwa kami dapat memberikan layanan yang cepat, akurat, dan handal kepada pelanggan kami. Selain itu, kami bertujuan untuk membangun kemitraan strategis dengan pemasok dan produsen terkemuka untuk memastikan bahwa kami selalu memiliki akses ke produk-produk terbaru dan terbaik di pasar.
                            </p>
                            <p class="text-lg mb-4 text-justify indent-8">
                                kami berkomitmen untuk berperan aktif dalam komunitas dengan menjalankan program tanggung jawab sosial perusahaan yang berdampak positif bagi masyarakat sekitar. Kami percaya bahwa memberikan kembali kepada komunitas adalah bagian penting dari tanggung jawab kami sebagai perusahaan, dan kami berusaha untuk menciptakan perubahan positif melalui berbagai inisiatif sosial dan lingkungan. Kami juga memiliki tujuan untuk memperluas portofolio produk kami, menambahkan lebih banyak kategori produk digital untuk memenuhi kebutuhan pelanggan yang beragam. Kami akan terus mencari peluang untuk berinovasi dan meningkatkan penawaran produk kami, memastikan bahwa kami selalu memberikan nilai terbaik bagi pelanggan kami.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Project Collaboration Section -->
        <section class="py-16 bg-[#1a1a2e]">
            <div class="container mx-auto">
                <h2 class="text-start text-lg text-gray-300 uppercase tracking-wide mb-8 px-6">Our Project
                    Collaboration
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Barong Project -->
                    <div class="project-card text-white p-6">
                        <h3 class="text-2xl font-bold mb-4">N-MERCE Tech Fest 2024 - Innovate, Connect, and Discover <span
                                class="project-title">—</span></h3>
                        <p class="mb-4">N-MERCE Tech Fest 2024 adalah acara tahunan yang mengumpulkan para inovator, pengembang, dan penggemar teknologi dari seluruh Indonesia. Acara ini menawarkan berbagai sesi keynote...</p>
                        <a href="/articlePages/6"
                            class="view-project-button border inline-block text-white px-4 py-2 rounded mt-4 hover:bg-white hover:text-black">View
                            Article Collaboration</a>
                        <a href="/articlePages/6">
                            <img src="{{ url('images/collaboration.jpg') }}" alt="Barong Project" class="mt-4 rounded-lg">
                        </a>
                    </div>
                    <!-- Garuda Project -->
                    <div class="project-card text-white p-6">
                        <h3 class="text-2xl font-bold mb-4">N-MERCE Digital Transforming the Digital Landscape <span
                                class="project-title">—</span></h3>
                        <p class="mb-4">N-MERCE Digital Innovation Summit adalah platform bagi para profesional dan pemimpin industri untuk berbagi wawasan tentang tren dan inovasi terkini di dunia digital. Acara ini mencakup...</p>
                        <a href="/articlePages/7"
                            class="view-project-button border hover:bg-white hover:text-black inline-block text-white px-4 py-2 rounded mt-4">View
                            Article Collaboration</a>
                        <a href="/articlePages/7">
                            <img src="{{ url('images/collaboration2.jpg') }}" alt="Garuda Project" class="mt-4 rounded-lg">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Us Section -->
        <section class="py-16 bg-[#e7f0ff]">
            <div class="container mx-auto px-4 lg:flex lg:space-x-16 lg:justify-between lg:items-center">
                <!-- Contact Information -->
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <h2 class="text-4xl font-bold mb-4">Hubungi Kami</h2>
                    <p class="mb-4">Punya pertanyaan, saran, atau ingin mengetahui lebih lanjut tentang N-MERCE? Jangan ragu untuk menghubungi kami! Kami siap membantu Anda dengan senang hati.</p>
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <div>
                            <h3 class="font-bold mb-2">Kantor Pusat & Distribusi:</h3>
                            <p>N-MERCE<br>Jl. Wijaya Kusuma<br>Cipondoh, Kota Tangerang 15136<br>Banten,
                                Indonesia</p>
                        </div>
                        <div class="lg:pl-8 lg:pr-8">
                            <h3 class="font-bold mb-2 mt-4 lg:mt-0">Jam Operasional:</h3>
                            <p>Senin - Jumat: <br>08.00 - 17.00 WIB</p>
                        </div>
                        <div>
                            <h3 class="font-bold mb-2 mt-4 lg:mt-0">Customer Service:</h3>
                            <p>085156495716<br>nicholaschandraa01@gmail.com</p>
                        </div>
                    </div>

                    <h3 class="font-bold mb-2 mt-4">Media Sosial:</h3>
                    <p>Tetap terhubung dengan kami dan dapatkan informasi terbaru mengenai produk, promo, dan acara menarik
                        lainnya:</p>
                    <br>
                    <ul>
                        <li>Facebook: N-MERCE</li>
                        <li>Instagram: @nichochandr</li>
                        <li>YouTube: N-MERCE Official</li>
                    </ul>
                </div>
                {{-- Contact Form --}}
                <div class="lg:w-1/3 bg-white px-8 py-10 rounded-[30px] shadow-lg">
                    <h3 class="text-2xl lg:text-3xl font-semibold mb-4 lg:mb-12">Let's Collaborate or Contact Us</h3>
                    <p class="mb-4 text-lg">You can reach us anytime</p>
                    <form id="contact-form">
                        <div class="flex space-x-4 mb-4">
                            <input type="text" name="user_name" placeholder="First name"
                                class="w-1/2 p-3 border rounded-lg" required>
                            <input type="text" name="user_lastname" placeholder="Last name"
                                class="w-1/2 p-3 border rounded-lg">
                        </div>
                        <div class="mb-4">
                            <input type="email" name="user_email" placeholder="Your email"
                                class="w-full p-3 border rounded-lg" required>
                        </div>
                        <div class="mb-4 lg:mb-12">
                            <textarea name="message" placeholder="Apa yang bisa kami bantu?" class="w-full p-3 border rounded-lg" rows="4"
                                required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg">Submit</button>
                    </form>
                </div>
            </div>
        </section>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
        <script type="text/javascript">
            (function() {
                emailjs.init("tS28mCvRl8eexc5K-");
            })();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function showContent(contentId) {
                // menyembunyikan semua content class
                document
                    .querySelectorAll('.content')
                    .forEach((content) => content.classList.add('hidden'));

                // Remove active-tab class dari semua tombol di visi misi section
                document
                    .querySelectorAll('.visi-misi-btn')
                    .forEach((button) => button.classList.remove('active-tab'));

                // Show selected content dan add active-tab class
                document
                    .getElementById(contentId + 'Content')
                    .classList.remove('hidden');
                document
                    .getElementById(contentId + 'Btn')
                    .classList.add('active-tab');
            }

            function toggleMoreContent(contentId) {
                // Toggle hidden content
                const content = document.getElementById(contentId);
                if (content.style.display === 'block') {
                    content.style.display = 'none';
                } else {
                    content.style.display = 'block';
                }
            }


            document.getElementById('contact-form').addEventListener('submit', function(event) {
                event.preventDefault();

                emailjs.sendForm('service_oxqhxgr', 'template_qt1o08k', this)
                    .then(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pesan Berhasil Dikirim!',
                            text: 'Terima kasih telah menghubungi kami. Kami akan segera membalas pesan Anda.',
                            confirmButtonText: 'OK'
                        });
                        document.getElementById('contact-form').reset();
                    }, function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mengirim Pesan!',
                            text: 'Terjadi kesalahan. Silakan coba lagi nanti.',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        </script>
    </body>
@endsection
