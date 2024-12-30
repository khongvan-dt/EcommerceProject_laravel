function previewImage(input, previewId, imageClass) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = imageClass;
            img.alt = 'Image Preview';
            preview.appendChild(img);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}