const textarea = document.getElementById('descripcion');

// Ajusta la altura del textarea al contenido
textarea.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (Math.min(this.scrollHeight, 100)) + 'px';
});