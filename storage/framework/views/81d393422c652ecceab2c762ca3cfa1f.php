

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f9fafb;
    }

    .card-custom {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
    }

    .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 35px rgba(0, 0, 0, 0.08);
    }

    .card-header-custom {
        font-weight: 600;
        font-size: 1rem;
        border-bottom: 1px solid #f0f0f0;
        padding: 1rem;
    }

    .stat-icon {
        font-size: 2rem;
        padding: 0.8rem;
        border-radius: 0.75rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 48px;
        min-height: 48px;
        color: #fff;
    }

    .card-body-stat {
        padding: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-body-stat .count {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .card-body-stat .title {
        font-size: 0.95rem;
        color: #6c757d;
    }

    .chart-container {
        max-height: 250px;
        height: auto;
        margin: auto;
    }

    .section-header h1 {
        font-weight: 700;
        color: #374151;
    }

    .alert-success {
        border-radius: 0.75rem;
        font-size: 0.9rem;
    }

    .section-divider {
        border-top: 1px solid #e5e7eb;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header mb-4">
            <h1><i class="fas fa-chart-line me-2 text-primary"></i> Dashboard</h1>
        </div>

        
        <?php if(session('success')): ?>
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        
        <div class="row">
            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card card-custom">
                    <div class="card-body-stat">
                        <div>
                            <div class="count"><?php echo e($card['count']); ?></div>
                            <div class="title"><?php echo e($card['title']); ?></div>
                        </div>
                        <div class="stat-icon <?php echo e($card['color']); ?>">
                            <i class="<?php echo e($card['icon']); ?>"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-header-custom bg-primary text-white">
                        Grafik Status Aspirasi
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="aspirasiChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-header-custom bg-success text-white">
                        Grafik Status Pendaftar Magang
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="magangChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
    <div class="col-md-6 mb-4">
        <div class="card card-custom">
            <div class="card-header-custom bg-info text-white">
                Grafik Aspirasi per Bulan
            </div>
            <div class="card-body">
                <canvas id="aspirasiBulananChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card card-custom">
            <div class="card-header-custom bg-warning text-white">
                Grafik Pendaftar Magang per Lowongan
            </div>
            <div class="card-body">
                <canvas id="magangLowonganChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>


        
        <div class="section-divider my-4"></div>

        
        <?php echo $__env->make('components.dashboard.aspirasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('components.dashboard.magang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const warnaAspirasi = ['#34d399', '#f87171', '#fcd34d'];
    const warnaMagang = ['#60a5fa', '#c084fc', '#fdba74'];

    const aspirasiData = [
        <?php echo e($aspirasiDiterima); ?>,
        <?php echo e($aspirasiDitolak); ?>,
        <?php echo e($aspirasiBelumDiproses->count()); ?>

    ];

    const magangData = [
        <?php echo e($pendaftarMagangDiterima); ?>,
        <?php echo e($pendaftarMagangDitolak); ?>,
        <?php echo e($pendaftarBelumDiproses->count()); ?>

    ];

    // Grafik Aspirasi per Bulan
const bulanLabels = <?php echo json_encode($bulanLabels, 15, 512) ?>;
const aspirasiValues = <?php echo json_encode($aspirasiValues, 15, 512) ?>;

new Chart(document.getElementById('aspirasiBulananChart'), {
    type: 'bar',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Jumlah Aspirasi',
            data: aspirasiValues,
            backgroundColor: '#34d399',
            borderRadius: 6,
            barThickness: 24
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#111827',
                titleColor: '#fff',
                bodyColor: '#fff'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});

// Grafik Pendaftar Magang per Lowongan
const lowonganLabels = <?php echo json_encode($lowonganLabels, 15, 512) ?>;
const magangCounts = <?php echo json_encode($magangCounts, 15, 512) ?>;

new Chart(document.getElementById('magangLowonganChart'), {
    type: 'bar',
    data: {
        labels: lowonganLabels,
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: magangCounts,
            backgroundColor: '#60a5fa',
            borderRadius: 6,
            barThickness: 24
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#111827',
                titleColor: '#fff',
                bodyColor: '#fff'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});


    const createDoughnut = (id, data, labels, colors) => {
        new Chart(document.getElementById(id), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    datalabels: {
                        color: '#fff',
                        font: { weight: 'bold', size: 13 },
                        formatter: (value, ctx) => {
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            return total ? (value / total * 100).toFixed(1) + '%' : '0%';
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 13 } }
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fff',
                        bodyColor: '#fff'
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    createDoughnut('aspirasiChart', aspirasiData, ['Diterima', 'Ditolak', 'Belum Diproses'], warnaAspirasi);
    createDoughnut('magangChart', magangData, ['Diterima', 'Ditolak', 'Belum Diproses'], warnaMagang);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\penting\pelayanan_publik_dprd\pelayanan_publik_dprd\resources\views/pages/backend/dashboard.blade.php ENDPATH**/ ?>