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

    async function translateCategoryFields(target) {
        const statusEl = document.getElementById('category-translate-status');
        const progressEl = document.getElementById('category-translate-progress');

        const fieldSources = {
            nama:       document.getElementById('nama')?.value || '',
            deskripsi:  document.getElementById('deskripsi')?.value || '',
        };

        const hasContent = Object.values(fieldSources).some(v => v.trim() !== '');
        if (!hasContent) {
            alert('Isi setidaknya satu field dalam Bahasa Indonesia terlebih dahulu.');
            return;
        }

        statusEl.classList.remove('hidden');
        progressEl.style.width = '0%';
        progressEl.classList.remove('bg-green-500');
        progressEl.classList.add('bg-indigo-600');

        document.querySelectorAll('#cat-btn-en, #cat-btn-ar, #cat-btn-all').forEach(b => {
            b.disabled = true;
            b.classList.add('opacity-50', 'cursor-not-allowed');
        });

        const fields = document.getElementById('category-translation-fields');
        if (fields && fields.classList.contains('hidden')) {
            fields.classList.remove('hidden');
        }

        const languages = target === 'all' ? ['en', 'ar'] : [target];

        const filledFields = Object.entries(fieldSources).filter(([k, v]) => v.trim() !== '');
        let totalSteps = filledFields.length * languages.length;
        let currentStep = 0;

        for (const lang of languages) {
            const langName = lang === 'en' ? 'English' : 'العربية';

            for (const [fieldName, fieldValue] of filledFields) {
                const labelMap = {
                    nama: 'Nama Kategori',
                    deskripsi: 'Deskripsi',
                };

                statusEl.querySelector('p').innerText = `⏳ Menerjemahkan ${labelMap[fieldName]} ke ${langName}...`;

                const res = await translateWithLib(fieldValue, lang);
                if (res) {
                    const targetId = `${fieldName}_${lang}`;
                    const targetEl = document.getElementById(targetId);
                    if (targetEl) targetEl.value = res;
                }

                currentStep++;
                progressEl.style.width = `${(currentStep / totalSteps) * 100}%`;
            }
        }

        statusEl.querySelector('p').innerText = '✅ Terjemahan selesai! Periksa kolom di bawah.';
        progressEl.style.width = '100%';
        progressEl.classList.remove('bg-indigo-600');
        progressEl.classList.add('bg-green-500');

        document.querySelectorAll('#cat-btn-en, #cat-btn-ar, #cat-btn-all').forEach(b => {
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
