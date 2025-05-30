<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windows 10 Installation</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body {
            background: #0078D7;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .install-container {
            width: 80%;
            max-width: 600px;
            text-align: center;
        }
        .step { display: none; margin: 20px 0; }
        .step.active { display: block; }
        .progress-bar {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            margin: 20px 0;
            position: relative;
        }
        .progress {
            width: 0%;
            height: 100%;
            background: white;
            transition: width 0.3s ease;
        }
        .progress-percentage {
            position: absolute;
            right: -40px;
            top: -10px;
            font-size: 14px;
        }
        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        .button {
            background: white;
            color: #0078D7;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .button:hover { background: #f0f0f0; }
        @keyframes spin { 0% { transform: rotate(0deg);} 100% { transform: rotate(360deg);} }
        .install-animation { position: relative; height: 100px; margin: 20px 0; }
        .data-transfer {
            position: absolute;
            top: 50%; left: 0;
            width: 100%; height: 2px;
            background: linear-gradient(90deg, transparent, white, transparent);
            animation: dataTransfer 1.5s infinite;
        }
        @keyframes dataTransfer {
            0% { transform: translateX(-100%);}
            100% { transform: translateX(100%);}
        }
        .detail-row {
            display: flex; align-items: center; margin: 10px 0;
            background: rgba(255,255,255,0.1); padding: 8px 15px; border-radius: 4px;
            transition: background 0.3s;
        }
        .detail-row:hover { background: rgba(255,255,255,0.2);}
        .detail-row i { margin-right: 10px;}
        .highlight { color: #00ff9d; font-weight: 500;}
        .status-message { font-size: 1.2em; margin-top: 20px; text-shadow: 0 0 10px rgba(255,255,255,0.5);}
    </style>
</head>
<body>
    <div class="install-container">
        <!-- Step 1: Language Selection -->
        <div class="step active" id="step1">
            <h1>Welcome to Installation</h1>
            <p>Please select your language and region to continue</p>
            <select id="language" class="button">
                <option value="en">English</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
            </select>
            <button class="button" onclick="goToStep('versions')">Next</button>
        </div>
        <!-- Step 2: Choose Edition -->
        <div class="step" id="stepVersions">
            <h1>Choose Windows 10 Edition</h1>
            <p>Select the edition that best suits your needs:</p>
            <div style="display: flex; flex-direction: column; gap: 10px; margin: 20px 0;">
                <button class="button" style="text-align: left; width: 100%;" onclick="selectVersion('Home')">
                    <strong>Windows 10 Home</strong><br>
                    <small>For home users - includes essential features for everyday use</small>
                </button>
                <button class="button" style="text-align: left; width: 100%;" onclick="selectVersion('Pro')">
                    <strong>Windows 10 Pro</strong><br>
                    <small>For business use - includes advanced management and security features</small>
                </button>
                <button class="button" style="text-align: left; width: 100%;" onclick="selectVersion('Enterprise')">
                    <strong>Windows 10 Enterprise</strong><br>
                    <small>For large organizations - includes advanced features for IT professionals</small>
                </button>
                <button class="button" style="text-align: left; width: 100%;" onclick="selectVersion('Education')">
                    <strong>Windows 10 Education</strong><br>
                    <small>For students and educational institutions</small>
                </button>
            </div>
            <button class="button" onclick="goToStep('lang')">Back</button>
        </div>
        <!-- Step 3: License -->
        <div class="step" id="step2">
            <h1>License Agreement</h1>
            <div style="height: 60vh; background: rgba(255,255,255,0.1); padding: 10px; margin: 20px 0; text-align: left; overflow-y: auto; color: #fff; font-size: 14px;">
                <!-- For demo purposes, just text. Replace with PHP include if on a server. -->
                <p>
                    <?php include 'eula.txt'; ?>
                </p>
            </div>
            <div>
                <input type="checkbox" id="eulaCheck">
                <label for="eulaCheck">I have read and accept the license agreement</label>
            </div>
            <button class="button" onclick="goToStep('versions')">Back</button>
            <button class="button" onclick="acceptEula()">I Accept</button>
        </div>
        <!-- Step 4: Installing -->
        <div class="step" id="step3">
            <h1>Installing Windows</h1>
            <div class="install-animation">
                <div class="spinner"></div>
                <div class="data-transfer"></div>
            </div>
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
                <div class="progress-percentage" id="progress-percentage">0%</div>
            </div>
            <div class="install-details">
                <div class="detail-row">
                    <i class="file-icon">📁</i>
                    <span>Current file: <span id="currentFile" class="highlight">system32.dll</span></span>
                </div>
                <div class="detail-row">
                    <i class="speed-icon">⚡</i>
                    <span>Transfer speed: <span id="installSpeed" class="highlight">0 MB/s</span></span>
                </div>
                <div class="detail-row">
                    <i class="time-icon">⏱️</i>
                    <span>Estimated time: <span id="timeRemaining" class="highlight">Calculating...</span></span>
                </div>
            </div>
            <p id="status" class="status-message">Preparing your Windows installation...</p>
        </div>
        <!-- Step 5: Finish -->
        <div class="step" id="step4">
            <h1>Installation Complete</h1>
            <p>Your system has been successfully configured.</p>
            <button class="button" onclick="finish()">Finish</button>
        </div>
    </div>

    <script>
        // STATE VARIABLES
        let currentStep = 1;
        let selectedVersion = '';
        let totalSteps = 4;

        function showStep(stepId) {
            document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
            document.getElementById(stepId).classList.add('active');
        }

        // Navigation functions
        function goToStep(step) {
            switch (step) {
                case 'lang':
                    currentStep = 1;
                    showStep('step1');
                    break;
                case 'versions':
                    currentStep = 2;
                    showStep('stepVersions');
                    break;
                case 'license':
                    currentStep = 3;
                    showStep('step2');
                    break;
                case 'install':
                    currentStep = 4;
                    showStep('step3');
                    startInstallation();
                    break;
            }
        }

        // Edition selection logic
        function selectVersion(version) {
            selectedVersion = version;
            showStep('step2'); // Show license agreement
        }

        // Accept license, validate checkbox
        function acceptEula() {
            const check = document.getElementById('eulaCheck');
            if (!check.checked) {
                alert('You must accept the license agreement to proceed.');
                return;
            }
            showStep('step3');
            startInstallation();
        }

        // Installation simulation
        function startInstallation() {
            let progress = 0;
            const progressBar = document.getElementById('progress');
            const status = document.getElementById('status');
            const percent = document.getElementById('progress-percentage');
            const currentFile = document.getElementById('currentFile');
            const installSpeed = document.getElementById('installSpeed');
            const timeRemaining = document.getElementById('timeRemaining');

            const steps = [
                `Preparing ${selectedVersion ? selectedVersion : ''} Windows 10 installation...`,
                'Copying files...',
                'Installing features...',
                'Configuring settings...',
                'Finalizing installation...'
            ];
            const files = ['system32.dll','bootmgr','explorer.exe','winload.exe','hal.dll','ntoskrnl.exe'];
            let stepIndex = 0;
            let interval = setInterval(() => {
                progress += 1;
                if (progress > 100) progress = 100;
                progressBar.style.width = `${progress}%`;
                percent.textContent = `${progress}%`;

                // Change status and file every 20%
                if (progress % 20 === 0 && stepIndex < steps.length) {
                    status.textContent = steps[stepIndex];
                    stepIndex++;
                }
                // Simulate file copy
                if (progress % 10 === 0) {
                    currentFile.textContent = files[Math.floor(Math.random() * files.length)];
                }
                // Simulate transfer speed and ETA
                installSpeed.textContent = (Math.random() * 5 + 5).toFixed(2) + ' MB/s';
                timeRemaining.textContent = `${Math.max(0, Math.ceil((100 - progress) / 10))} s`;

                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        showStep('step4');
                    }, 1000);
                }
            }, 100);
        }

        function finish() {
            window.onbeforeunload = null;
            window.location.href = 'boot.php'; // or any page
        }

        // Prevent page refresh and navigation during install
        window.onbeforeunload = function() {
            if (document.getElementById('step3').classList.contains('active')) {
                return "Installation in progress. Are you sure you want to leave?";
            }
        };
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</body>
</html>
