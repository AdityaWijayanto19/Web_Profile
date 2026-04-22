 const judulInput = document.getElementById('judul');
        const judulCount = document.getElementById('judul-count');
        const metaInput = document.getElementById('meta_description');
        const metaCount = document.getElementById('meta-count');
        const miniBacaInput = document.getElementById('menit_baca');
        const slugInput = document.getElementById('slug');
        const pathGambarInput = document.getElementById('path_gambar');
        const imagesContainer = document.getElementById('images-container');

        const artikelContent = window.artikelContent || { blocks: [] };

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

                // Normalize path: handle both /storage/ prefixed and unprefixed URLs
                let normalizedPath = imageUrl;
                if (imageUrl.startsWith('/storage/')) {
                    normalizedPath = imageUrl.substring(9); // Remove /storage/
                } else if (imageUrl.startsWith('storage/')) {
                    normalizedPath = imageUrl.substring(8); // Remove storage/
                }

                // Also handle full URL format from storage disk
                if (imageUrl.includes('storage/')) {
                    const match = imageUrl.match(/storage\/(.*)/);
                    if (match) {
                        normalizedPath = match[1];
                    }
                }

                console.log('Image URL:', imageUrl, 'Normalized:', normalizedPath);

                if (pathGambarInput.value === normalizedPath) {
                    imageDiv.classList.add('selected');
                }

                imageDiv.addEventListener('click', () => {
                    document.querySelectorAll('.image-selector').forEach(el => {
                        el.classList.remove('selected');
                    });
                    imageDiv.classList.add('selected');
                    pathGambarInput.value = normalizedPath;
                    console.log('Path set to:', normalizedPath);
                });

                imagesContainer.appendChild(imageDiv);
            });
        }

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

            const wordCount = totalText.trim().split(/\s+/).length;
            const readingTime = Math.ceil(wordCount / 200);

            miniBacaInput.value = Math.max(1, readingTime);
            updatePreview();
        }

        judulInput.addEventListener('input', () => {
            judulCount.textContent = judulInput.value.length;
            updatePreview();
        });

        metaInput.addEventListener('input', () => {
            metaCount.textContent = metaInput.value.length;
            updatePreview();
        });

        function updatePreview() {
            document.getElementById('preview-title').textContent = judulInput.value || 'Article Title';
            document.getElementById('preview-description').textContent = metaInput.value || 'No description added yet';
            document.getElementById('preview-reading-time').textContent = miniBacaInput.value || '--';
        }

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

        document.addEventListener('DOMContentLoaded', () => {
            displayImages();
            calculateReadingTime();
            if (window.lucide) window.lucide.createIcons();
        });
