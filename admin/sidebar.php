<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bintang Jaya Sofa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            background-color: #f0f0f0;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .navbar .logo h2 {
            font-size: 1.5rem;
            color: #333;
        }

        .navbar a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #007bff;
        }

        /* Navbar Links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links a {
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: 500;
        }

        .nav-links a.active {
            color: blue;
            font-weight: bold;
        }

        .nav-links a:hover {
            background-color: #e0e0e0;
        }

        /* Mobile Menu */
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 8px;
            color: #333;
            transition: color 0.3s ease;
        }

        .menu-toggle:hover {
            color: #007bff;
        }

        /* Responsive Navbar */
        @media (max-width: 768px) {
            .navbar {
                padding: 10px 15px;
            }

            .navbar .logo h2 {
                font-size: 1.2rem;
            }

            .menu-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                background-color: #f0f0f0;
                position: absolute;
                top: 70px;
                left: 0;
                padding: 10px 0;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                opacity: 0;
                transform: translateY(-10px);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            .nav-links.active {
                display: flex;
                opacity: 1;
                transform: translateY(0);
            }

            .nav-links a {
                width: 100%;
                text-align: center;
                padding: 12px;
                border-radius: 0;
            }

            .nav-links a:hover {
                background-color: #e0e0e0;
            }
        }

        @media (max-width: 480px) {
            .navbar .logo img {
                width: 40px;
                height: 40px;
            }

            .navbar .logo h2 {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="../asset/bjs.png" alt="Logo">
            <h2>Admin Bintang Jaya Sofa</h2>
        </div>
        <button class="menu-toggle" id="menu-toggle" aria-label="Toggle navigation menu">
            &#9776;
        </button>
        <div class="nav-links" id="nav-links">
            <a href="admin.php" class="active">Dashboard</a>
            <a href="barang.php">Barang</a>
            <a href="pembelian.php">Pembelian</a>
            <a href="histori.php">Histori</a>
            <a href="user.php">User</a>
            <a href="profile.php">Profil</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuToggle = document.getElementById("menu-toggle");
            const navLinks = document.getElementById("nav-links");

            // Toggle menu
            menuToggle.addEventListener("click", function () {
                navLinks.classList.toggle("active");
                const isExpanded = navLinks.classList.contains("active");
                menuToggle.setAttribute("aria-expanded", isExpanded);
            });

            // Close menu when clicking outside
            document.addEventListener("click", function (event) {
                if (!event.target.closest(".navbar")) {
                    navLinks.classList.remove("active");
                    menuToggle.setAttribute("aria-expanded", "false");
                }
            });

            // Close menu when clicking links
            const navLinksItems = document.querySelectorAll(".nav-links a");
            navLinksItems.forEach((item) => {
                item.addEventListener("click", () => {
                    navLinks.classList.remove("active");
                    menuToggle.setAttribute("aria-expanded", "false");
                });
            });

            // Close menu on window resize
            window.addEventListener("resize", function () {
                if (window.innerWidth > 768 && navLinks.classList.contains("active")) {
                    navLinks.classList.remove("active");
                    menuToggle.setAttribute("aria-expanded", "false");
                }
            });
        });
    </script>
</body>

</html>