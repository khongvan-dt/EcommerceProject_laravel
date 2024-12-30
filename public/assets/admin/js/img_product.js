function previewMainImage(input) {
    const preview = document.getElementById('mainImagePreview');
    preview.innerHTML = '';

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.width = 200;
            preview.appendChild(img);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function previewImages(input) {
    const selectedImages = document.getElementById('selectedImages');
    const currentImages = document.querySelectorAll('.current-images .image-item').length;
    selectedImages.innerHTML = '';  
    
    if (input.files && input.files.length > 0) {
         if ((currentImages + input.files.length) > 10) {
            alert(`You can only add ${10 - currentImages} more images. Current images: ${currentImages}`);
            input.value = '';  
            return;
        }
        
        Array.from(input.files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function(e) {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'image-item';
                imageDiv.innerHTML = `<img src="${e.target.result}" width="100">`;
                selectedImages.appendChild(imageDiv);
            }
            reader.readAsDataURL(file);
        });
    }
    
     document.getElementById('imageCount').textContent = currentImages + (input.files ? input.files.length : 0);
}

 document.addEventListener('DOMContentLoaded', function() {
    const currentImages = document.querySelectorAll('.current-images .image-item').length;
    document.getElementById('imageCount').textContent = currentImages;
});