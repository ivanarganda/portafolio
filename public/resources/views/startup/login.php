
<?php require_once "../../../../middlewares/auth.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pantalla de Inicio de Sesión - Windows 10</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      /* Degradado tipo Windows 10 */
      background: linear-gradient(135deg, #1565c0 0%, #1e88e5 100%);
      overflow: hidden;
    }
    .login-container {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      animation: fadeIn 2s;
    }
    .login-card {
      background: rgba(0, 0, 0, 0.55);
      border-radius: 16px;
      padding: 40px 30px;
      box-shadow: 0 8px 32px 0 rgba(0,0,0,0.25);
      color: white;
      min-width: 330px;
      max-width: 90vw;
    }
    .avatar {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      border: 2px solid #2196f3;
      margin-bottom: 12px;
      object-fit: cover;
    }
    .username {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 24px;
    }
    .clock {
      position: absolute;
      top: 56px;
      left: 50%;
      transform: translateX(-50%);
      color: white;
      font-size: 3.2rem;
      font-weight: 200;
      letter-spacing: 2px;
      text-align: center;
      text-shadow: 1px 2px 8px #002b53;
      user-select: none;
    }
    .date {
      position: absolute;
      top: 120px;
      left: 50%;
      transform: translateX(-50%);
      color: white;
      font-size: 1.4rem;
      font-weight: 300;
      text-align: center;
      text-shadow: 1px 1px 5px #002b53;
      user-select: none;
    }
    .fade-in {
      animation: fadeIn 1.4s;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    .error-msg {
      color: #ff5252;
      margin-bottom: 10px;
      font-weight: 500;
      text-align: center;
    }
    @media (max-width: 600px) {
      .login-card {
        padding: 20px 10px;
        min-width: 220px;
      }
      .clock {
        font-size: 2.1rem;
        top: 32px;
      }
      .date {
        font-size: 1rem;
        top: 70px;
      }
    }
  </style>
</head>
<body>
  <div class="clock" id="clock"></div>
  <div class="date" id="date"></div>
  <div class="login-container">
    <div class="login-card fade-in">
      <div class="d-flex flex-column align-items-center">
        <img src="https://randomuser.me/api/portraits/men/43.jpg" class="avatar mb-2" alt="Avatar usuario">
        <div class="username">Iván González</div>
      </div>
      <form id="loginForm" autocomplete="off">
        <div id="errorMsg" class="error-msg" style="display:none;">Contraseña incorrecta</div>
        <div class="mb-3">
          <input type="password" class="form-control form-control-lg" id="passwordInput" placeholder="Escribe tu contraseña" autofocus required>
        </div>
        <button type="submit" class="btn btn-primary w-100 btn-lg mt-2">Iniciar sesión</button>
      </form>
    </div>
  </div>
  <!-- Bootstrap JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Reloj y fecha dinámica
    function updateClock() {
      const now = new Date();
      let h = now.getHours();
      let m = now.getMinutes();
      h = (h < 10) ? "0" + h : h;
      m = (m < 10) ? "0" + m : m;
      document.getElementById('clock').textContent = `${h}:${m}`;
      // Fecha formato largo
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      const fecha = now.toLocaleDateString('es-ES', options);
      document.getElementById('date').textContent = fecha.charAt(0).toUpperCase() + fecha.slice(1);
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Simulación login simple
    const correctPassword = "windows10";
    const form = document.getElementById('loginForm');
    const errorMsg = document.getElementById('errorMsg');
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const input = document.getElementById('passwordInput').value;
      if (input === correctPassword) {
        errorMsg.style.display = "none";
        // Simulación de acceso
        document.querySelector('.login-card').innerHTML = `
          <div class="text-center fade-in">
            <div class="spinner-border text-primary" role="status"></div>
            <div class="mt-3">Bienvenido, Iván</div>
          </div>
        `;
        setTimeout(() => {
          // Aquí iría el "acceso al escritorio"
          window.location.reload();
        }, 2000);
      } else {
        errorMsg.style.display = "block";
        form.reset();
        document.getElementById('passwordInput').focus();
      }
    });
  </script>
</body>
</html>
