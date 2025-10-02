<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAMPIRAN DATA APLIKASI</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 1.5cm;
            }
            body { 
                margin: 0; 
                font-size: 11px;
                line-height: 1.3;
            }
            .no-print { display: none !important; }
            .print-button { display: none !important; }
            .section { 
                page-break-inside: avoid;
                margin-bottom: 15px;
            }
            .form-row {
                margin-bottom: 6px;
            }
            .form-field-large {
                min-height: 50px;
            }
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            background: white;
            max-width: 21cm;
            margin: 0 auto;
        }
        
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .header-info {
            flex: 1;
        }
        
        .header-title-small {
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            margin-bottom: 8px;
            line-height: 1.2;
            text-align: center;
        }
        
        .header-title {
            font-weight: bold;
            font-size: 20px;
            text-transform: uppercase;
            margin-bottom: 8px;
            line-height: 1.2;
            text-align: center;
        }
        
        .header-address {
            font-size: 11px;
            margin-bottom: 4px;
            line-height: 1.3;
            text-align: center;
        }
        
        .separator {
            border-top: 1px solid #000;
            margin: 8px 0;
        }
        
        .main-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            text-decoration: underline;
            margin: 20px 0;
        }
        
        .section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        
        .form-row {
            display: flex;
            margin-bottom: 6px;
            align-items: flex-start;
            min-height: 22px;
        }
        
        .form-label {
            width: 180px;
            font-weight: bold;
            margin-right: 8px;
            flex-shrink: 0;
            font-size: 11px;
        }
        
        .form-field {
            flex: 1;
            border-bottom: 1px solid #000;
            min-height: 18px;
            padding: 2px 5px;
            font-size: 11px;
        }
        
        .form-field-large {
            border: 1px solid #000;
            min-height: 50px;
            padding: 5px;
            margin-top: 5px;
            font-size: 11px;
        }
        
        .form-hint {
            font-style: italic;
            color: #666;
            font-size: 10px;
        }
        
        .checkbox-option {
            display: inline-block;
            margin-right: 20px;
        }
        
        .two-column {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }
        
        .column {
            flex: 1;
        }
        
        .column .form-row {
            margin-bottom: 5px;
        }
        
        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature {
            text-align: center;
            width: 150px;
        }
        
        .signature-line {
            border-bottom: 1px solid #000;
            height: 40px;
            margin-bottom: 5px;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000;
        }
        
        .print-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <button class="print-button no-print" onclick="window.print()">🖨️ Print</button>
    
    <div class="header">
        <div class="logo">
            <img src="{{ asset('assets/img/logo-banten.png') }}" alt="Logo Banten">
        </div>
        <div class="header-info">
            <div class="header-title-small">PEMERINTAH PROVINSI BANTEN</div>
            <div class="header-title">DINAS KOMUNIKASI, INFORMATIKA,</div>
            <div class="header-title">STATISTIK DAN PERSANDIAN</div>
            <div class="header-address">Kawasan Pusat Pemerintahan Provinsi Banten (KP3B)</div>
            <div class="header-address">Jl. Syeh Nawawi Al-Bantani, KP3B Curug, Kota Serang - Provinsi Banten. Email: diskominfo@bantenprov.go.id</div>
            <div class="header-address">Kode Pos 42171</div>
        </div>
    </div>
    
    <div class="main-title">LAMPIRAN DATA APLIKASI</div>
    
    <!-- A. DATA UMUM -->
    <div class="section">
        <div class="section-title">A. DATA UMUM</div>
        
        <div class="form-row">
            <div class="form-label">1. OPD</div>
            <div class="form-field">{{ $inventory->opd->name ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">2. Nama Aplikasi <span class="form-hint">(Alamat domain/url)</span></div>
            <div class="form-field">{{ $inventory->name ?? '' }} @if($inventory->url) - {{ $inventory->url }} @endif</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">3. Pengembang <span class="form-hint">(OPD/Diskominfo/Pihak Ketiga)</span></div>
            <div class="form-field">{{ $inventory->unitPengembang->name ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">4. Pengelola/Unit Operasional</div>
            <div class="form-field">{{ $inventory->unitOperasional->name ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">5. Uraian Aplikasi</div>
        </div>
        <div class="form-field-large">{{ $inventory->keterangan ?? '' }}</div>
        
        <div class="form-row">
            <div class="form-label">6. Fungsi Aplikasi</div>
        </div>
        <div class="form-field-large">{{ $inventory->fungsi ?? '' }}</div>
        
        <div class="form-row">
            <div class="form-label">7. Basis Aplikasi <span class="form-hint">(Desktop/Web/Cloud/Mobile)</span></div>
            <div class="form-field">{{ $inventory->basis_aplikasi ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">8. Tipe Layanan <span class="form-hint">(Layanan Publik/Layanan Tata Kelola Pemerintahan)</span></div>
            <div class="form-field">{{ $inventory->layanan->name ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">9. Lokasi Server <span class="form-hint">(Diskominfo/Diluar Diskominfo)</span></div>
            <div class="form-field">{{ $inventory->type_hosting ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">10. Tahun Pembangunan / Pengembangan</div>
            <div class="form-field">{{ $inventory->tahun_anggaran ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">11. Status <span class="form-hint">(Aktif/Suspend/Tidak Aktif)</span></div>
            <div class="form-field">{{ $inventory->statusapp->name ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">12. Sumber Dana <span class="form-hint">(APBD/Non-APBD)</span></div>
            <div class="form-field">Rp. {{ number_format($inventory->tahun_anggaran ?? 0, 0, ',', '.') }}</div>
        </div>
    </div>
    
    <!-- B. DATA TEKNIS -->
    <div class="section">
        <div class="section-title">B. DATA TEKNIS</div>
        
        <div class="form-row">
            <div class="form-label">1. Version</div>
            <div class="form-field">{{ $inventory->version ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">2. Service API <span class="form-hint">(url)</span></div>
            <div class="form-field">{{ $inventory->url ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">3. Platform/Framework</div>
            <div class="form-field">{{ $inventory->platform ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">4. Bahasa Pemrograman</div>
            <div class="form-field">{{ $inventory->manufacturer ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">5. Tipe Lisensi Bahasa Pemrograman</div>
            <div class="form-field">{{ $inventory->tipe_lisensi ?? '' }}</div>
        </div>
        
        <div class="two-column">
            <div class="column">
                <div class="form-row">
                    <div class="form-label">6. Jenis Server <span class="form-hint">(Virtual Server/C-Panel)</span></div>
                    <div class="form-field">{{ $inventory->server->name ?? '' }}</div>
                </div>
                
                <div class="form-row">
                    <div class="form-label">7. Memory:</div>
                    <div class="form-field">{{ $inventory->server->memory ?? '' }}</div>
                </div>
                
                <div class="form-row">
                    <div class="form-label">8. CPU:</div>
                    <div class="form-field">{{ $inventory->server->cpu ?? '' }}</div>
                </div>
                
                <div class="form-row">
                    <div class="form-label">9. Database:</div>
                    <div class="form-field">{{ $inventory->server->database ?? '' }}</div>
                </div>
            </div>
            
            <div class="column">
                <div class="form-row">
                    <div class="form-label">10. Storage:</div>
                    <div class="form-field">{{ $inventory->server->storage ?? '' }}</div>
                </div>
                
                <div class="form-row">
                    <div class="form-label">11. Web Server:</div>
                    <div class="form-field">{{ $inventory->server->web_server ?? '' }}</div>
                </div>
                
                <div class="form-row">
                    <div class="form-label">12. System Operasi:</div>
                    <div class="form-field">{{ $inventory->server->os ?? '' }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- C. DATA DOKUMEN -->
    <div class="section">
        <div class="section-title">C. DATA DOKUMEN</div>
        
        <div class="form-row">
            <div class="form-label">1. Surat Permohonan <span class="form-hint">(Ada/Tidak Ada)</span></div>
            <div class="checkbox-option">☐ Ada</div>
            <div class="checkbox-option">☐ Tidak Ada</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">2. Dokumen Analisis Kebutuhan <span class="form-hint">(Ada/Tidak Ada)</span></div>
            <div class="checkbox-option">☐ Ada</div>
            <div class="checkbox-option">☐ Tidak Ada</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">3. Dokumen Proses Bisnis <span class="form-hint">(Ada/Tidak Ada)</span></div>
            <div class="checkbox-option">☐ Ada</div>
            <div class="checkbox-option">☐ Tidak Ada</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">4. Manual Book <span class="form-hint">(Ada/Tidak Ada)</span></div>
            <div class="checkbox-option">☐ Ada</div>
            <div class="checkbox-option">☐ Tidak Ada</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">5. Hasil Uji Fungsi <span class="form-hint">(Ada/Tidak Ada)</span></div>
            <div class="checkbox-option">☐ Ada</div>
            <div class="checkbox-option">☐ Tidak Ada</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">6. Hasil Uji Integrasi <span class="form-hint">(Ada/Tidak Ada)</span></div>
            <div class="checkbox-option">☐ Ada</div>
            <div class="checkbox-option">☐ Tidak Ada</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">7. Hasil Uji Keamanan <span class="form-hint">(Ada/Tidak Ada)</span></div>
            <div class="checkbox-option">☐ Ada</div>
            <div class="checkbox-option">☐ Tidak Ada</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">8. Hasil Uji Beban <span class="form-hint">(Ada/Tidak Ada)</span></div>
            <div class="checkbox-option">☐ Ada</div>
            <div class="checkbox-option">☐ Tidak Ada</div>
        </div>
    </div>
    
    <!-- D. META DATA -->
    <div class="section">
        <div class="section-title">D. META DATA</div>
        
        <div class="form-row">
            <div class="form-label">1. ID</div>
            <div class="form-field">{{ $inventory->id ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">2. Kode Model Referensi SPBE</div>
            <div class="form-field">{{ $inventory->refferensi_code ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">3. Layanan yang Didukung</div>
            <div class="form-field">{{ $inventory->layanan->name ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">4. Data yang Digunakan</div>
            <div class="form-field">{{ $inventory->dataMetadata->name ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">5. Luaran</div>
            <div class="form-field">{{ $inventory->luaran ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">6. Inputan Data</div>
            <div class="form-field">{{ $inventory->inputan_data ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">7. Supplier Data</div>
            <div class="form-field">{{ $inventory->supplier_data ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">8. Luaran Data</div>
            <div class="form-field">{{ $inventory->luaran_data ?? '' }}</div>
        </div>
        
        <div class="form-row">
            <div class="form-label">9. Customer Data</div>
            <div class="form-field">{{ $inventory->customer_data ?? '' }}</div>
        </div>
    </div>
    
    <div class="footer">
        <div class="signature">
            <div class="signature-line"></div>
            <div>Paraf OPD</div>
            <div>1</div>
        </div>
        <div class="signature">
            <div class="signature-line"></div>
            <div>Paraf OPD</div>
            <div>2</div>
        </div>
    </div>
</body>
</html>
