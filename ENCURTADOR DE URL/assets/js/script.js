document.addEventListener('DOMContentLoaded', function() {
    // Função para copiar URL para a área de transferência
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Feedback visual
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 p-3';
            toast.style.zIndex = '5';
            toast.innerHTML = `
                <div class="toast show" role="alert">
                    <div class="toast-header">
                        <strong class="me-auto">Sucesso!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        URL copiada para a área de transferência!
                    </div>
                </div>
            `;
            document.body.appendChild(toast);
            
            // Remove o toast após 3 segundos
            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    }
    
    // Adiciona botões de cópia para cada URL curta
    document.querySelectorAll('table tbody tr').forEach(row => {
        const shortUrl = row.querySelector('td:nth-child(2) a');
        if (shortUrl) {
            const copyButton = document.createElement('button');
            copyButton.className = 'btn btn-sm btn-outline-primary ms-2';
            copyButton.innerHTML = '<i class="bi bi-clipboard"></i> Copiar';
            copyButton.onclick = (e) => {
                e.preventDefault();
                copyToClipboard(shortUrl.href);
            };
            shortUrl.parentNode.appendChild(copyButton);
        }
    });
    
    // Validação do formulário
    const form = document.querySelector('form');
    const urlInput = document.getElementById('url');
    const slugInput = document.getElementById('custom_slug');
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Valida URL
        if (!urlInput.value.match(/^(http|https):\/\/[^ "]+$/)) {
            urlInput.classList.add('is-invalid');
            isValid = false;
        } else {
            urlInput.classList.remove('is-invalid');
        }
        
        // Valida slug personalizado
        if (slugInput.value && !slugInput.value.match(/^[a-zA-Z0-9-_]+$/)) {
            slugInput.classList.add('is-invalid');
            isValid = false;
        } else {
            slugInput.classList.remove('is-invalid');
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
});
