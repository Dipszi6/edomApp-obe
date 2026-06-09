// Inisialisasi Lucide Icons agar merender komponen HTML <i data-lucide="...">
        lucide.createIcons();

        // Fade up animation menggunakan IntersectionObserver
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

        // Filter ulasan
        function filterReviews(type, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            document.querySelectorAll('.review-item').forEach(item => {
                if (type === 'all') {
                    item.style.setProperty('display', '', 'important');
                } else {
                    if (item.dataset.visible === type) {
                        item.style.setProperty('display', '', 'important');
                    } else {
                        item.style.setProperty('display', 'none', 'important');
                    }
                }
            });
        }

