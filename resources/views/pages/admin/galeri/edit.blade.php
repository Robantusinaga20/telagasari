@extends('layouts.admin')

@section('title', 'Edit Gambar')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="card shadow border-0">
        <div class="card-body">
          <h4 class="text-center fw-bold mb-4 text-primary">Edit Gambar</h4>

          <form action="{{ route('galeri.update', $galeris->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Tanggal --}}
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" name="tanggal" id="tanggal" class="form-control"
                     value="{{ $galeris->tanggal->format('Y-m-d') }}" required>
            </div>

            {{-- Gambar Lama + Preview Gambar Baru (satu grid) --}}
            <div class="mb-4">
              <label class="form-label fw-bold">Gambar</label>
              <p class="text-muted small mb-2">
                Klik tanda <strong>×</strong> pada thumbnail untuk menghapus. Klik tombol <strong>+</strong> untuk menambah gambar.
              </p>

              <div id="preview-container" class="d-flex flex-wrap gap-3">
                {{-- THUMBNAIL GAMBAR LAMA --}}
                @php $oldImages = json_decode($galeris->gambar ?? '[]', true) ?? []; @endphp
                @foreach($oldImages as $img)
                  <div class="position-relative preview-image existing" data-path="{{ $img }}"
                       style="width:120px;height:120px;">
                    <img src="{{ asset('storage/'.$img) }}" class="w-100 h-100 rounded-3"
                         style="object-fit:cover;" alt="Gambar Lama">
                    <button type="button"
                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle remove-existing"
                            title="Hapus gambar lama">&times;</button>
                  </div>
                @endforeach

                {{-- TOMBOL + (INPUT FILE DISAMARKAN) --}}
                <label for="gambar"
                       class="d-flex align-items-center justify-content-center border rounded-3 bg-light"
                       style="width:120px;height:120px;cursor:pointer;">
                  <span class="fs-1 text-primary">+</span>
                </label>
              </div>

              {{-- input file multiple (hidden) --}}
              <input type="file" id="gambar" name="gambar[]" class="d-none" multiple accept="image/*">

              {{-- container untuk input hidden hapus_gambar[] --}}
              <div id="hapus-container"></div>
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori Gambar</label>
              <select id="kategori-select" class="form-select mb-2" onchange="updateKategoriInput(this.value)">
                <option value="">-- Pilih Kategori --</option>
                <option value="Posyandu">Posyandu</option>
                <option value="Kegiatan Desa">Kegiatan Desa</option>
                <option value="Peternakan">Peternakan</option>
                <option value="Pertanian">Pertanian</option>
                <option value="Perkebunan">Perkebunan</option>
                <option value="custom">Lainnya (Ketik Sendiri)</option>
              </select>
              <input type="text" name="kategori" id="kategori-input" class="form-control"
                     placeholder="Masukkan kategori sendiri"
                     value="{{ old('kategori', $galeris->kategori ?? '') }}"
                     style="display:none;">
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
              <label for="ket" class="form-label">Keterangan Gambar</label>
              <textarea name="ket" id="ket" rows="6" class="form-control" required>{{ $galeris->ket }}</textarea>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ url('/admin-galeri') }}" class="btn btn-danger">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Scripts --}}
<script>
  // ====== HAPUS GAMBAR LAMA ======
  const hapusContainer = document.getElementById('hapus-container');
  document.querySelectorAll('.remove-existing').forEach(btn => {
    btn.addEventListener('click', function () {
      const wrap = this.closest('.preview-image.existing');
      const path = wrap.getAttribute('data-path');

      // tambahkan hidden input hapus_gambar[]
      const input = document.createElement('input');
      input.type  = 'hidden';
      input.name  = 'hapus_gambar[]';
      input.value = path;
      hapusContainer.appendChild(input);

      // hapus thumbnail dari UI
      wrap.remove();
    });
  });

  // ====== PREVIEW & HAPUS GAMBAR BARU ======
  const inputFile = document.getElementById('gambar');
  const previewContainer = document.getElementById('preview-container');

  // util: rebuild FileList dengan mengecualikan id tertentu
  function rebuildFileList(excludeIds = []) {
    const dt = new DataTransfer();
    Array.from(inputFile.files).forEach(f => {
      const fid = `${f.name}_${f.lastModified}`;
      if (!excludeIds.includes(fid)) dt.items.add(f);
    });
    inputFile.files = dt.files;
  }

  inputFile.addEventListener('change', function () {
    // hapus semua preview gambar-baru sebelumnya (jangan sentuh gambar lama & tombol +)
    previewContainer.querySelectorAll('.preview-image.new').forEach(p => p.remove());

    Array.from(this.files).forEach(file => {
      const reader = new FileReader();
      reader.onload = e => {
        const fid = `${file.name}_${file.lastModified}`;
        const div = document.createElement('div');
        div.className = 'position-relative preview-image new';
        div.dataset.fid = fid;
        div.style.width = '120px';
        div.style.height = '120px';
        div.innerHTML = `
          <img src="${e.target.result}" class="w-100 h-100 rounded-3" style="object-fit:cover;">
          <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle remove-new" title="Batalkan gambar baru">&times;</button>
        `;
        // sisipkan sebelum tombol +
        previewContainer.insertBefore(div, previewContainer.lastElementChild);

        // tombol hapus
        div.querySelector('.remove-new').addEventListener('click', () => {
          rebuildFileList([fid]);
          div.remove();
        });
      };
      reader.readAsDataURL(file);
    });
  });

  // ====== KATEGORI (dropdown atau custom) ======
  function updateKategoriInput(value) {
    const input = document.getElementById('kategori-input');
    if (value === 'custom' || value === '') {
      input.style.display = 'block';
      input.value = '';
    } else {
      input.style.display = 'none';
      input.value = value;
    }
  }
  document.addEventListener('DOMContentLoaded', () => {
    const oldVal = "{{ old('kategori', $galeris->kategori ?? '') }}";
    const select = document.getElementById('kategori-select');
    const input  = document.getElementById('kategori-input');
    const preset = ['Posyandu','Kegiatan Desa','Peternakan','Pertanian','Perkebunan'];

    if (preset.includes(oldVal)) {
      select.value = oldVal;
      input.style.display = 'none';
    } else {
      select.value = 'custom';
      input.style.display = 'block';
      input.value = oldVal;
    }
  });
</script>
@endsection