// scan.js - Real QR Scanner using html5-qrcode

document.addEventListener('DOMContentLoaded', function () {
    const qrRegion = document.getElementById("reader");
    const resultText = document.getElementById("result-text");
    const resultBox = document.getElementById("scan-result");

    if (!qrRegion || !resultText || !resultBox) {
        console.error("Missing scan UI elements");
        return;
    }

    const html5QrCode = new Html5Qrcode("reader");

    Html5Qrcode.getCameras().then(cameras => {
        if (cameras && cameras.length) {
            html5QrCode.start(
                { facingMode: "environment" }, // or cameras[0].id
                {
                    fps: 10,
                    qrbox: 250
                },
                qrMessage => {
                    // Display scanned result
                    resultText.innerText = qrMessage;
                    resultBox.classList.remove("d-none");

                    // Optional: parse QR data if it's JSON
                    try {
                        const data = JSON.parse(qrMessage);
                        console.log("Decoded Data:", data);
                    } catch (e) {
                        console.warn("Scanned data is not JSON");
                    }

                    // Stop scanning after success
                    html5QrCode.stop();
                },
                errorMessage => {
                    // Scanning error (no QR found in frame)
                    // console.warn(errorMessage);
                }
            );
        }
    }).catch(err => {
        console.error("Camera access error:", err);
        alert("Unable to access camera. Please check permission.");
    });
});
