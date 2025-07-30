<div class="card h-100 shadow-lg border-0 rounded-4 animate__animated animate__fadeInUp animate__delay-{{ $index * 0.2 }}s" 
     style="transition: transform 0.3s ease;">
    <div class="text-center px-3" style="margin-top: -40px;">
        <img src="{{ asset('storage/' . $anggota->gambar_anggota) }}"
             alt="Foto {{ $anggota->nama }}"
             class="rounded-circle shadow-sm"
             style="width: 300px; height: 300px; object-fit: cover; object-position: top; border: 5px solid #fff; transition: transform 0.3s ease;">
    </div>
    <div class="card-body text-center">
        <h5 class="fw-bold text-dark mb-1" style="transition: color 0.3s ease;">{{ $anggota->nama }}</h5>
        <p class="text-secondary mb-1" style="transition: color 0.3s ease;">{{ $anggota->jabatan }}</p>
        <span class="badge {{ $anggota->fraksi == 'KLOITU' ? 'bg-success' : 'bg-primary' }} text-white px-3 py-2 rounded-pill" 
              style="font-size: 0.9rem; transition: transform 0.3s ease;">
            Fraksi: {{ $anggota->fraksi }}
        </span>
    </div>
</div>
