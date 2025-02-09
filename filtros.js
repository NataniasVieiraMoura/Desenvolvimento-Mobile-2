function filtrarProdutos() {
    const statusSelecionado = document.getElementById('filtro-status').value;
    const termoPesquisa = document.getElementById('pesquisa').value.toLowerCase();
    
    //Seleciona todos os produtos
    const produtos = document.querySelectorAll('.container-produto');
    
    produtos.forEach(produto => {
        const status = produto.querySelector('p:nth-child(6)').textContent.toLowerCase();
        const nome = produto.querySelector('p:nth-child(2)').textContent.toLowerCase();
        const descricao = produto.querySelector('p:nth-child(3)').textContent.toLowerCase();
        
        //Verifica se o produto atende aos critérios de filtro
        const atendeStatus = statusSelecionado === 'todos' || status === statusSelecionado;
        const atendePesquisa = nome.includes(termoPesquisa) || 
                              descricao.includes(termoPesquisa);
        
        //Mostra ou esconde o produto baseado nos filtros
        if (atendeStatus && atendePesquisa) {
            produto.classList.remove('produto-escondido');
        } else {
            produto.classList.add('produto-escondido');
        }
    });
} 