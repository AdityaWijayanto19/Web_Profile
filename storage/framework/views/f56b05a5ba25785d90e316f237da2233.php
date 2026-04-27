<?php $__env->startPush('styles'); ?>
    <style>
        :root {
            --primary: #730c1e;
            --primary-hover: #921126;
            --bg-dark: #0a0808;
            --bg-card: #1a151d;
            --border-color: rgba(255, 255, 255, 0.1);
            --text-secondary: #999999;
        }

        .form-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            background: var(--bg-dark);
            border: 1px solid var(--border-color);
            color: #e5e5e5;
            border-radius: 2px;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.75rem;
            color: #b3b3b3;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-description {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        .button-group {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 2px;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            color: #ffffff;
            border-color: var(--border-color);
        }

        .preview-box {
            background: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 1rem;
            border-radius: 2px;
            margin-top: 1.5rem;
        }

        .preview-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .preview-meta {
            color: var(--text-secondary);
            font-size: 0.8rem;
            line-height: 1.6;
        }

        .char-count {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        .image-selector {
            position: relative;
            cursor: pointer;
            border: 1px solid var(--border-color);
            border-radius: 2px;
            overflow: hidden;
            transition: all 0.2s ease;
            aspect-ratio: 16/9;
        }

        .image-selector:hover {
            border-color: var(--primary);
        }

        .image-selector.selected {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(115, 12, 30, 0.2);
        }

        .image-selector img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-selector-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.6);
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .image-selector:hover .image-selector-overlay {
            opacity: 1;
        }

        .image-selector.selected .image-selector-overlay {
            opacity: 1;
            background: rgba(115, 12, 30, 0.8);
        }

        .checkmark {
            color: white;
            font-size: 1.5rem;
        }

        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-decoration: none;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .form-container {
            background: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2px;
            padding: 1.5rem;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\Web Profile\resources\views/admin/article/_metadata-styles.blade.php ENDPATH**/ ?>