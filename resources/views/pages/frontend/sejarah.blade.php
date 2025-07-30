@extends('layouts.frontend')
@section('title', 'Sejarah DPRD Kota Tegal')
@section('content')

<section class="home-section section-hero overlay bg-image animate__animated animate__fadeIn" 
         style="background-image: linear-gradient(rgba(0, 51, 102, 0.7), rgba(0, 0, 0, 0.6)), url('{{ asset('frontend/images/hero_1.jpg') }}'); background-size: cover; background-position: center; position: relative; padding: 150px 0;" 
         id="home-section">
  <div class="container">
    <div class="row align-items-center justify-content-center" style="height: 100vh;">
      <div class="col-md-10 text-center">
        <h1 class="text-white display-4 font-weight-bold animate__animated animate__zoomIn" 
            style="text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.8); font-size: 3.5rem;">
          Sejarah DPRD Kota Tegal
        </h1>
        <p class="text-white mt-4 lead animate__animated animate__fadeInUp animate__delay-1s" 
           style="max-width: 800px; line-height: 1.8; text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6); font-size: 1.3rem;">
          Gedung yang menjadi saksi sejarah panjang pemerintahan Tegal sejak era kolonial
        </p>
      </div>
    </div>
  </div>
  <a href="#next" class="scroll-button smoothscroll animate__animated animate__pulse animate__infinite" 
     style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); color: #ffc107; font-size: 2rem; text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);">
    <span class="icon-keyboard_arrow_down"></span>
  </a>
</section>

<section class="py-5 bg-light animate__animated animate__fadeIn" id="next">
  <div class="container" id="sekretariat">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-8">
        <h4 class="font-weight-bold text-black mb-3 animate__animated animate__fadeInDown" 
            style="font-size: 2rem; color: #003366; text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);">
          Gedung Bersejarah, Simbol Demokrasi
        </h4>
        <p class="text-dark animate__animated animate__fadeInUp animate__delay-1s" 
           style="font-size: 1.25rem; max-width: 700px; margin: 0 auto;">
          Kini, Gedung DPRD Kota Tegal menjadi tempat penyaluran aspirasi masyarakat serta pengambilan keputusan penting bagi kemajuan kota.
        </p>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        @php
          $sejarah = [
              "Empat pilar menyangga dengan kokoh bangunan yang di atasnya bertuliskan DPRD Kota Tegal. Berada di Jalan Pemuda No. 4 Tegal, di dalam gedung inilah para wakil rakyat bersidang dan berdinas menjadi aspirator masyarakat Kota Tegal.",
              "Dikutip dari laman Pemkot Tegal, Gedung DPRD Kota Tegal dibangun pada tahun 1750-an oleh Mathijs Willem de Man (1720-1763). Bangunan peninggalan Belanda ini pada awalnya diperuntukkan sebagai kediaman resmi dari Resident Tegal atau dalam bahasa Belandanya disebut Resident Huis.",
              "Masih dari laman Pemkot Tegal, disebutkan bahwa daerah yang dijuluki sebagai Kota Bahari ini pernah menjadi ibukota karesidenan dan sekaligus ibukota kabupaten (regentschaap). Ditetapkannya Tegal sebagai ibukota Residen terjadi pada tahun 1824, saat pemerintah kolonial mengangkat seorang Residen di Tegal.",
              "Penetapan Tegal sebagai karesidenan dan ibukota karesidenan dapat dilacak melalui Regeering Almanak van Nederlandsdsch Indie tahun 1824-1832. Karesidenan Tegal membawahi wilayah Kabupaten Brebes, Kabupaten Tegal, dan Kabupaten Pemalang. Pusat pemerintahan karesidenan berada di kompleks yang sekarang dinamakan Gedung DPRD Kota Tegal.",
              "Gedung DPRD Kota Tegal ini mempunyai luas bangunan sekitar 1.468 meter persegi, dan berada di atas tanah seluas kurang lebih 4.600 meter persegi. Pada tahun 1910, bangunan ini dialihfungsikan menjadi kantor Asisten Resident Tegal yang tergabung dalam wilayah karesidenan Pekalongan.",
              "Penetapan Tegal menjadi bagian karesidenan Pekalongan ditetapkan dalam Staatsblad 170/1905, Aantoonede de administratie ve Indeeling de Residentie Pekalongan, tertanggal 28 Februari 1905.",
              "Pasca kemerdekaan tahun 1950-an, bangunan ini kembali dialihfungsikan menjadi Balai Kota Tegal. Sedangkan untuk Kabupaten Tegal berada di Pendopo Alun-alun Kota Tegal sekarang, sebelum nantinya pindah ke Slawi.",
              "Fungsi sebagai gedung DPRD dimulai tahun 1987, saat Balai Kota Tegal pindah dari kompleks Balai Kota lama di Jalan Proklamasi menuju Pendopo Alun-alun Jalan Ki Gede Sebayu sekarang. Sementara Pemerintah Kabupaten berpindah ke selatan, tepatnya di Kecamatan Slawi yang dijadikan ibukota Kabupaten Tegal."
          ];
        @endphp

        @foreach($sejarah as $index => $item)
          <div class="col-md-12 mb-4">
            <a href="#" class="block__16443 d-flex align-items-start text-decoration-none bg-white p-4 rounded-lg shadow-md animate__animated animate__fadeInUp animate__delay-{{ $index }}s"
               style="border: 2px solid transparent; transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;">
              <span class="custom-icon mx-3 d-flex justify-content-center align-items-center"
                    style="background: linear-gradient(45deg, #003366, #005fa3); border-radius: 50%; width: 50px; height: 50px; transition: all 0.3s ease;">
                <i class="fa-solid fa-landmark text-white"></i>
              </span>
              <p class="mb-0 text-dark text-justify" style="font-weight: 500; font-size: 1.15rem;">{{ $item }}</p>
            </a>
          </div>
        @endforeach

        <div class="col-12 mt-5 text-center">
          <h2 class="section-title mb-3 font-weight-bold text-black animate__animated animate__fadeInDown" 
              style="font-size: 2.5rem; color: #003366; text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);">
            Perjalanan Sejarah DPRD Kota Tegal
          </h2>
          <p class="text-secondary animate__animated animate__fadeInUp animate__delay-1s" 
             style="font-size: 1.3rem; max-width: 700px; margin: 0 auto;">
            Kini, Gedung DPRD Kota Tegal menjadi tempat penyaluran aspirasi masyarakat serta pengambilan keputusan penting bagi kemajuan kota.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-white animate__animated animate__fadeIn">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="bg-light p-5 rounded-lg shadow-lg text-center animate__animated animate__zoomIn">
          <h5 class="mb-4 font-weight-bold text-black" style="font-size: 1.8rem; color: #003366;">
            Ikuti Media Sosial Kami
          </h5>
          <div class="d-flex justify-content-center gap-5">
            <a href="https://www.facebook.com/profile.php?id=100090255246539&mibextid=fToiWhWJ2YtxSTUw" target="_blank" class="fs-3" style="color: #1877F2; transition: all 0.3s ease;">
              <i class="fab fa-facebook-f fa-3x"></i>
            </a>
            <a href="https://www.instagram.com/dprdkotategal?igsh=bXA5ZmMzc2NpeWFl" target="_blank" class="text-danger fs-3" style="transition: all 0.3s ease;">
              <i class="fab fa-instagram fa-3x"></i>
            </a>
            <a href="https://www.tiktok.com/@dprdkotategal?_t=8sDRpIRLhou&_r=1" target="_blank" class="text-dark fs-3" style="transition: all 0.3s ease;">
              <i class="fab fa-tiktok fa-3x"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  /* Hover effect untuk item sejarah */
  .block__16443:hover {
    border-color: #003366;
    box-shadow: 0 10px 25px rgba(0, 51, 102, 0.3);
    transform: translateY(-5px);
  }

  .block__16443:hover .custom-icon {
    transform: scale(1.1) rotate(5deg);
    background: linear-gradient(45deg, #005fa3, #007bff);
  }

  /* Hover efek icon media sosial */
  .bg-light a:hover {
    transform: scale(1.2) rotate(10deg);
    transition: transform 0.3s ease;
  }

  /* Responsive teks justify */
  @media (min-width: 768px) {
    .text-justify {
      text-align: justify !important;
    }
  }

  /* Additional modern styling */
  .section-hero {
    position: relative;
    overflow: hidden;
  }

  .scroll-button:hover {
    color: #ffc107;
    transform: scale(1.2);
    text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8);
  }
</style>

@endsection

@push('scripts')
<script>
  // Scroll to section on button click
  document.querySelector('.scroll-button')?.addEventListener('click', function (event) {
    event.preventDefault();
    document.querySelector('#next').scrollIntoView({ behavior: 'smooth' });
  });

  // Hover effects for history items
  document.querySelectorAll('.block__16443').forEach(item => {
    item.addEventListener('mouseenter', () => {
      item.style.transform = 'translateY(-5px)';
      item.querySelector('.custom-icon').style.transform = 'scale(1.1) rotate(5deg)';
      item.querySelector('.custom-icon').style.background = 'linear-gradient(45deg, #005fa3, #007bff)';
      item.style.boxShadow = '0 10px 25px rgba(0, 51, 102, 0.3)';
      item.style.borderColor = '#003366';
    });
    item.addEventListener('mouseleave', () => {
      item.style.transform = 'translateY(0)';
      item.querySelector('.custom-icon').style.transform = 'scale(1) rotate(0deg)';
      item.querySelector('.custom-icon').style.background = 'linear-gradient(45deg, #003366, #005fa3)';
      item.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
      item.style.borderColor = 'transparent';
    });
  });

  // Hover effects for social media icons
  document.querySelectorAll('.bg-light a').forEach(icon => {
    icon.addEventListener('mouseenter', () => {
      icon.style.transform = 'scale(1.2) rotate(10deg)';
    });
    icon.addEventListener('mouseleave', () => {
      icon.style.transform = 'scale(1) rotate(0deg)';
    });
  });
</script>
@endpush