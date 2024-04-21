function verificarCPFDuplicado(cpf) {
    // Simule uma verificação no banco de dados ou em uma fonte de dados
    // Aqui você deve implementar a lógica de verificação real, comparando o CPF com os registros existentes
    
    // Exemplo simples: CPF 123.456.789-00 é considerado duplicado
    if (cpf === '123.456.789-00') {
        document.getElementById('cpf-error').textContent = 'CPF já cadastrado.';
    } else {
        document.getElementById('cpf-error').textContent = '';
    }
}

