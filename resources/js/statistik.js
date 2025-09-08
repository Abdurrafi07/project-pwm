import Chart from "chart.js/auto";

document.addEventListener('DOMContentLoaded', function () {
    // Data Bulanan
    let dataBulanan = Array(12).fill(0);
    const statistikBulanan = window.statistikBulanan || {};

    for (const [bulan, total] of Object.entries(statistikBulanan)) {
        dataBulanan[bulan - 1] = total;
    }

    for (let i = 1; i < dataBulanan.length; i++) {
        dataBulanan[i] += dataBulanan[i - 1];
    }

    new Chart(document.getElementById('chartBulanan'), {
        type: 'line',
        data: {
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            datasets: [{
                label: 'Total UMKM Akumulasi',
                data: dataBulanan,
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.3,
                fill: false
            }]
        }
    });

    // Data Tahunan
    const tahunLabels = Object.keys(window.statistikTahunan || {});
    const tahunData   = Object.values(window.statistikTahunan || {});

    new Chart(document.getElementById('chartTahunan'), {
        type: 'line',
        data: {
            labels: tahunLabels,
            datasets: [{
                label: 'Total UMKM Tahunan',
                data: tahunData,
                borderColor: 'rgba(153, 102, 255, 1)',
                tension: 0.3,
                fill: false
            }]
        }
    });

    // Pie Chart Daerah
    const daerahLabels = window.daerahLabels || [];
    const daerahData   = window.daerahCounts || [];

    new Chart(document.getElementById('chartDaerah'), {
        type: 'pie',
        data: {
            labels: daerahLabels,
            datasets: [{
                label: 'UMKM per Daerah',
                data: daerahData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ]
            }]
        }
    });

    // Bar Chart Sektor
    const sektorLabels = window.sektorLabels || [];
    const sektorData   = window.sektorCounts || [];

    new Chart(document.getElementById('chartSektor'), {
        type: 'bar',
        data: {
            labels: sektorLabels,
            datasets: [{
                label: 'UMKM per Sektor',
                data: sektorData,
                backgroundColor: 'rgba(255, 159, 64, 0.6)'
            }]
        }
    });

    // Pie Chart Kategori
    const kategoriLabels = window.kategoriLabels || [];
    const kategoriData   = window.kategoriCounts || [];

    new Chart(document.getElementById('chartKategori'), {
        type: 'pie',
        data: {
            labels: kategoriLabels,
            datasets: [{
                label: 'UMKM per Kategori',
                data: kategoriData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ]
            }]
        }
    });
});
