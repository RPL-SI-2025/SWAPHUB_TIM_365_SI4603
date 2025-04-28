<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwapHub - Swap, Use, Save, Sustain!</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F5F7FA;
        }

        .landing-page {
            width: 100%;
            background: #FFFFFF;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
            background: #FFFFFF;
            border-bottom: 1px solid #E0E0E0;
            height: 80px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .logo img {
            width: 80px;
            height: 80px;
        }

        .logo-text {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 24px;
            color: #2194F3;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .menu {
            display: flex;
            gap: 80px;
        }

        .menu a {
            font-family: 'Inter';
            font-weight: 500;
            font-size: 16px;
            color: #263238;
            text-decoration: none;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transition: color 0.3s, font-weight 0.3s;
        }

        .menu a.active {
            color: #2194F3;
            font-weight: 700;
            border-bottom: 2px solid #2194F3;
        }

        .hero-section {
            display: flex;
            align-items: center;
            padding: 60, sans-serif;
            background: #F5F7FA;
            gap: 40px;
            position: relative;
        }

        .hero-text {
            width: 50%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .hero-text h1 {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 48px;
            line-height: 56px;
            color: #003459;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .text-swap, .text-reuse, .text-signup, .text-enjoy, .text-collection, .text-swaphub, .text-features, .text-said {
            color: #2196F3;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-text p {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #263238;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 24px;
            background: #2194F3;
            border-radius: 5px;
            font-family: 'Inter';
            font-weight: 600;
            font-size: 16px;
            color: #FFFFFF;
            text-decoration: none;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-illustration {
            width: 50%;
            position: relative;
        }

        .hero-illustration img {
            width: 100%;
            height: auto;
        }

        .community-section {
            padding: 60px 100px;
            background: #FFFFFF;
            text-align: center;
        }

        .section-title {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 32px;
            color: #003459;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .auth-section {
            display: flex;
            justify-content: space-between;
            gap: 40px;
        }

        .signup-form, .login-form {
            flex: 1;
            background: #F5F7FA;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .signup-form h3, .login-form h3 {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 24px;
            color: #263238;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #CFCFCF;
            border-radius: 5px;
            font-family: 'Inter';
            font-size: 14px;
            color: #263238;
        }

        .form-input::placeholder {
            color: #717171;
            opacity: 0.7;
        }

        .form-button {
            width: 100%;
            padding: 12px;
            background: #2194F3;
            border: none;
            border-radius: 5px;
            font-family: 'Inter';
            font-weight: 600;
            font-size: 16px;
            color: #FFFFFF;
            cursor: pointer;
        }

        .form-error {
            color: #DC2626;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }

        .form-success {
            color: #16A34A;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }

        .collection-section {
            padding: 60px 100px;
            background: #F5F7FA;
            text-align: center;
        }

        .collection-items {
            display: flex;
            gap: 80px;
            overflow-x: auto;
            padding-bottom: 20px;
        }

        .item-card {
            position: relative;
            flex: 0 0 auto;
        }

        .item-card img {
            width: 200px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
        }

        .status-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #4CAF4F;
            color: #FFFFFF;
            padding: 5px 10px;
            border-radius: 5px;
            font-family: 'Inter';
            font-weight: 600;
            font-size: 12px;
        }

        .what-is-section {
            display: flex;
            align-items: center;
            padding: 60px 100px;
            background: #FFFFFF;
            gap: 40px;
        }

        .what-is-image {
            width: 40%;
        }

        .what-is-image img {
            width: 100%;
            height: auto;
        }

        .what-is-text {
            width: 60%;
        }

        .what-is-text h2 {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 32px;
            color: #003459;
            margin-bottom: 20px;
        }

        .what-is-text p {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #263238;
        }

        .features-section {
            display: flex;
            align-items: center;
            padding: 60px 100px;
            background: #F5F7FA;
            gap: 40px;
        }

        .features-image {
            width: 40%;
        }

        .features-image img {
            width: 100%;
            height: auto;
        }

        .features-text {
            width: 60%;
        }

        .features-text h2 {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 32px;
            color: #003459;
            margin-bottom: 20px;
        }

        .features-text ul {
            list-style: none;
            padding: 0;
        }

        .features-text ul li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Inter';
            font-weight: 400;
            font-size: 16px;
            color: #263238;
            margin-bottom: 10px;
        }

        .features-text ul li::before {
            content: '';
            width: 20px;
            height: 20px;
            background: #2194F3;
            border-radius: 50%;
        }

        .community-updates {
            padding: 60px 100px;
            background: #FFFFFF;
            text-align: center;
        }

        .testimonials {
            display: flex;
            gap: 20px;
        }

        .testimonial-card {
            flex: 1;
            background: #F5F7FA;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card img {
            width: 100%;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .testimonial-card p {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 14px;
            line-height: 20px;
            color: #717171;
            margin-bottom: 10px;
        }

        .testimonial-card .author {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 14px;
            color: #2194F3;
        }

        .feedback-section {
            padding: 60px 100px;
            background: #F5F7FA;
            text-align: center;
        }

        .stars {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            flex-direction: row-reverse;
        }

        .stars input {
            display: none;
        }

        .stars label {
            font-size: 60px;
            color: #CFCFCF;
            transition: color 0.3s;
        }

        .stars input:checked ~ label,
        .stars label:hover,
        .stars label:hover ~ label {
            color: #FFD700;
        }

        .feedback-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 50%;
            margin: 0 auto;
        }

        .feedback-form input, .feedback-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #CFCFCF;
            border-radius: 5px;
            font-family: 'Inter';
            font-size: 14px;
            color: #263238;
        }

        .feedback-form input::placeholder, .feedback-form textarea::placeholder {
            color: #717171;
            opacity: 0.7;
        }

        .feedback-form textarea {
            height: 150px;
            resize: none;
        }

        .footer {
            padding: 30px;
            background: #003459;
            text-align: center;
        }

        .footer p {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 24px;
            color: #FFFFFF;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="landing-page">
        <!-- Navbar -->
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="SwapHub Logo">
                <span class="logo-text">SWAPHUB</span>
            </div>
            <div class="menu">
                <a href="#home">Home</a>
                <a href="#whatis">Profile</a>
                <a href="#features">Features</a>
                <a href="#review">Review</a>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="hero-section" id="home">
            <div class="hero-text">
                <h1>The best way to <span class="text-swap">Swap</span> & <span class="text-reuse">Reuse</span> items with your friends!</h1>
                <p>SwapHub hadir sebagai solusi inovatif untuk memfasilitasi pertukaran barang antar mahasiswa dalam satu platform yang aman dan terpercaya.</p>
                <a href="#" class="hero-button">Learn More</a>
            </div>
            <div class="hero-illustration">
                <img src="{{ asset('images/grafiklanding1.png') }}" alt="Hero Illustration">
            </div>
        </div>

        <!-- Community Section (Sign Up & Log In) -->
        <div class="community-section" id="profile">
            <h2 class="section-title"><span class="text-signup">SIGN UP</span> & <span class="text-enjoy">ENJOY</span> YOUR SWAPHUB!</h2>
            <div class="auth-section">
                <!-- Sign Up Form -->
                <div class="signup-form">
                    <h3>Sign Up</h3>

                    @if (session('success'))
                        <div class="form-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="form-error">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('registration') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input type="text" name="firstName" placeholder="Your first name" class="form-input" value="{{ old('firstName') }}" required>
                            <input type="text" name="lastName" placeholder="Your last name" class="form-input" value="{{ old('lastName') }}" required>
                        </div>
                        <input type="email" name="email" placeholder="Your email address" class="form-input" value="{{ old('email') }}" required>
                        <input type="text" name="phone_users" placeholder="Your phone number" class="form-input" value="{{ old('phone_users') }}" required>
                        <input type="password" name="password" placeholder="Pick a password" class="form-input" required>
                        <input type="password" name="password_confirmation" placeholder="Confirm password" class="form-input" required>
                        <select name="role" class="form-input" required>
                            <option value="">Select Role</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <label class="block text-gray-700 mb-2 text-sm">Upload Profile Picture (optional)</label>
                        <input type="file" name="profile_picture" class="form-input bg-white file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                        <button type="submit" class="form-button">Sign Up</button>
                    </form>
                    <div class="text-center text-sm text-gray-600">
                        Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log In</a>
                    </div>
                </div>

                <!-- Log In Form -->
                <div class="login-form">
                    <h3>Log In</h3>
                    @if (session('loginError'))
                        <div class="form-error">
                            {{ session('loginError') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="Email address" class="form-input" required />
                        <input type="password" name="password" placeholder="Password" class="form-input" required />
                        <button type="submit" class="form-button">Log In</button>
                    </form>
                    <div class="text-center text-sm text-gray-600">
                        Don't have an account? <a href="{{ url('/registration') }}" class="text-blue-600 hover:underline">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Collection -->
        <div class="collection-section" id="collection">
            <h2 class="section-title">OUR <span class="text-collection">COLLECTION</span></h2>
            <div class="collection-items">
                <div class="item-card">
                    <img src="{{ asset('images/LABUBU.jpg') }}" alt="LABUBU">
                    <div class="status-tag">Tersedia</div>
                </div>
                <div class="item-card">
                    <img src="{{ asset('images/hp.jpg') }}" alt="HP">
                    <div class="status-tag">Tersedia</div>
                </div>
                <div class="item-card">
                    <img src="{{ asset('images/One Piece Figure.jpg') }}" alt="One Piece Figure">
                    <div class="status-tag">Tersedia</div>
                </div>
                <div class="item-card">
                    <img src="{{ asset('images/TAS.jpg') }}" alt="TAS">
                    <div class="status-tag">Tersedia</div>
                </div>
                <div class="item-card">
                    <img src="{{ asset('images/Yehlex.jpg') }}" alt="Yehlex">
                    <div class="item-card">
                    <img src="{{ asset('images/Yehlex.jpg') }}" alt="Yehlex">
                    <div class="status-tag">Tersedia</div>
                </div>
            </div>
        </div>

        <!-- What is SwapHub? -->
        <div class="what-is-section" id="whatis">
            <div class="what-is-image">
                <img src="{{ asset('images/WHATIS.jpg') }}" alt="What is SwapHub">
            </div>
            <div class="what-is-text">
                <h2>WHAT IS <span class="text-swaphub">SWAPHUB</span></h2>
                <p>SwapHub adalah platform web yang memudahkan mahasiswa bertukar barang secara efisien dan aman. Dengan fitur algoritma pencocokan, verifikasi akun, serta rating & ulasan transparan, SwapHub membangun kepercayaan dan mendorong praktik ekonomi timbal balik yang berkelanjutan. Platform ini berkontribusi pada SDG 12 (konsumsi dan produksi bertanggung jawab) dengan mengurangi limbah melalui penggunaan kembali barang, serta mendukung SDG 11 untuk membentuk komunitas yang lebih ramah lingkungan dan berkelanjutan.</p>
            </div>
        </div>

        <!-- Available Features -->
        <div class="features-section" id="features">
            <div class="features-image">
                <img src="{{ asset('images/FEATURES.jpg') }}" alt="Features">
            </div>
            <div class="features-text">
                <h2>AVAILABLE <span class="text-features">FEATURES</span></h2>
                <ul>
                    <li>Pertukaran Barang</li>
                    <li>Pencarian & Filter Barang</li>
                    <li>Rating and review sistem</li>
                    <li>Keamanan & Verifikasi Pengguna</li>
                    <li>Manajemen Transaksi & Riwayat</li>
                    <li>Feedback & Saran Pengguna</li>
                </ul>
            </div>
        </div>

        <!-- Community Updates -->
        <div class="community-updates" id="review">
            <h2 class="section-title">THEY <span class="text-said">SAID...</span></h2>
            <div class="testimonials">
                <div class="testimonial-card">
                    <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="Alya">
                    <p>"Fitur rating dan review bikin aku lebih percaya sama orang yang mau aku ajak barter. Jadi nggak takut kena tipu. Keren banget!"</p>
                    <div class="author">Alya - Mahasiswa DKV</div>
                </div>
                <div class="testimonial-card">
                    <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="Nadia">
                    <p>"SwapHub bikin proses barter lebih seru dan fleksibel. Bisa chat langsung sama pemilik barang, jadi lebih gampang negosiasi."</p>
                    <div class="author">Nadia - Mahasiswa Manajemen</div>
                </div>
                <div class="testimonial-card">
                    <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="Fajar">
                    <p>"Platformnya mudah digunakan dan sistem verifikasinya bikin aku lebih nyaman. Udah beberapa kali barter dan selalu lancar!"</p>
                    <div class="author">Fajar - Mahasiswa Hukum</div>
                </div>
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="feedback-section" id="feedback">
            <h2 class="section-title">Give Us Feedback for Improvement</h2>
            <div class="stars">
                <input type="radio" name="rating" id="star5" value="5" class="hidden">
                <label for="star5" class="cursor-pointer">★</label>
                <input type="radio" name="rating" id="star4" value="4" class="hidden">
                <label for="star4" class="cursor-pointer">★</label>
                <input type="radio" name="rating" id="star3" value="3" class="hidden">
                <label for="star3" class="cursor-pointer">★</label>
                <input type="radio" name="rating" id="star2" value="2" class="hidden">
                <label for="star2" class="cursor-pointer">★</label>
                <input type="radio" name="rating" id="star1" value="1" class="hidden">
                <label for="star1" class="cursor-pointer">★</label>
            </div>
            <div class="feedback-form">
                <input type="email" placeholder="Your Email Address">
                <textarea placeholder="Message"></textarea>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>"SwapHub - Swap, Use, Save, Sustain!"</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
    <script>
        // Smooth scrolling untuk semua tautan dengan href yang dimulai dengan '#'
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Deteksi section yang terlihat saat scroll
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('.hero-section, .community-section, .collection-section, .what-is-section, .features-section, .community-updates, .feedback-section');
            const navLinks = document.querySelectorAll('.menu a');
            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop - 60 && window.scrollY < sectionTop + sectionHeight - 60) {
                    currentSection = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${currentSection}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>