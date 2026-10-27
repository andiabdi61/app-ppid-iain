import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();

import './admin/bidang-form.js';
import './admin/photo-upload.js';
import './admin/static-pages.js';

// --- INISIALISASI TINYMCE ---
// Pastikan DOM sudah siap sebelum menginisialisasi TinyMCE
document.addEventListener('DOMContentLoaded', function () {
    // Cek apakah ada elemen textarea dengan class tinymce-editor
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            plugins: 'advlist autolink lists link image charmap print preview anchor ' +
                     'searchreplace visualblocks code fullscreen insertdatetime media table paste ' +
                     'wordcount',
            toolbar: 'undo redo | formatselect | bold italic backcolor | ' +
                     'alignleft aligncenter alignright alignjustify | ' +
                     'bullist numlist outdent indent | removeformat | table | ' +
                     'link image | code help',
            branding: false,
            menubar: false,
            height: 500,
            image_advtab: true,
            automatic_uploads: true,
            images_upload_url: '/admin/tinymce/upload-image',
            images_upload_credentials: true,
            images_reuse_filename: true,
            paste_data_images: true,
            file_picker_types: 'image',
            images_upload_handler: function (blobInfo, success, failure, progress) {
                return new Promise(function (resolve, reject) {
                    var xhr = new XMLHttpRequest();
                    xhr.withCredentials = true;
                    xhr.open('POST', '/admin/tinymce/upload-image');

                    var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]')?.value;
                    if (csrfToken) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    }

                    xhr.upload.onprogress = function (e) {
                        if (typeof progress === 'function') {
                            progress(e.loaded / e.total * 100);
                        }
                    };

                    xhr.onload = function () {
                        if (xhr.status < 200 || xhr.status >= 300) {
                            var errMsg = 'HTTP Error: ' + xhr.status;
                            if (typeof failure === 'function') failure(errMsg);
                            reject(errMsg);
                            return;
                        }

                        var json;
                        try {
                            json = JSON.parse(xhr.responseText);
                        } catch (e) {
                            var parseErr = 'Invalid JSON: ' + xhr.responseText;
                            if (typeof failure === 'function') failure(parseErr);
                            reject(parseErr);
                            return;
                        }

                        if (!json || typeof json.location != 'string') {
                            var locErr = 'Invalid response: missing location';
                            if (typeof failure === 'function') failure(locErr);
                            reject(locErr);
                            return;
                        }

                        if (typeof success === 'function') success(json.location);
                        resolve(json.location);
                    };

                    xhr.onerror = function () {
                        var netErr = 'Image upload failed due to a XHR Transport error. Code: ' + xhr.status;
                        if (typeof failure === 'function') failure(netErr);
                        reject(netErr);
                    };

                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                });
            },
        });
    }


    
});