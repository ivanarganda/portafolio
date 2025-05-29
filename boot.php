<?php
require_once 'controllers/HelpersController.php';
require_once 'models/Boot.php';

$server = get_server();
$ip_client = $server['ip_client'];
$user_agent = $server['user_agent'];

if (isset($server['forwarded'])) {
    $ip_client = $server['forwarded'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boot Screen</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        canvas {
            display: block;
            
        }
        canvas * {
            animation: blink 1s infinite;
        }
        /* keyframes for canvas */
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
<canvas id="bootCanvas" style="width: 100%; height: 100%; background: black; border:none;padding:10px" onload="init()">
</canvas>
</body>
</html>
<script>

    const d = document;
    let OSstarted = false;

    function isRedirectedFromBIOS() {
        // Check if the user was redirected from the BIOS page
        return sessionStorage.getItem('redirected_bios') === 'true';
    }

    function handleKeyDown(event) {
        // Handle key down events
        event.preventDefault(); // Prevent default action
        if (OSstarted) return; // Ignore key events if OS has started
        console.log('Key pressed:', event.key);
        if (event.key === 'F1') {
            // Simulate entering BIOS setup
            console.log('Entering BIOS setup...');
            alert('Entering BIOS setup...');
            // redirect to bios.php and clear redirect history
            window.location.replace('bios.php');
            // Clear session storage to prevent redirect loop
            sessionStorage.setItem('redirected_bios', 'true');

        } else if (event.key === 'F2') {
            // Simulate booting into the OS
            console.log('Booting into the OS...');
        } else {
            console.log('Unsupported key pressed:', event.key);
        }
    }

    function initKeyboard() {
        // Simulate keyboard initialization
        d.addEventListener('keydown', handleKeyDown);
    }

    function startUpOS() {
        // Simulate starting the OS
        isRedirectedFromBIOS() && window.location.replace('BIOS/main-setup.php');
        OSstarted = true;
        console.log('OS is starting up...');
        const canvas = document.getElementById('bootCanvas');
        const ctx = canvas.getContext('2d');

        // Fondo negro
        ctx.fillStyle = 'black';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Logo de Windows y loader centrados
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        ctx.fillStyle = '#00A4EF';

        // Logo de Windows plano (sin perspectiva)
        const size = 60;
        const gap = 4;

        // Dibujar los cuadrados del logo Windows
        ctx.fillRect(centerX - size - gap, centerY - size - gap, size, size);
        ctx.fillRect(centerX + gap, centerY - size - gap, size, size);
        ctx.fillRect(centerX - size - gap, centerY + gap, size, size);
        ctx.fillRect(centerX + gap, centerY + gap, size, size);

        // Círculo de carga debajo del logo
        const radius = 30;
        const totalDots = 8;
        let currentDot = 0;

        setInterval(() => {
            ctx.fillStyle = 'black';
            ctx.fillRect(centerX - radius - 10, centerY + 120, radius * 2 + 20, radius * 2 + 20);
            
            for(let i = 0; i < totalDots; i++) {
            const angle = (i * 2 * Math.PI / totalDots) - Math.PI/2;
            const x = centerX + radius * Math.cos(angle);
            const y = centerY + 140 + radius * Math.sin(angle);
            
            ctx.beginPath();
            ctx.arc(x, y, 3, 0, 2 * Math.PI);
            ctx.fillStyle = i <= currentDot ? '#000000' : '#ffffff';
            ctx.fill();
            }
            
            currentDot = (currentDot + 1) % totalDots;
        }, 500);
    }

    function initBIOS() {
        // Initialize keyboard
        initKeyboard();
        var boot = {
            ip_client: "<?php echo $ip_client; ?>",
            user_agent: "<?php echo $user_agent; ?>",
            server: <?php echo json_encode($server); ?>
        };
        
        window.boot = boot;
        
        const canvas = document.getElementById('bootCanvas');
        if (canvas.getContext) {
            const ctx = canvas.getContext('2d');
            
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
            
            // Clear and set background
            ctx.fillStyle = 'black';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Set text style to match BIOS look
            ctx.fillStyle = '#FF0000'; // American Megatrends red color
            ctx.font = 'bold 24px monospace';
            
            // Draw American Megatrends logo text
            ctx.fillText('American', 20, 30);
            ctx.fillText('Megatrends', 20, 60);
            
            // Switch to white color for system information
            ctx.fillStyle = '#FFFFFF';
            ctx.font = '16px monospace';
            
            // Draw system information
            let y = 120;
            ctx.fillText('AMIBIOS(C)2017 American Megatrends, Inc.', 20, y);
            y += 30;
            ctx.fillText('ASUS PRIME Z270-A ACPI BIOS Revision 0906', 20, y);
            y += 30;
            ctx.fillText('CPU: Intel(R) Core(TM) i7-7700K CPU @ 4.20GHz', 20, y);
            y += 20;
            ctx.fillText('Speed: 4200MHz', 20, y);
            y += 30;
            ctx.fillText('Total Memory: ' + Math.round(boot.server.memory_limit / 1024) + 'MB', 20, y);
            y += 30;
            ctx.fillText('USB Devices total: ' + '0 Drive, 4 Keyboards, 2 Mice, 1 Hub', 20, y);
            y += 30;
            ctx.fillText('Detected ATA/ATAPI Devices...', 20, y);
            y += 20;
            ctx.fillText('SATA Port1:    TOSHIBA DT01ACA300', 20, y);
            y += 40;
            
            // Error message in red
            ctx.fillStyle = '#FF0000';
            ctx.fillText('CPU Fan speed error detected.', 20, y);
            y += 20;
            ctx.fillText('Ensure that the CPU fan is properly installed on the CPU_FAN header', 20, y);
            y += 20;
            ctx.fillText('or adjust/disable the Fan Speed Low Limit option in the UEFI BIOS.', 20, y);
            y += 20;
            ctx.fillStyle = '#00A4EF'; // Reset to white for next text
            ctx.fillText('Press F1 to Run SETUP or F2 to priority boot', 20, y);
        }
        // Agregar justo antes del cierre del script
        setTimeout(() => {
            startUpOS();
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Initialize BIOS screen
        initBIOS();
        // Check if redirected from BIOS
        isRedirectedFromBIOS() && window.location.replace('BIOS/main-setup.php');
    });
</script>