 const judulInput = document.getElementById('judul');
        const judulCount = document.getElementById('judul-count');
        const metaInput = document.getElementById('meta_description');
        const metaCount = document.getElementById('meta-count');
        const miniBacaInput = document.getElementById('menit_baca');
        const slugInput = document.getElementById('slug');
        const pathGambarInput = document.getElementById('path_gambar');
        const imagesContainer = document.getElementById('images-container');

        // Article content from window variable (passed from Blade)
        const artikelContent = window.artikelContent || { blocks: [] };

        // Extract images from EditorJS content
        function extractImages() {
            const images = [];
            if (artikelContent.blocks && Array.isArray(artikelContent.blocks)) {
                artikelContent.blocks.forEach(block => {
                    if (block.type === 'image' && block.data && block.data.file) {
                        images.push(block.data.file.url);
                    }
                });
            }
            return images;
        }

        // Display image options
        function displayImages() {
            const images = extractImages();
            imagesContainer.innerHTML = '';

            if (images.length === 0) {
                imagesContainer.innerHTML = '<p class="text-gray-400 text-sm col-span-full">No images found in your article. Add images to select as featured image.</p>';
                return;
            }

            images.forEach((imageUrl, index) => {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'image-selector';
                imageDiv.innerHTML = `
                    <img src="${imageUrl}" alt="Image ${index + 1}">
                    <div class="image-selector-overlay">
                        <span class="checkmark">✓</span>
                    </div>
                `;

                if (pathGambarInput.value === imageUrl) {
                    imageDiv.classList.add('selected');
                }

                imageDiv.addEventListener('click', () => {
                    // Remove selected from all
                    document.querySelectorAll('.image-selector').forEach(el => {
                        el.classList.remove('selected');
                    });
                    // Add selected to clicked
                    imageDiv.classList.add('selected');
                    pathGambarInput.value = imageUrl;
                });

                imagesContainer.appendChild(imageDiv);
            });
        }

        // Calculate reading time from word count
        function calculateReadingTime() {
            let totalText = '';

            if (artikelContent.blocks && Array.isArray(artikelContent.blocks)) {
                artikelContent.blocks.forEach(block => {
                    if (block.type === 'paragraph' && block.data && block.data.text) {
                        totalText += block.data.text + ' ';
                    } else if (block.type === 'header' && block.data && block.data.text) {
                        totalText += block.data.text + ' ';
                    } else if (block.type === 'list' && block.data && block.data.items) {
                        block.data.items.forEach(item => {
                            if (typeof item === 'string') {
                                totalText += item + ' ';
                            } else if (item.content) {
                                totalText += item.content + ' ';
                            }
                        });
                    }
                });
            }

            // Count words
            const wordCount = totalText.trim().split(/\s+/).length;
            const readingTime = Math.ceil(wordCount / 200); // 200 words per minute

            miniBacaInput.value = Math.max(1, readingTime); // Min 1 minute
            updatePreview();
        }

        // Update character counts
        judulInput.addEventListener('input', () => {
            judulCount.textContent = judulInput.value.length;
            updatePreview();
        });

        metaInput.addEventListener('input', () => {
            metaCount.textContent = metaInput.value.length;
            updatePreview();
        });

        // Update preview
        function updatePreview() {
            document.getElementById('preview-title').textContent = judulInput.value || 'Article Title';
            document.getElementById('preview-description').textContent = metaInput.value || 'No description added yet';
            document.getElementById('preview-reading-time').textContent = miniBacaInput.value || '--';
        }

        // Auto-generate slug from title
        judulInput.addEventListener('blur', () => {
            if (!slugInput.value) {
                const slug = judulInput.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            displayImages();
            calculateReadingTime();
            if (window.lucide) window.lucide.createIcons();
        });
