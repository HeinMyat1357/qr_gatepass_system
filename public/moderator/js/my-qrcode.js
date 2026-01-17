document.addEventListener('DOMContentLoaded', function () {
    const qrContainer = document.getElementById('user-qrcode');

    if (!qrContainer) {
        console.error('QR container not found.');
        return;
    }

    // ✅ Make sure qrValue is injected from Blade
    if (typeof qrValue === 'undefined' || !qrValue) {
        console.error('qrValue is not defined.');
        return;
    }

    // ✅ Generate QR Code
    const qrcode = new QRCode(qrContainer, {
        text: qrValue,
        width: 200,
        height: 200,
        colorDark: '#000000',
        colorLight: '#ffffff',
        correctLevel: QRCode.CorrectLevel.H
    });

    // ✅ Download QR Code
    const downloadBtn = document.getElementById('download-qrcode');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function () {
            const img = qrContainer.querySelector('img');
            if (!img) return alert('QR code not found.');
            const link = document.createElement('a');
            link.href = img.src;
            link.download = 'my-qr-code.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    }

    // ✅ Print QR Code
    const printBtn = document.getElementById('print-qrcode');
    if (printBtn) {
        printBtn.addEventListener('click', function () {
            const img = qrContainer.querySelector('img');
            if (!img) return alert('QR code not found.');
            const win = window.open('', '_blank');
            win.document.write(`
                <html>
                <head><title>Print QR Code</title></head>
                <body style="text-align:center;">
                    <h3>My QR Code</h3>
                    <img src="${img.src}" width="200" />
                    <p>Scan this code for attendance</p>
                </body>
                </html>
            `);
            win.document.close();
            win.focus();
            win.print();
            win.onafterprint = () => win.close();
        });
    }
});
