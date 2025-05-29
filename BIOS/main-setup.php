<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PhoenixBIOS Setup Utility</title>
    <style>
        :root {
            --bios-blue: #00007b;
            --bios-darkblue: #253b6e;
            --bios-grey: #bfbfbf;
            --bios-lightblue: #c2e0ff;
            --bios-white: #fff;
            --bios-border: #7089a4;
            --bios-title: #f4dfad;
            --bios-footer: #d0e7ff;
        }
        html, body {
            height: 100%;
        }
        body {
            background: var(--bios-blue);
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            font-family: 'Courier New', monospace;
            font-size: 17px;
            color: var(--bios-grey);
            overflow: hidden;
        }
        .bios-window {
            width: 920px;
            max-width: 99vw;
            height: 620px;
            max-height: 98vh;
            margin: 22px auto 0 auto;
            border: 3px solid var(--bios-white);
            background: var(--bios-blue);
            box-shadow: 0 0 22px #0c1761;
            display: flex;
            flex-direction: column;
        }
        /* Tabs */
        .bios-tabs {
            display: flex;
            background: var(--bios-title);
            border-bottom: 2px solid var(--bios-border);
            font-size: 18px;
        }
        .bios-tab {
            padding: 3px 34px 4px 34px;
            border-right: 1px solid var(--bios-border);
            color: var(--bios-darkblue);
            background: var(--bios-title);
            font-weight: bold;
        }
        .bios-tab.selected {
            background: var(--bios-blue);
            color: var(--bios-white);
            border-bottom: 2px solid var(--bios-white);
        }
        .bios-header {
            background: var(--bios-blue);
            color: var(--bios-white);
            font-size: 20px;
            text-align: center;
            padding: 4px 0 2px 0;
            border-bottom: 1px solid var(--bios-border);
            font-weight: bold;
            letter-spacing: 2px;
            margin-top:-10px;
        }
        .bios-content {
            display: flex;
            flex: 1;
            min-height: 0;
        }
        /* Left panel */
        .bios-panel {
            flex: 3;
            background: var(--bios-blue);
            border-right: 2px solid var(--bios-border);
            padding: 15px 18px 0 32px;
            min-width: 0;
        }
        .bios-row {
            display: flex;
            margin-bottom: 7px;
            align-items: center;
            cursor: pointer;
            min-height: 25px;
        }
        .bios-label {
            color: var(--bios-grey);
            min-width: 220px;
        }
        .bios-value {
            color: var(--bios-white);
            background: var(--bios-darkblue);
            min-width: 300px;
            padding: 2px 12px;
            margin-left: 16px;
            border-radius: 3px;
            border: 1px solid var(--bios-border);
            display: inline-block;
        }
        /* Right help panel */
        .bios-help {
            flex: 2;
            background: var(--bios-lightblue);
            color: var(--bios-darkblue);
            padding: 16px 22px 0 18px;
            font-size: 15px;
            border-left: 2px solid var(--bios-border);
            min-width: 0;
        }
        .bios-help-title {
            font-weight: bold;
            font-size: 17px;
            margin-bottom: 9px;
            color: var(--bios-darkblue);
            letter-spacing: 1px;
        }
        .bios-help-content {
            min-height: 120px;
            line-height: 1.6;
        }
        /* Footer */
        .bios-footer {
            background: var(--bios-footer);
            color: var(--bios-blue);
            font-size: 16px;
            padding: 6px 0 2px 0;
            border-top: 2px solid var(--bios-border);
            text-align: left;
            display: flex;
            justify-content: space-around;
            align-items: center;
            letter-spacing: 1px;
            min-height: 36px;
            font-weight: bold;
            user-select: none;
        }
        /* Selection simulation */
        .bios-row.selected .bios-label,
        .bios-row.selected .bios-value {
            background: #e3c374;
            color: var(--bios-blue);
        }
        /* Cursor blink */
        .cursor {
            display: inline-block;
            width: 10px;
            height: 20px;
            background: var(--bios-white);
            margin-left: 5px;
            animation: blink 1s step-end infinite;
            vertical-align: middle;
        }
        @keyframes blink { 50% { opacity: 0; } }
        /* Responsive for small screens */
        @media (max-width: 1100px) {
            .bios-window { width: 99vw; height: 98vh; }
            .bios-panel, .bios-help { font-size: 15px; }
            .bios-row { min-height: 21px; }
        }
        @media (max-width: 700px) {
            .bios-window { min-width: 0; width: 100vw; }
            .bios-help { display: none; }
        }
    </style>
</head>
<body>
    <div class="bios-window">
        <!-- Tabs -->
        <div class="bios-tabs">
            <span class="bios-row bios-tab">Main</span>
            <span class="bios-row bios-tab">Advanced</span>
            <span class="bios-row bios-tab">Security</span>
            <span class="bios-row bios-tab">Boot</span>
            <span class="bios-row bios-tab selected">Exit</span>
        </div>
        <!-- Title -->
        <div class="bios-header">
            PhoenixBIOS Setup Utility
        </div>
        <!-- Main content area: left (fields), right (help) -->
        <div class="bios-content">
            <!-- LEFT PANEL -->
            <div class="bios-panel">
                <div class="bios-row" data-help="Tipo de dispositivo detectado según el navegador.">
                    <div class="bios-label">Device Type:</div>
                    <div class="bios-value" id="device-type"></div>
                </div>
                <div class="bios-row" data-help="Sistema operativo detectado por el navegador.">
                    <div class="bios-label">Operating System:</div>
                    <div class="bios-value" id="os"></div>
                </div>
                <div class="bios-row" data-help="Navegador web actual.">
                    <div class="bios-label">Browser:</div>
                    <div class="bios-value" id="browser"></div>
                </div>
                <div class="bios-row" data-help="Cadena User Agent completa que identifica tu navegador y sistema.">
                    <div class="bios-label">User Agent:</div>
                    <div class="bios-value" id="user-agent"></div>
                </div>
                <div class="bios-row" data-help="Idioma principal configurado en el navegador.">
                    <div class="bios-label">Language:</div>
                    <div class="bios-value" id="language"></div>
                </div>
                <div class="bios-row" data-help="Resolución de pantalla detectada.">
                    <div class="bios-label">Screen Resolution:</div>
                    <div class="bios-value" id="screen-resolution"></div>
                </div>
                <div class="bios-row" data-help="Plataforma de hardware del navegador.">
                    <div class="bios-label">Platform:</div>
                    <div class="bios-value" id="platform"></div>
                </div>
                <div class="bios-row" data-help="¿El navegador está conectado a internet?">
                    <div class="bios-label">Online:</div>
                    <div class="bios-value" id="online-status"></div>
                </div>
                <div class="bios-row" data-help="Fecha actual detectada.">
                    <div class="bios-label">System Date:</div>
                    <div class="bios-value" id="bios-date"></div>
                </div>
                <div class="bios-row" data-help="Hora actual detectada.">
                    <div class="bios-label">System Time:</div>
                    <div class="bios-value" id="bios-time"></div>
                </div>
                <div class="bios-row" style="margin-top:18px;">
                    <div class="bios-label"></div>
                    <div class="bios-value"><span class="cursor"></span></div>
                </div>
            </div>
            <!-- RIGHT HELP PANEL -->
            <div class="bios-help">
                <div class="bios-help-title">Item Specific Help</div>
                <div class="bios-help-content" id="bios-help-content">
                    Selecciona una fila para ver la descripción aquí.
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="bios-footer">
            <span>F1 Help</span>
            <span>↑↓ Select Item</span>
            <span>←→ Select Menu</span>
            <span>Enter Select</span>
            <span>F9 Setup Defaults</span>
            <span>F10 Save and Exit</span>
            <span>Esc Exit</span>
        </div>
    </div>
    <script>
        // Lógica para mostrar datos reales del dispositivo/navegador
        function getDeviceType() {
            const ua = navigator.userAgent;
            if (/mobile|android|touch|webos|hpwos/i.test(ua)) return 'Mobile/Tablet';
            if (/windows|macintosh|linux/i.test(ua)) return 'PC/Desktop';
            return 'Unknown';
        }
        function getOS() {
            const platform = navigator.platform.toLowerCase();
            const ua = navigator.userAgent.toLowerCase();
            if (platform.includes('win')) return 'Windows';
            if (platform.includes('mac')) return 'MacOS';
            if (platform.includes('linux')) return 'Linux';
            if (ua.includes('android')) return 'Android';
            if (/iphone|ipad|ipod/.test(ua)) return 'iOS';
            return 'Unknown';
        }
        function getBrowser() {
            const ua = navigator.userAgent;
            if (ua.indexOf("Firefox") > -1) return "Mozilla Firefox";
            if (ua.indexOf("Opera") > -1 || ua.indexOf("OPR") > -1) return "Opera";
            if (ua.indexOf("Edg") > -1) return "Microsoft Edge";
            if (ua.indexOf("Chrome") > -1) return "Google Chrome";
            if (ua.indexOf("Safari") > -1) return "Safari";
            return "Unknown";
        }
        document.getElementById('device-type').textContent = getDeviceType();
        document.getElementById('os').textContent = getOS();
        document.getElementById('browser').textContent = getBrowser();
        document.getElementById('user-agent').textContent = navigator.userAgent;
        document.getElementById('language').textContent = navigator.language;
        document.getElementById('screen-resolution').textContent =
            window.screen.width + " x " + window.screen.height;
        document.getElementById('platform').textContent = navigator.platform;
        document.getElementById('online-status').textContent = navigator.onLine ? 'Yes' : 'No';

        // Fecha y hora en vivo estilo BIOS
        function pad(n) { return n<10 ? '0'+n : n; }
        function updateBiosDateTime() {
            const now = new Date();
            document.getElementById('bios-date').textContent =
                pad(now.getMonth()+1)+'/'+pad(now.getDate())+'/'+now.getFullYear();
            document.getElementById('bios-time').textContent =
                pad(now.getHours())+':'+pad(now.getMinutes())+':'+pad(now.getSeconds());
        }
        setInterval(updateBiosDateTime, 1000);
        updateBiosDateTime();

        // Simula "selección" y ayuda contextual como en PhoenixBIOS
        const rows = document.querySelectorAll('.bios-row');
        const helpBox = document.getElementById('bios-help-content');
        let selectedIndex = 0;

        function selectRow(idx) {
            rows.forEach(r => r.classList.remove('selected'));
            if (rows[idx]) {
                rows[idx].classList.add('selected');
                helpBox.textContent = rows[idx].dataset.help || '';
            }
        }
        rows.forEach((row, idx) => {
            row.addEventListener('mouseenter', () => selectRow(idx));
        });
        // Simula teclado (flechas arriba/abajo)
        document.addEventListener('keydown', e => {
            if (e.key === 'ArrowDown') {
                selectedIndex = Math.min(rows.length - 2, selectedIndex + 1); // penúltima fila seleccionable
                console.log(selectedIndex);
                selectRow(selectedIndex);
                e.preventDefault();
            } else if (e.key === 'ArrowUp') {
                selectedIndex = Math.max(0, selectedIndex - 1);
                console.log(selectedIndex);
                selectRow(selectedIndex);
                e.preventDefault();
            } else if ( e.key === 'ArrowRight' ) {
                // Lógica para la flecha derecha
                selectedIndex = Math.min(rows.length - 2, selectedIndex + 1); // penúltima fila seleccionable
                console.log(selectedIndex);
                selectRow(selectedIndex);
                e.preventDefault();
            } else if ( e.key === 'ArrowLeft' ) {
                // Lógica para la flecha izquierda
                selectedIndex = Math.max(0, selectedIndex - 1);
                selectRow(selectedIndex);
                e.preventDefault();
            } else if (e.key === 'Enter') {
                // Simula acción al presionar Enter
                alert('Selected: ' + rows[selectedIndex].textContent);
            }
        });
        selectRow(selectedIndex);
    </script>
</body>
</html>
