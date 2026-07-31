<?= $this->extend('admin/layouts/template') ?>

<?= $this->section('content') ?>

<style>
    .entrance-container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    @media (min-width: 992px) {
        .entrance-container {
            grid-template-columns: 1.5fr 1fr;
        }
    }

    .main-counter-card {
        background: linear-gradient(145deg, #ffffff, #f0ffff);
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        box-shadow: 0 10px 40px -10px rgba(0,200,200,0.15);
        border: 1px solid rgba(255,255,255,0.8);
        position: relative;
        overflow: hidden;
    }
    .main-counter-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(6,182,212,0.1) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
    }

    .counter-icon {
        width: 64px;
        height: 64px;
        background: #06b6d4;
        color: white;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
    }

    .counter-label {
        font-size: 1rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .counter-number {
        font-size: 5.5rem;
        font-weight: 900;
        color: #0f172a;
        line-height: 1;
        margin-bottom: 2rem;
        font-family: var(--font-heading);
    }
    .counter-number span {
        font-size: 1.5rem;
        font-weight: 700;
        color: #94a3b8;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .btn-counter {
        border: none;
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 1.1rem;
        font-weight: 800;
        color: white;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .btn-counter:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .btn-green { background: #10b981; }
    .btn-blue { background: #0ea5e9; }
    .btn-orange { background: #f97316; }
    .btn-red { background: #ef4444; }

    .btn-reset {
        background: transparent;
        border: none;
        color: #ef4444;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 20px;
        transition: background 0.2s;
    }
    .btn-reset:hover {
        background: #fee2e2;
    }

    .stats-column {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .stat-box {
        background: white;
        border-radius: 20px;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
        transition: transform 0.3s ease;
    }
    .stat-box:hover {
        transform: translateY(-2px);
    }

    .stat-box-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-box-icon.teal { color: #0d9488; background: #ccfbf1; }
    .stat-box-icon.green { color: #16a34a; background: #dcfce7; }
    .stat-box-icon.orange { color: #ea580c; background: #ffedd5; }

    .stat-box-info p {
        margin: 0;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
    }
    .stat-box-info h4 {
        margin: 0;
        font-size: 1.75rem;
        font-weight: 800;
        color: #1e293b;
    }
    .stat-box-info h4 span {
        font-size: 1rem;
        font-weight: 600;
        color: #94a3b8;
    }

    .history-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
    }
    .history-card h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1.25rem;
        color: #0f172a;
    }
    .history-card p {
        margin: 0 0 1.5rem 0;
        color: #64748b;
        font-size: 0.9rem;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
    }
    .history-table th {
        text-align: left;
        padding: 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1px solid #e2e8f0;
    }
    .history-table td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
        font-weight: 600;
        color: #334155;
    }
    .val-positive { color: #10b981; }
    .val-negative { color: #ef4444; }

    /* Chart Styles */
    .chart-container {
        position: relative;
        height: 350px;
        width: 100%;
    }
    
    .chart-filters {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .btn-filter {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-filter.active {
        background: #0ea5e9;
        border-color: #0ea5e9;
        color: white;
    }
</style>

<div style="margin-bottom: 10px;">
    <p style="color: #64748b; font-size: 0.95rem;">Catat jumlah pengunjung yang memasuki kawasan wisata hari ini.</p>
</div>

<div class="entrance-container">
    <!-- Main Counter Card -->
    <div class="main-counter-card">
        <div class="counter-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        </div>
        <div class="counter-label">Total pengunjung hari ini</div>
        <div class="counter-number">
            <?= number_format($total_today, 0, ',', '.') ?> <span>Orang</span>
        </div>

        <div class="action-buttons">
            <form action="<?= base_url('admin/entrance/add') ?>" method="POST" style="display:inline;">
                <input type="hidden" name="amount" value="1">
                <button type="submit" class="btn-counter btn-green">+ 1 Orang</button>
            </form>
            <form action="<?= base_url('admin/entrance/add') ?>" method="POST" style="display:inline;">
                <input type="hidden" name="amount" value="5">
                <button type="submit" class="btn-counter btn-blue">+ 5 Orang</button>
            </form>
            <form action="<?= base_url('admin/entrance/add') ?>" method="POST" style="display:inline;">
                <input type="hidden" name="amount" value="10">
                <button type="submit" class="btn-counter btn-orange">+ 10 Orang</button>
            </form>
            <form action="<?= base_url('admin/entrance/add') ?>" method="POST" style="display:inline;">
                <input type="hidden" name="amount" value="-1">
                <button type="submit" class="btn-counter btn-red">- 1 Orang</button>
            </form>
        </div>

        <div style="margin-top: 1rem; margin-bottom: 2rem;">
            <form action="<?= base_url('admin/entrance/add') ?>" method="POST" style="display:flex; justify-content: center; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                <input type="number" name="amount" placeholder="Input manual..." required style="padding: 10px 15px; border-radius: 20px; border: 1px solid #cbd5e1; outline: none; font-size: 1rem; width: 160px;">
                <button type="submit" class="btn-counter" style="background: #8b5cf6; padding: 10px 20px; font-size: 1rem;">Simpan</button>
            </form>
        </div>


    </div>

    <!-- Stats Column -->
    <div class="stats-column">
        <div class="stat-box">
            <div class="stat-box-icon teal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
            <div class="stat-box-info">
                <p>Total Pengunjung Hari Ini</p>
                <h4><?= number_format($total_today, 0, ',', '.') ?> <span>Orang</span></h4>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-box-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="stat-box-info">
                <p>Total Minggu Ini</p>
                <h4><?= number_format($total_week, 0, ',', '.') ?> <span>Orang</span></h4>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-box-icon orange">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="stat-box-info">
                <p>Total Bulan Ini</p>
                <h4><?= number_format($total_month, 0, ',', '.') ?> <span>Orang</span></h4>
            </div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="history-card">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3>Statistik Pengunjung</h3>
            <p>Grafik jumlah pengunjung berdasarkan periode waktu.</p>
        </div>
        <div class="chart-filters" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center; justify-content: flex-end;">
            <form method="get" action="<?= base_url('admin/entrance') ?>" style="display: flex; gap: 8px; align-items: center; margin-right: 1rem;">
                <input type="date" name="start_date" style="padding: 6px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem;" value="<?= esc($_GET['start_date'] ?? '') ?>" required>
                <span style="color: #64748b; font-size: 0.85rem;">-</span>
                <input type="date" name="end_date" style="padding: 6px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem;" value="<?= esc($_GET['end_date'] ?? '') ?>" required>
                <button type="submit" style="padding: 6px 12px; background: var(--color-primary); color: white; border: none; border-radius: 6px; font-size: 0.85rem; font-weight: 600; cursor: pointer;">Filter</button>
                <?php if(isset($_GET['start_date'])): ?>
                    <a href="<?= base_url('admin/entrance') ?>" style="padding: 6px 12px; background: #ef4444; color: white; border: none; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600;">Reset</a>
                <?php endif; ?>
            </form>
            
            <button onclick="document.getElementById('exportModal').style.display='flex'" style="padding: 6px 12px; background: #10b981; color: white; border: none; border-radius: 6px; font-size: 0.85rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px; margin-right: 1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="8" y1="13" x2="16" y2="13"></line><line x1="8" y1="17" x2="16" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Export Excel
            </button>
            
            <?php if(!isset($_GET['start_date'])): ?>
                <button class="btn-filter active" onclick="updateChart('day', this)">7 Hari Terakhir</button>
                <button class="btn-filter" onclick="updateChart('week', this)">4 Minggu Terakhir</button>
                <button class="btn-filter" onclick="updateChart('month', this)">Tahun Ini</button>
            <?php else: ?>
                <button class="btn-filter active" onclick="updateChart('day', this)">Hasil Filter</button>
            <?php endif; ?>
        </div>
    </div>
    <div class="chart-container">
        <canvas id="visitorChart"></canvas>
    </div>
</div>

<!-- History Section -->
<div class="history-card">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3>Riwayat Input</h3>
            <p>Seluruh perubahan jumlah pengunjung yang dicatat hari ini.</p>
        </div>
        <div style="background: #f1f5f9; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            Hari ini
        </div>
    </div>

    <div class="table-responsive">
        <table class="history-table">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Perubahan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($history)): ?>
                    <tr>
                        <td colspan="2" style="text-align: center; color: #94a3b8; font-weight: 500;">Belum ada data pengunjung hari ini.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($history as $log): ?>
                        <tr>
                            <td><?= date('H:i', strtotime($log['created_at'])) ?></td>
                            <td>
                                <?php if ($log['amount'] > 0): ?>
                                    <span class="val-positive">+ <?= $log['amount'] ?> Orang</span>
                                <?php elseif ($log['amount'] < 0): ?>
                                    <span class="val-negative">- <?= abs($log['amount']) ?> Orang</span>
                                <?php else: ?>
                                    <span style="color:#64748b;">Reset (<?= $log['amount'] ?>)</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Export Modal -->
<div id="exportModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 2rem; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
        <h3 style="margin-top: 0; margin-bottom: 1.5rem; color: #1e293b; display: flex; justify-content: space-between; align-items: center;">
            Export Data Pengunjung
            <button type="button" onclick="document.getElementById('exportModal').style.display='none'" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #94a3b8;">&times;</button>
        </h3>
        <form method="get" action="<?= base_url('admin/entrance/export') ?>">
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: #475569; font-weight: 500; font-size: 0.9rem;">Mulai Tanggal (Opsional)</label>
                <input type="date" name="start_date" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px;" value="<?= esc($_GET['start_date'] ?? '') ?>">
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: #475569; font-weight: 500; font-size: 0.9rem;">Sampai Tanggal (Opsional)</label>
                <input type="date" name="end_date" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px;" value="<?= esc($_GET['end_date'] ?? '') ?>">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: #475569; font-weight: 500; font-size: 0.9rem;">Kelompokkan Data (Per)</label>
                <select name="group_by" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; color: #1e293b;">
                    <option value="raw">Log Mentah (Seluruh Catatan)</option>
                    <option value="day">Per Hari</option>
                    <option value="week">Per Minggu</option>
                    <option value="month">Per Bulan</option>
                    <option value="year">Per Tahun</option>
                </select>
            </div>
            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <button type="button" onclick="document.getElementById('exportModal').style.display='none'" style="padding: 10px 16px; background: #f1f5f9; color: #475569; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Batal</button>
                <button type="submit" onclick="document.getElementById('exportModal').style.display='none'" style="padding: 10px 16px; background: #10b981; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="8" y1="13" x2="16" y2="13"></line><line x1="8" y1="17" x2="16" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    Download Excel
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartDataDay = <?= json_encode($chart_day) ?>;
    const chartDataWeek = <?= json_encode($chart_week) ?>;
    const chartDataMonth = <?= json_encode($chart_month) ?>;

    let currentChart;

    function initChart(data, label) {
        const ctx = document.getElementById('visitorChart').getContext('2d');
        
        if (currentChart) {
            currentChart.destroy();
        }

        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(14, 165, 233, 0.5)');
        gradient.addColorStop(1, 'rgba(14, 165, 233, 0.0)');

        currentChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: label,
                    data: data.data,
                    borderColor: '#0ea5e9',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#0ea5e9',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 16,
                        titleFont: { size: 13, weight: 'normal' },
                        titleColor: '#94a3b8',
                        titleMarginBottom: 8,
                        bodyFont: { size: 16, weight: 'bold' },
                        bodyColor: '#ffffff',
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Orang';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 12 }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 12 }
                        }
                    }
                }
            }
        });
    }

    function updateChart(type, btn) {
        document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        if (type === 'day') {
            initChart(chartDataDay, 'Pengunjung per Hari');
        } else if (type === 'week') {
            initChart(chartDataWeek, 'Pengunjung per Minggu');
        } else if (type === 'month') {
            initChart(chartDataMonth, 'Pengunjung per Bulan');
        }
    }

    // Initialize with day chart
    document.addEventListener('DOMContentLoaded', function() {
        initChart(chartDataDay, 'Pengunjung per Hari');
    });
</script>

<?= $this->endSection() ?>
