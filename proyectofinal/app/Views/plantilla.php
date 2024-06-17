<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="css/estilo.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            /* Fondo claro */
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #76c7c0;
            /* Verde azulado claro */
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: #000;
            /* Negro */
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 1rem;
        }

        .navbar ul li {
            position: relative;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #000;
            /* Negro */
            font-weight: 400;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar ul li a:hover {
            background-color: #f39c12;
            /* Color del botón de editar */
            color: #fff;
        }

        .navbar ul li a::after {
            content: '';
            display: block;
            height: 2px;
            width: 0;
            background: #e74c3c;
            /* Color del botón de eliminar */
            transition: width 0.3s;
        }

        .navbar ul li a:hover::after {
            width: 100%;
        }

        @media (max-width: 768px) {
            .navbar ul {
                flex-direction: column;
                display: none;
                width: 100%;
                text-align: center;
            }

            .navbar ul li {
                margin: 0.5rem 0;
            }

            .navbar .menu-toggle {
                display: block;
                cursor: pointer;
            }
        }

        .menu-toggle {
            display: none;
            font-size: 1.5rem;
            color: #000;
            /* Negro */
        }
    </style>
    </head>

    <body>

        <nav class="navbar">
            <div class="logo">CVC</div>
            <div class="menu-toggle">&#9776;</div>
            <ul>
                <li><a href="<?= base_url('pacientes') ?>">PACIENTES</a></li>
                <li><a href="<?= base_url('doctores') ?>">DOCTORES</a></li>
                <li><a href="<?= base_url('citas') ?>">CITAS</a></li>
                <li><a href="<?= base_url('recordatorios') ?>">RECORDATORIOS</a></li>
            </ul>
        </nav>

        <script>
            const menuToggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.navbar ul');

            menuToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                if (navLinks.style.display === "flex") {
                    navLinks.style.display = "none";
                } else {
                    navLinks.style.display = "flex";
                }
            });
        </script>

        <!-- Begin page content -->
        <main class="flex-shrink-0">
            <div class="container">
                <?php echo $this->renderSection('contenido'); ?>
            </div>
        </main>

        <footer class="footer mt-auto py-3 bg-body-tertiary">
            <div class="container">
                <span class="text-body-secondary"> 2024 | <strong>CVC</strong></span>
            </div>
        </footer>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <?php echo $this->renderSection('script'); ?>

    </body>

</html>