<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Medical Passport | {{ $data->medical_id }}</title>
 <style>
 body { font-family: 'Inter', sans-serif; margin: 0; padding: 0; background: #f1f5f9; display: flex; items-center; justify-content: center; height: 100vh; }
 .passport { width: 85.6mm; height: 53.98mm; background: #0f172a; border-radius: 5mm; color: white; padding: 5mm; position: relative; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
 .passport::before { content: ''; position: absolute; top: -10mm; right: -10mm; width: 40mm; height: 40mm; background: rgba(255,255,255,0.05); border-radius: 50%; }
 .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5mm; }
 .logo { font-weight: 900; font-size: 4mm; letter-spacing: -0.5px; }
 .type { font-size: 2mm; font-weight: 700; text-transform: uppercase; letter-spacing: 1mm; color: #3b82f6; }
 .name { font-size: 4.5mm; font-weight: 900; margin-bottom: 1mm; text-transform: uppercase; }
 .id { font-family: 'JetBrains Mono', monospace; font-size: 3mm; color: #64748b; font-weight: 700; }
 .footer { position: absolute; bottom: 5mm; left: 5mm; right: 5mm; display: flex; justify-content: space-between; align-items: flex-end; }
 .barcode { width: 20mm; height: 5mm; background: white; opacity: 0.8; }
 .chip { width: 8mm; height: 6mm; background: #fbbf24; border-radius: 1mm; margin-bottom: 3mm; }
 @media print { body { background: white; } .passport { margin: 0; box-shadow: none; border: 1px solid #e2e8f0; } }
 </style>
</head>
<body>
 <div class="passport">
 <div class="header">
 <div class="logo">OPESHIS OS</div>
 <div class="type">Medical Passport</div>
 </div>
 
 <div class="chip"></div>
 
 <div class="name">{{ $data->full_name }}</div>
 <div class="id">ID: {{ $data->medical_id }}</div>
 
 <div class="footer">
 <div style="font-size: 1.5mm; color: #475569;">Valid Institutional ID | Sentinel Protocol V3</div>
 <div class="barcode"></div>
 </div>
 </div>
</body>
</html>
