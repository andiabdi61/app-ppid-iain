{{-- 
    Partial: Script Auto-Translate untuk Informasi Publik
    Menerjemahkan 6 field: judul, konten, pejabat, penanggung_jawab, tempat, jangka_waktu
--}}
<script>
    async function translateWithLib(text, targetLang) {
        if (!text || text.trim() === '') return '';
        try {
            const response = await fetch(`/admin/translate-library`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value 
                },
                body: JSON.stringify({ text: text, target_lang: targetLang })
            });
            
            const data = await response.json();
            if (data.success) return data.translation;
            throw new Error(data.message || 'Gagal memproses terjemahan');
        } catch (error) {
            console.error("Translate Error:", error);
            return ''; 
        }
    }

    function getTinyMCEContent(editorId) {
        if (typeof tinymce !== 'undefined' && tinymce.get(editorId)) {
            return tinymce.get(editorId).getContent();
        }
        return document.getElementById(editorId)?.value || '';
    }

    function setTinyMCEContent(editorId, content) {
        if (typeof tinymce !== 'undefined' && tinymce.get(editorId)) {
            tinymce.get(editorId).setContent(content);
        }
        const el = document.getElementById(editorId);
        if (el) el.value = content;
    }

    async function translateInfoFields(target) {
        const statusEl = document.getElementById('info-translate-status');
        const progressEl = document.getElementById('info-translate-progress');

        // Ambil semua value dari field Indonesia
        const fieldSources = {
            judul:             document.getElementById('judul')?.value || '',
            pejabat:           document.getElementById('pejabat')?.value || '',
            penanggung_jawab:  document.getElementById('penanggung_jawab')?.value || '',
            tempat:            document.getElementById('tempat')?.value || '',
            jangka_waktu:      document.getElementById('jangka_waktu')?.value || '',
            konten:            getTinyMCEContent('konten'),
        };

        // Cek apakah ada yang diisi
        const hasContent = Object.values(fieldSources).some(v => v.trim() !== '');
        if (!hasContent) {
            alert('Isi setidaknya satu field dalam Bahasa Indonesia terlebih dahulu.');
            return;
        }

        // Tampilkan status & reset progress
        statusEl.classList.remove('hidden');
        progressEl.style.width = '0%';
        progressEl.classList.remove('bg-green-500');
        progressEl.classList.add('bg-indigo-600');
        
        // Nonaktifkan tombol
        document.querySelectorAll('#btn-en, #btn-ar, #btn-all').forEach(b => {
            b.disabled = true;
            b.classList.add('opacity-50', 'cursor-not-allowed');
        });

        // Buka kolom terjemahan
        const fields = document.getElementById('info-translation-fields');
        if (fields && fields.classList.contains('hidden')) {
            fields.classList.remove('hidden');
        }

        const languages = target === 'all' ? ['en', 'ar'] : [target];
        
        // Hitung total langkah (hanya field yang punya isi)
        const filledFields = Object.entries(fieldSources).filter(([k, v]) => v.trim() !== '');
        let totalSteps = filledFields.length * languages.length;
        let currentStep = 0;

        for (const lang of languages) {
            const langName = lang === 'en' ? 'English' : 'العربية';
            
            for (const [fieldName, fieldValue] of filledFields) {
                const labelMap = {
                    judul: 'Judul',
                    pejabat: 'Pejabat',
                    penanggung_jawab: 'Penanggung Jawab',
                    tempat: 'Tempat',
                    jangka_waktu: 'Jangka Waktu',
                    konten: 'Konten',
                };
                
                statusEl.querySelector('p').innerText = `⏳ Menerjemahkan ${labelMap[fieldName]} ke ${langName}...`;
                
                const res = await translateWithLib(fieldValue, lang);
                if (res) {
                    const targetId = `${fieldName}_${lang}`;
                    
                    if (fieldName === 'konten') {
                        setTinyMCEContent(targetId, res);
                    } else {
                        const targetEl = document.getElementById(targetId);
                        if (targetEl) targetEl.value = res;
                    }
                }
                
                currentStep++;
                progressEl.style.width = `${(currentStep / totalSteps) * 100}%`;
            }
        }

        statusEl.querySelector('p').innerText = '✅ Terjemahan selesai! Periksa kolom di bawah.';
        progressEl.style.width = '100%';
        progressEl.classList.remove('bg-indigo-600');
        progressEl.classList.add('bg-green-500');
        
        // Aktifkan kembali tombol
        document.querySelectorAll('#btn-en, #btn-ar, #btn-all').forEach(b => {
            b.disabled = false;
            b.classList.remove('opacity-50', 'cursor-not-allowed');
        });
        
        setTimeout(() => {
            statusEl.classList.add('hidden');
            progressEl.classList.remove('bg-green-500');
            progressEl.classList.add('bg-indigo-600');
        }, 4000);
    }
</script>
