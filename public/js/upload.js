document.addEventListener('DOMContentLoaded', function() {
    var imageUploadInput = document.getElementById('imageUpload');
    var imageNameSpan = document.getElementById('imageName');
    var removeImageBtn = document.getElementById('removeImageBtn');

    if (imageUploadInput && imageNameSpan && removeImageBtn) {
        imageUploadInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                var selectedFile = this.files[0];
                var validExtensions = ['png', 'jpg', 'jpeg'];
                var fileExtension = selectedFile.name.split('.').pop().toLowerCase();

                if (validExtensions.includes(fileExtension)) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        imageNameSpan.textContent = selectedFile.name;
                        imageNameSpan.style.color = 'green';
                        removeImageBtn.style.display = 'inline-block';
                    };
                    reader.readAsDataURL(selectedFile);
                } else {
                    imageNameSpan.textContent = 'Invalid format. Must be PNG, JPG, or JPEG.';
                    imageNameSpan.style.color = 'red';
                    imageUploadInput.value = '';
                }
            }
        });

        removeImageBtn.addEventListener('click', function() {
            imageUploadInput.value = '';
            imageNameSpan.textContent = '';
            imageNameSpan.style.color = '';
            removeImageBtn.style.display = 'none';
        });
    }
});
